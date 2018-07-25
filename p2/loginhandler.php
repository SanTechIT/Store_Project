<?php
session_start();
    require("config.php");
    try {
        $dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
    } catch (PDOException $e) {
        echo "<p>Error connecting to database!</p>" . $e;
    } 
    if(isset($_POST['password']) && isset($_POST['username'])){
        $sth = $dbh->prepare("SELECT * FROM customers WHERE username=:username LIMIT 1");
        $sth->bindValue(':username', $_POST['username']);
        $sth->execute();
        $user = $sth->fetchAll();
    if($_POST['username'] == $user[0]['Username']){
        if(password_verify($_POST['password'], $user[0]['Password'])){
            $_SESSION["loggedIn"] = true;
            $_SESSION["name"] = $user[0]['First_Name'];
            $_SESSION["uid"] = $user[0]['Customer_Id'];
            $_SESSION['isAdmin'] = $user[0]['IsAdmin'];
            $sth = $dbh->prepare("SELECT * FROM Orders WHERE Customers_Customer_Id = :uid AND IsDone = 0 ORDER BY Order_Id DESC LIMIT 1");
            $sth->bindValue(':uid', $_SESSION['uid']);
            $sth->execute();
            $oid = $sth->fetchAll(); 
            if(count($oid) != 1){
                $sth = $dbh->prepare("INSERT INTO Orders (Customers_Customer_Id, IsDone) VALUES (:uid,'0')");
                $sth->bindValue(':uid', $_SESSION['uid']);
                $sth->execute();
                $sth = $dbh->prepare("SELECT * FROM Orders WHERE Customers_Customer_Id = :uid AND IsDone = 0 ORDER BY Order_Id DESC LIMIT 1");
                $sth->bindValue(':uid', $_SESSION['uid']);
                $sth->execute();
                $oid = $sth->fetchAll();
            }
            $_SESSION['oid'] = $oid[0]['Order_Id'];
            header("Location: /rchang/p2/index.php");
        } else {
            $_SESSION['err'] = 1;
            header("Location: /rchang/p2/login.php");
        }
    } else {
        $_SESSION['err'] = 1;
        header("Location: /rchang/p2/login.php");
    }
}
else {
    $_SESSION['err'] = 2;
    header("Location: /rchang/p2/login.php");
}
?>