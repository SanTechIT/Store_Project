<?php
session_start();
if (isset($_SESSION["loggedIn"])){
    
} else {
    $_SESSION["loggedIn"] = false;
}
require("config.php");
try {
    $dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
} catch (PDOException $e) {
    echo "<p>Error connecting to database!</p>" . $e;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Shop </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="/rchang/p2/js/jquery-3.2.1.min.js"></script>
    <script src="/rchang/p2/js/materialize.min.js"></script>
    <link href="/rchang/p2/css/materialize.min.css" rel="stylesheet" type="text/css">
    <link href="/rchang/p2/css/primary.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <nav class="light-green darken-3">
    <h4 class="navtitle"><a href="/rchang/p2/">ATDP Store</a></h4>
        <span class="user">
            <?php
                if($_SESSION['loggedIn'] == true){
                    echo '<a href="/rchang/p2/profile">' . htmlspecialchars($_SESSION["name"]) . '</a>';
                } else {
                    echo '<a href="/rchang/p2/login">Log In</a>';
                }
                
            ?>
        </span>
    </nav>
    <div class="container">
        <div class="row">
        <?php
            $sth = $dbh->prepare("SELECT * FROM Products");
            $sth->execute();
            $products = $sth->fetchAll();
            foreach ($products as $product) {
                echo '<div class="col s10 m6 l4 push-s1 pull-s1"><a href="/rchang/p2/items.php?id=' . $product["Product_Id"]. '"><div class="col-content card"><div class="card-image"><img src="./' . $product["Image_Name"] . '" alt="' . $product["Image_Name"] . '"></div>';
                echo '<div class="card-content"><span class="card-title">' . $product["Product_Name"] . '</span>';
                echo '<p>' . $product["Price"] . '</p>';
                echo '<p> Product Description </p>';
                // echo '<a class="waves-effect waves-light btn-small" style="width:100%;">More Infoam <i class="material-icons">add_shopping_cart</i></a>';
                echo '</div></div></a></div>';
            }
        ?>
    </div>
</div>
</body>
</html>