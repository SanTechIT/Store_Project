<?php
session_start();
require("config.php");
if (isset($_SESSION['isAdmin'])){
if($_SESSION['isAdmin']){
} else {
    $_SESSION['err'] = 99;
    header("Location: /rchang/p2/index.php");
    exit();
}
}
try {
    $dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
} catch (PDOException $e) {
    echo "<p>Error connecting to database!</p>" . $e;
}
    if(isset($_POST['Product_Name']) && isset($_POST['Price']) && isset($_POST['Rating']) && isset($_POST['Product_Description']) && isset($_POST['Image_Name'])){
        $sth = $dbh->prepare("INSERT INTO Products (Product_Name, Price, Image_Name, Rating, Product_Description) VALUES (:Product_Name, :Price, :Image_Name, :Rating, :Product_Description);");
            try {
                $sth->bindValue(':Product_Name', $_POST['Product_Name'], PDO::PARAM_STR);
                $sth->bindValue(':Price', $_POST['Price'], PDO::PARAM_INT);
                $sth->bindValue(':Rating', $_POST['Rating'],PDO::PARAM_INT);
                $sth->bindValue(':Product_Description', $_POST['Product_Description'], PDO::PARAM_STR);
                $sth->bindValue(':Image_Name', $_POST['Image_Name'], PDO::PARAM_STR);
                $sth->execute();
                $_SESSION['err'] = 0;
                header("Location: /rchang/p2/admin.php");
            } 
            catch (PDOException $e){
                $_SESSION['err'] = 9;
                header("Location: /rchang/p2/admin.php");
        }
    } else {
        $_SESSION['err'] = 2;
        header("Location: /rchang/p2/admin.php");
    }
?>