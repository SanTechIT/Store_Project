<?php
session_start();
if (isset($_SESSION['isAdmin'])){
    if($_SESSION['isAdmin']){
    } else {
        $_SESSION['err'] = 99;
        header("Location: /rchang/p2/index.php");
        exit();
    }
    }
require("config.php");
try {
    $dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
} catch (PDOException $e) {
    echo "<p>Error connecting to database!</p>" . $e;
}

if(isset($_SESSION['err'])){
    switch ($_SESSION['err']) {
        case 0:
            break;
        case 2:
            echo "You forgot something...<br>";
            break;
        case 9:
            echo "Sql Error<br>";
            break;
        default;
            echo "Unknown Error <br>";
            break;
    }
    $_SESSION['err'] = 0;
}

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Page</title>
    <script src="/rchang/p2/js/jquery-3.2.1.min.js"></script>
    <script src="/rchang/p2/js/materialize.min.js"></script>
    <link href="/rchang/p2/css/materialize.min.css" rel="stylesheet" type="text/css">
    <link href="/rchang/p2/css/primary.css" rel="stylesheet" type="text/css">
</head>
<body>
    <nav class="light-green darken-3">
    <h4 class="navtitle"><a href="/rchang/p2/">ATDP Store</a></h4>
        <span class="float-right user"><a href="./store.php">Browse</a></span>
    </nav>
    <div class="container content float-none">
    <div class="card">
    <div class="card-content">
    <span class="card-title">Add Items</span>
    <h6>Please dont be an idiot, there is not a easy way to check decimal places that I know of</h6>
        <form action="additem.php" method="POST">
            <input placeholder="Product_Name" name="Product_Name" type="text" required>
            <input placeholder="Image_Name" name="Image_Name" type="text" required>
            <input placeholder="Price (12 Percision 2 Decimal)" name="Price" type="number" step="0.01" required>
            <input placeholder="Rating (2 Percision 1 Decimal)"name="Rating" type="number" step="0.1" required>
            <input placeholder="Product_Description"name="Product_Description" type="text" required>
            <label><input type="submit" value="submit" class="waves-effect waves-light btn fwid"></label>
        </form>
    </div>
    </div>
    </div>
</body>
</html>