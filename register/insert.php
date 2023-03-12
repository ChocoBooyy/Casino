<?php

$pdo = new PDO('mysql:host=localhost;dbname=casino', 'root', 'root');

$pdo->exec('SET NAMES "utf8"');

$login = $_POST['login'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role_id = intval($_POST['role_id']);
$gils = 0;

$sql = "INSERT INTO users (`login`, `password`, `role_id`, `gils`) VALUES (?,?,?,?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$login, $password, $role_id, $gils]);

header("Location: ../index.php");

?>
