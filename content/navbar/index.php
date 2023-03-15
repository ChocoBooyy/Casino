<?php

session_start();

if (!isset($_SESSION['login']) || !isset($_SESSION['role'])) {
    header('Location: ../index.php');
}

$pdo = new PDO('mysql:host=localhost;dbname=casino', 'root', 'root');

$pdo->exec('SET NAMES "utf8"');

$users = $pdo->query("SELECT id, gils FROM users")->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare('SELECT gils FROM users WHERE id = ?');
$stmt->execute([$users[0]['id']]);
$gils = $stmt->fetchColumn();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="index.php">Phoenix Casino</a>

      <div class="collapse navbar-collapse" id="navbarNav">

        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="tower.php">Tower</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="dice.php">Dice</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="mines.php">Mines</a>
            </li>

        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <p class="text-white nav-centered">
                    Gils: 
                    <?php echo $gils;?>
                    &ensp;
                    <a class="btn btn-primary" href="set_gils.php">Set gils to 1 mil</a>
                </p>
            </li>
            <li class="nav-item">
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <?php
                    if (isset($_SESSION["login"])){
                ?>
                    <div class="text-white">
                        <div>
                            <?php echo $_SESSION["login"] . " "; ?>
                        </div>
                        <div>
                            <a class="btn btn-secondary" href="../logout.php">Logout</a>
                        </div>
                    </div>
                <?php } ?>
            </li>
        </ul>
      </div>
    </nav>

</body>
</html>
