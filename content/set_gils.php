<?php

include './navbar/index.php';

$new_gils_value = 1000000;

$sql = 'UPDATE users SET gils = ? WHERE id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$new_gils_value, $users[0]['id']]);

header('Location: ' . $_SERVER['HTTP_REFERER']);

?>
