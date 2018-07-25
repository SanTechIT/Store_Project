<?php
session_start();
if($_SESSION['isAdmin']){
    echo '<a href="/rchang/p2/admin.php"> Admin Page</a>';
} else {
    header("Location: /rchang/p2/index.php");
}

require("config.php");
try {
    $dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
} catch (PDOException $e) {
    echo "<p>Error connecting to database!</p>" . $e;
}
?>