<?php
session_start();
require("config.php");
                try {
                    $dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
                } catch (PDOException $e) {
                    echo "<p>Error connecting to database!</p>" . $e;
                }
                if (isset($username)){
                    $sth = $dbh->prepare("SELECT * FROM customers WHERE username =:username");
                    $sth->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
                    $sth->execute();
                    $usr = $sth->fetchAll();
                } else {
                    $_SESSION['err'] = 2;
                    header("Location: /rchang/p2/login.php");
                }
                
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
                                $_SESSION['err'] = 0;
                                header("Location: /rchang/p2/login.php");
                            } 
                            catch (PDOException $e){
                                $_SESSION['err'] = 9;
                                header("Location: /rchang/p2/login.php");
                        }
                    } else {
                        $_SESSION['err'] = 2;
                        header("Location: /rchang/p2/login.php");
                    }
                } else {
                    $_SESSION['err'] = 10;
                    header("Location: /rchang/p2/login.php");
                } 
            ?>
<!doctype html>