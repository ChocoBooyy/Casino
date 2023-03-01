<?php
session_start();

$bet = $_SESSION['bet'];
$multiplier = $_POST['multiplier'];

$winning = $bet * $multiplier;

echo $winning;

if (isset($_POST['cashout'])) {
    $payout = calculatePayout($_SESSION['bet'], $revealMultiplier);
    $stmt = $pdo->prepare('UPDATE users SET gils = gils + ? WHERE id = ?');
    $stmt->execute([$payout, $users[0]['id']]);
    $_SESSION['bet'] = 0;
    header('Location: mines.php');
    exit();
}

?>
