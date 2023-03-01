<?php

session_start();

$pdo = new PDO('mysql:host=localhost;dbname=casino', 'root', 'root');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec('SET NAMES "utf8"');

$infos = $pdo->query("SELECT *  FROM users")->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST["login"]) && !empty($_POST["login"]) && isset($_POST["password"]) && !empty($_POST["password"])){
    $login = $_POST['login'];
    $password = $_POST['password'];

    foreach ($infos as $info) {
        if ($login == $info['login'] && password_verify($password, $info['password'])) {
            $role = $pdo->query("SELECT name FROM roles WHERE roles.id =" . $info["role_id"])->fetchColumn();
            $_SESSION['login'] = $login;
            $_SESSION['role'] = $role;
            header('Location: ./content/index.php');
            exit;
        }
    }

    header('Location: index.php?error=1&message=Invalid login or password');
    exit;
}

?>
