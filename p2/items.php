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
    <Script>
        $(document).ready(function(){
    $('.materialboxed').materialbox();
  })
        </script>
</head>
<body>
    <nav class="light-green darken-3">
    <h4 class="navtitle"><a href="/rchang/p2/">ATDP Store</a></h4>
        <span class="user float-right">
            <?php
                if($_SESSION['loggedIn'] == true){
                    echo '<a href="/rchang/p2/profile">' . htmlspecialchars($_SESSION["name"]) . '</a>';
                } else {
                    echo '<a href="/rchang/p2/login">Log In</a>';
                }
                
            ?>
        </span>
    </nav>
        <div class="row content" class="float:none;">
        <div class="col s12 m9" style="margin-top:7px;">
        <?php
            $sth = $dbh->prepare("SELECT * FROM Products WHERE Product_Id = :id");
            $sth->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
            $sth->execute();
            $products = $sth->fetchAll();
            foreach ($products as $product) {
                echo '<div class="row"><div class="col m7 s12 fill"><img class="materialboxed"  style="width:100%" src="./' . $product["Image_Name"] . '" alt="' . $product["Image_Name"] . '"></div>';
                // echo '<div class="card-image"><img src="./' . $product["Image_Name"] . '" alt="' . $product["Image_Name"] . '">';
                echo '<div class="col m4 s12"> 
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sit amet sem a enim mollis fringilla. Proin vestibulum consectetur tempor. Donec et diam fermentum, lacinia nibh vel, venenatis dolor. Praesent et risus nulla. Aliquam volutpat odio lorem, in dapibus ante efficitur quis. Duis congue magna vel pharetra aliquet. Morbi et eros pharetra, ornare ipsum vitae, convallis lacus. Morbi convallis pretium lacus, ut malesuada quam suscipit ut.
                Curabitur id massa eget augue pulvinar ullamcorper sed eget felis. Vestibulum dignissim odio neque. Morbi pretium nisi tellus, eget gravida augue malesuada suscipit. Nam eget diam in magna volutpat rutrum nec condimentum ligula. Aenean quis commodo tortor. Quisque viverra eget ligula quis pharetra. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aenean gravida cursus nisi a aliquet. Suspendisse vel justo ac nisl vehicula imperdiet. Mauris pulvinar dolor sed nunc rhoncus, vel fringilla leo blandit. Mauris in turpis orci. Donec finibus orci ut felis rhoncus vulputate. 
                </p></div>';
                // echo '<a class="waves-effect waves-light btn-small" style="width:100%;">More Infoam <i class="material-icons">add_shopping_cart</i></a>';
                echo '<div>';
            }
        ?>
    </div>
        </div>
        </div>
    <div class="col m3 hide-on-small-only blue-grey lighten-4 addcartbox">
        <div class="row">
            <div class="col s12">
            <?php
                echo '<h5 style="display:inline-block">' . $product["Product_Name"] . ' - ' . '</h5>';
                echo '<h6 style="display:inline-block"> &nbsp;' . $product["Price"] . '</h6>';
            ?>
            </div>
            <div class="col s12">
                <a class="waves-effect waves-light btn" style="width:100%;">Add to cart<i class="material-icons left">add_shopping_cart</i></a>
            </div>
        </div>
        </div>
    </div>
    </div>
    <div class="row">
    <div class="col s12 card hide-on-med-and-up">
        <div class="card-content">
        <?php
        echo '<p>' . $product["Price"] . '</p>';
        echo '<p> Rating: ' . $product["Rating"] . '</p>';
        ?>
        </div>
    </div>
        
        </div> 
        <div class="row">
    <div class="col hide-on-med-and-up s12 blue-grey lighten-4 addcartboxm" style="padding:0;">
        <a class="waves-effect waves-light btn" style="width:100%;">Add to cart<i class="material-icons left">add_shopping_cart</i></a>
    </div>
        </div>
</body>
</html>