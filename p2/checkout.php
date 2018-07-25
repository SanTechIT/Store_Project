<?php
session_start();
if (isset($_SESSION["loggedIn"])){
    if($_SESSION["loggedIn"]) {

    } else {
        header("Location: /rchang/p2/login.php");
    }
} else {
    $_SESSION["loggedIn"] = false;
    header("Location: /rchang/p2/login.php");
}
require("config.php");
try {
    $dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
} catch (PDOException $e) {
    echo "<p>Error connecting to database!</p>" . $e;
}
$sth = $dbh->prepare("UPDATE Orders SET IsDone = 1 WHERE Orders_Order_Id = :oid");
$sth->bindValue(':oid', $_SESSION['oid']);
$sth->execute();
$sth = $dbh->prepare("INSERT INTO Orders (Customers_Customer_Id, IsDone) VALUES (:uid,'0')");
$sth->bindValue(':uid', $_SESSION['uid']);
$sth->execute();
$sth = $dbh->prepare("SELECT * FROM Orders WHERE Customers_Customer_Id = :uid AND IsDone = 0 ORDER BY Order_Id DESC LIMIT 1");
$sth->bindValue(':uid', $_SESSION['uid']);
$sth->execute();
$oid = $sth->fetchAll(); 

$_SESSION['oid'] = $oid[0]['Order_Id'];
header("Location: /rchang/p2/index.php");
?>