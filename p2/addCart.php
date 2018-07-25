<?php
session_start();

                require("config.php");
                try {
                    $dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
                } catch (PDOException $e) {
                    echo "<p>Error connecting to database!</p>" . $e;
                } if($_SESSION['LoggedIn']){
                if(isset($_POST['Order_Item']) && isset($_POST['Amount'])){
                    if($_POST['Amount'] > 0){
                        $sth = $dbh->prepare("SELECT * FROM Products WHERE Product_Id =:pid");
                        $sth->bindValue(':pid', $_POST['Order_Item'], PDO::PARAM_STR);
                        $sth->execute();
                        $check = $sth->fetchAll();
                        var_dump($_SESSION);
                        if(count($check) != 0){
                            $sth = $dbh->prepare("INSERT INTO Order_Items (Products_Product_Id, Amount, Total_Price, Orders_Order_Id) VALUES (:pid,:am,:tp,:oid)");
                            $sth->bindValue(':pid', $_POST['Order_Item'], PDO::PARAM_STR);
                            $sth->bindValue(':am', $_POST['Amount'], PDO::PARAM_STR);
                            $total = $check[0]['Price'] * $_POST['Amount'];
                            echo $total;
                            $sth->bindValue(':tp', $total, PDO::PARAM_INT);
                            $sth->bindValue(':oid', $_SESSION['oid'], PDO::PARAM_STR);
                            $sth->execute();
                            $_SESSION['err'] = 0;
                            header("Location: {$_SERVER['HTTP_REFERER']}");
                        } else {
                            $_SESSION['err'] = 7;
                    header("Location: {$_SERVER['HTTP_REFERER']}");
                        }
                    }
                    else {
                        $_SESSION['err'] = 6;
                    header("Location: {$_SERVER['HTTP_REFERER']}");
                    }
                
                } else {
                    $_SESSION['err'] = 2;
                    header("Location: {$_SERVER['HTTP_REFERER']}");
                } 
            }else {
                    $_SESSION['err'] = 8;
                    header("Location: {$_SERVER['HTTP_REFERER']}");
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
    <h4 class="navtitle"><a href="/rchang/p2/">Adding to Cart...</a></h4>
        <span class="user float-right">
            <?php
            var_dump($_POST);
            ?>
        </span>
    </nav>
</body>
</html>