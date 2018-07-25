<?php
session_start();

                require("config.php");
                try {
                    $dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
                } catch (PDOException $e) {
                    echo "<p>Error connecting to database!</p>" . $e;
                } if($_SESSION['loggedIn'] == true){
                if(isset($_POST['Order_Item']) && isset($_POST['Amount'])){
                    if($_POST['Amount'] > 0){
                        $sth = $dbh->prepare("SELECT * FROM Products WHERE Product_Id =:pid");
                        $sth->bindValue(':pid', $_POST['Order_Item'], PDO::PARAM_STR);
                        $sth->execute();
                        $check = $sth->fetchAll();
                        if(count($check) != 0){
                            $sth = $dbh->prepare("INSERT INTO Order_Items (Products_Product_Id, Amount, Total_Price, Orders_Order_Id) VALUES (:pid,:am,:tp,:oid)");
                            $sth->bindValue(':pid', $_POST['Order_Item'], PDO::PARAM_STR);
                            $sth->bindValue(':am', $_POST['Amount'], PDO::PARAM_STR);
                            $total = $check[0]['Price'] * $_POST['Amount'];
                            $sth->bindValue(':tp', $total, PDO::PARAM_INT);
                            $sth->bindValue(':oid', $_SESSION['oid'], PDO::PARAM_STR);
                            $sth->execute();
                            $_SESSION['err'] = 0;
                            if (isset($_SERVER['HTTP_REFERER'])){
                                header("Location: {$_SERVER['HTTP_REFERER']}");
                            } else {
                                header("Location: /rchang/p2/index.php");
                            }
                            
                        } else {
                            $_SESSION['err'] = 7;
                            if (isset($_SERVER['HTTP_REFERER'])){
                                header("Location: {$_SERVER['HTTP_REFERER']}");
                            } else {
                                header("Location: /rchang/p2/index.php");
                            }
                        }
                    }
                    else {
                        $_SESSION['err'] = 6;
                        if (isset($_SERVER['HTTP_REFERER'])){
                            header("Location: {$_SERVER['HTTP_REFERER']}");
                        } else {
                            header("Location: /rchang/p2/index.php");
                        }
                    }
                
                } else {
                    $_SESSION['err'] = 2;
                    if (isset($_SERVER['HTTP_REFERER'])){
                        header("Location: {$_SERVER['HTTP_REFERER']}");
                    } else {
                        header("Location: /rchang/p2/index.php");
                    }
                } 
            }else {
                    $_SESSION['err'] = 8;
                    if (isset($_SERVER['HTTP_REFERER'])){
                        header("Location: {$_SERVER['HTTP_REFERER']}");
                    } else {
                        header("Location: /rchang/p2/index.php");
                    }
                }
            ?>