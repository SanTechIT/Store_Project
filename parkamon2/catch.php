<?php
session_start();
if (isset($_SESSION["loggedIn"])){
    if($_SESSION["loggedIn"]){
        $_SESSION['erc'] = 0;
    } else {
        $_SESSION['erc'] = 3;
        header("Location: /rchang/parkamon2/signin.php");
    }
} else {
    $_SESSION["loggedIn"] = false;
    $_SESSIO["name"] = "";
    $_SESSION['erc'] = 3;
    header("Location: /rchang/parkamon2/signin.php");
}
?>
<!doctype html>
<html>

<head>
    <title> Gotta coatch them all </title>
    <link href="/rchang/p2/css/materialize.min.css" rel="stylesheet" type="text/css">
</head>

<body>
    <form action="catch.php" method="POST">
        <?php
        require("config.php");
        try {
            $dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
        } catch (PDOException $e) {
            echo "<p>Error connecting to database!</p>" . $e;
        }

        $sth = $dbh->prepare("SELECT * FROM player WHERE id= :player_id");
    try {
        $sth->bindValue(':player_id', $_SESSION['id'], PDO::PARAM_INT);
        $sth->execute();
        $Player_Exists = $sth->fetchAll();
    } catch (PDOException $e){
        echo "Error: " . $e;
    }
    if(count($Player_Exists) == 1){
        $sth = $dbh->prepare("SELECT * FROM parkamon ORDER BY RAND() LIMIT 1");
        $sth->execute();
        $parkamon = $sth->fetchAll(); //an array of arrays
        if(count($parkamon)==1){
            foreach ($parkamon as $parka) {
                echo "You caught a " .  $parka['breed'] . "! <br>";
            }
        } else {
            echo "Error Parkamon does not exist";
        }
        $sth = $dbh->prepare("INSERT INTO ownership (`player_id`, `parkamon_id`) VALUES (:player_id, :parkamon_id);");
        try {
            $sth->bindValue(':player_id', $_SESSION['id'], PDO::PARAM_INT);
            $sth->bindValue(':parkamon_id', $parka['id'], PDO::PARAM_INT);
            $sth->execute();
        } catch (PDOException $e){
            echo "Error: " . $e;
        }
    } else {
        echo "Player does not exsist! Pokemon cannot be caught by no trainer<br>";
    }
        try {
            
            //getting multiple rows
            
        }
        catch (PDOException $e) {
            echo "<p>Error connecting to database!</p>" . $e;
        }
    ?>
    </form>
<a href="game.php">Back to main page</a>
        <body>

</html>
