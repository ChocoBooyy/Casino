<?php

include './navbar/index.php';

$_SESSION['bet'] = 0;

$stmt = $pdo->prepare('SELECT gils FROM users WHERE id = ?');
$stmt->execute([$users[0]['id']]);
$gils = $stmt->fetchColumn();

$inputBet = isset($_POST['bet']) ? intval($_POST['bet']) : $_SESSION['bet'];
if ($inputBet > 0 && $gils >= $inputBet) {
    $_SESSION['bet'] = min($inputBet, $gils);
    $gils -= $_SESSION['bet'];
    $stmt = $pdo->prepare('UPDATE users SET gils = ? WHERE id = ?');
    $stmt->execute([$gils, $users[0]['id']]);
    $isBetPlaced = true;
    $_SESSION['bet'] = 0;
} else {
    $isBetPlaced = false;
    echo "<script>alert('Please enter a valid bet value or you do not have enough gils!');</script>";
    $_SESSION['bet'] = $inputBet;
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mines</title>
    </head>
    <body>
        <h1>Mines</h1>
        <table>
            <tr>
                <td>
                    <form method="post">
                        <label for="bet">Bet:</label>
                        <input type="number" id="bet" name="bet" value="0" min="0">
                        <br>
                        <div class="text-center">
                            <button class="btn btn-outline-primary" type="submit">Place Bet</button>
                            <button class="btn btn-outline-secondary" id="cash-out">Cash Out</button>
                        </div>
                    </form>
                </td>
            </tr>
        </table>

        <p style="text-align: center">Multiplier: <span id="multiplier"></span></p>
        <p style="text-align: center">Winnings: <span id="multiplier"></span></p>

        <table>
            <?php for ($i = 0; $i < 5; $i++): ?>
                <tr>
                    <?php for ($j = 0; $j < 5; $j++): ?>
                        <td><button class="special" onclick="reveal(<?php echo $i; ?>, <?php echo $j; ?>)" <?php if (!$isBetPlaced) echo 'disabled'; ?>>?</button></td>
                    <?php endfor; ?>
                </tr>
            <?php endfor; ?>
        </table>

        <script>
            var board = [
                [0, 0, 0, 0, 0],
                [0, 0, 0, 0, 0],
                [0, 0, 0, 0, 0],
                [0, 0, 0, 0, 0],
                [0, 0, 0, 0, 0],
            ];
            var mines = 3;
            var revealedSquares = 0;
            var revealMultiplier = 1.12;

            // Place mines randomly on the board
            for (var i = 0; i < mines; i++) {
                var x = Math.floor(Math.random() * 5);
                var y = Math.floor(Math.random() * 5);
                board[x][y] = 1;
            }

            function reveal(x, y) {
                if (board[x][y] === 1) {
                    document.getElementsByClassName("special")[x * 5 + y].innerHTML = "💣";
                    document.getElementsByClassName("special")[x * 5 + y].style.backgroundColor = "black";
                    for (var i = 0; i < 25; i++) {
                        document.getElementsByClassName("special")[i].disabled = true; 
                    }
                    gameover = true;
                    revealMultiplier = 0;
                    document.getElementById("multiplier").textContent = revealMultiplier.toFixed(2);
                } else if (board[x][y] === 0) {
                    board[x][y] = 2;
                    document.getElementsByClassName("special")[x * 5 + y].innerHTML = "💎";
                    document.getElementsByClassName("special")[x * 5 + y].style.backgroundColor = "green";
                    revealedSquares++;
                    switch (revealedSquares) {
                        case 1:
                            revealMultiplier = 1.12;
                            break;
                        case 2:
                            revealMultiplier = 1.29;
                            break;
                        case 3:
                            revealMultiplier = 1.48;
                            break;
                        case 4:
                            revealMultiplier = 1.71;
                            break;
                        case 5:
                            revealMultiplier = 2.00;
                            break;
                        case 6:
                            revealMultiplier = 2.35;
                            break;
                        case 7:
                            revealMultiplier = 2.79;
                            break;
                        case 8:
                            revealMultiplier = 3.35;
                            break;
                        case 9:
                            revealMultiplier = 4.07;
                            break;
                        case 10:
                            revealMultiplier = 5.00;
                            break;
                        case 11:
                            revealMultiplier = 6.26;
                            break;
                        case 12:
                            revealMultiplier = 7.96;
                            break;
                        case 13:
                            revealMultiplier = 10.35;
                            break;
                        case 14:
                            revealMultiplier = 13.80;
                            break;
                        case 15:
                            revealMultiplier = 18.97;
                            break;
                        case 16:
                            revealMultiplier = 27.11;
                            break;
                        case 17:
                            revealMultiplier = 40.66;
                            break;
                        case 18:
                            revealMultiplier = 65.06;
                            break;
                        case 19:
                            revealMultiplier = 113.85;
                            break;
                        case 20:
                            revealMultiplier = 227.70;
                            break;
                        case 21:
                            revealMultiplier = 569.25;
                            break;
                        default:
                            revealMultiplier = 2277;
                            break;
                    }
                    document.getElementById("multiplier").textContent = revealMultiplier.toFixed(2);
                }
                var cashOutButton = document.getElementById("cash-out");
                cashOutButton.addEventListener("click", function(){
                    for (var i = 0; i < 25; i++) {
                        document.getElementsByClassName("special")[i].disabled = true; 
                    }     
                    winnings = revealMultiplier * <?php $bet ?>;
                    document.getElementById("winnings").innerHTML = winnings;
                    revealMultiplier = 0;
                    document.getElementById("multiplier").textContent = revealMultiplier.toFixed(2);
                });
            }
        </script>
    </body>
</html>
