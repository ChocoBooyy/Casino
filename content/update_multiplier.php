<?php
include './navbar/index.php';

unset($_SESSION['winnings']);

if (isset($_POST['multiplier'])) {
    $multiplier = floatval($_POST['multiplier']);
    $_SESSION['multiplier'] = ($multiplier > 0) ? $multiplier : 1;
} else {
    $_SESSION['multiplier'] = 0;
}

if (isset($_SESSION['bet']) && isset($_SESSION['multiplier']) && $_SESSION['multiplier'] > 0) {
    $winnings = $_SESSION['bet'] * $_SESSION['multiplier'];
    $_SESSION['winnings'] = $winnings;

    $sql = 'UPDATE users SET gils = gils + ? WHERE id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$winnings, $users[0]['id']]);
}
?>
