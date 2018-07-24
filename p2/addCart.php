<?php
session_start();

                require("config.php");
                try {
                    $dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
                } catch (PDOException $e) {
                    echo "<p>Error connecting to database!</p>" . $e;
                }
                $sth = $dbh->prepare("SELECT * FROM customers WHERE username =:username");
                $sth->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
                $sth->execute();
                $usr = $sth->fetchAll();
                
            ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="/rchang/p2/js/jquery-3.2.1.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="/rchang/p2/js/materialize.min.js"></script>
    <link href="/rchang/p2/css/materialize.min.css" rel="stylesheet" type="text/css">
    <link href="/rchang/p2/css/primary.css" rel="stylesheet" type="text/css">
</head>
<body>
    <nav class="light-green darken-3">
    <h4 class="navtitle"><a href="/rchang/p2/">Creating User...</a></h4>
        <span class="user">
            
        </span>
    </nav>
</body>
</html>