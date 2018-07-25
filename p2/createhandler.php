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
                if(count($usr) == 0){
                    if(isset($_POST['first_name']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])){
                        echo "Succsess with post <br>";
                        $sth = $dbh->prepare("INSERT INTO customers (`first_name`, `username`,`password`,`email`,`IsAdmin`) VALUES (:first_name, :username, :password, :email,'0');");
                            try {
                                $sth->bindValue(':first_name', $_POST['first_name'], PDO::PARAM_STR);
                                $sth->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
                                $sth->bindValue(':password', password_hash($_POST['password'],PASSWORD_DEFAULT));
                                if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                                    $sth->bindValue(':email', $_POST['email']);
                                } else{
                                    echo "Invalid Email <br>";
                                    return;
                                }

                                $sth->execute();
                                header("Location: /rchang/p2/login.php");
                            } 
                            catch (PDOException $e){
                                echo "Error: " . $e;
                        }
                    } else {
                        echo "You missed something <br>";
                    }
                } else {
                    echo "Error, Username already exists <br>";
                } 
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