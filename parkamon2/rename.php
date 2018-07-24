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

    <?php
        require("config.php");
        try {
            $dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
        }
        catch (PDOException $e) {
            echo "<p>Error connecting to database!</p>" . $e;
        }
        $sth = $dbh->prepare("SELECT * FROM ownership WHERE id=:ownership_id AND player_id=:player_id");
        
        if(isset($_POST['ownershipid']) && isset($_POST['rename'])){
            $sth->bindValue(':ownership_id',$_POST['ownershipid'], PDO::PARAM_STR);
            $sth->bindValue(':player_id',$_SESSION['id'], PDO::PARAM_STR);
            $sth->execute();
            $usercheck = $sth->fetchAll();
            
            $sth = $dbh->prepare("UPDATE ownership SET nickname=:nick WHERE id=:oid");
            try{
                $sth->bindValue(':oid',$_POST['ownershipid'], PDO::PARAM_INT);
                if(strlen($_POST['rename']) <= 8){
                    $sth->bindValue(':nick',$_POST['rename'], PDO::PARAM_STR);
                } else {
                    echo "Nickname can only be 8 char long";
                    return;
                }
                if ($usercheck[0]['player_id'] == $_SESSION['id']){
                    $sth->execute();
                    echo "<p> Name Changed</p>"; 
                } else {
                    echo "Error, You can only change the nickname of your own parkamon";
                }
            } catch (PDOException $e){
                echo "Error with request";
            }
            echo $_POST['ownershipid'];
            
        } else {
            echo "You forgot to fill something in!";
        }
    ?>
    <a href="game.php">Back to main page</a>
<body>
</html>
