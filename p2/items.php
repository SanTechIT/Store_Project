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
            $(document).ready(function() {
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
            <div class="col s12 m9">
            <?php
    if(isset($_SESSION['err'])){
        switch ($_SESSION['err']) {
            case 0:
                break;
            case 6:
                echo "Invalid Input for number<br>";
                break;
            case 2:
                echo "You forgot something><br>";
                break;
            case 7;
                echo "A product with that Id does not exsist<br>";
                break;
            case 8;
                echo "Please Log In First<br>";
                break;
            default;
                echo "Unknown Error <br>";
                break;
        }
    }
    $_SESSION['err']=0;
?>
                <?php
            $sth = $dbh->prepare("SELECT * FROM Products WHERE Product_Id = :id");
            $sth->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
            $sth->execute();
            $products = $sth->fetchAll();
            if(count($products) != 0){
            foreach ($products as $product) {
                echo '<div class="row"><div class="col m7 s12 fill"><img class="materialboxed"  style="width:100%; margin-top:7px; z-index:1;" src="./' . $product["Image_Name"] . '" alt="' . $product["Image_Name"] . '"></div>';
                // echo '<div class="card-image"><img src="./' . $product["Image_Name"] . '" alt="' . $product["Image_Name"] . '">';
                echo '<div class="col m4 s12 card" style="z-index:0;"> <div class="card-content">
                ' . $product["Product_Description"] . '</p></div></div>';
                // echo '<a class="waves-effect waves-light btn-small" style="width:100%;">More Infoam <i class="material-icons">add_shopping_cart</i></a>';
                echo '<div>';
                echo '</div>';
                echo     '</div>';
                echo     '</div>';
                echo '<div class="col m3 hide-on-small-only blue-grey lighten-4 addcartbox">';
                echo     '<div class="row">';
                echo         '<div class="col s12">';
                echo '<h5 style="display:inline-block">' . $product["Product_Name"] . ' - ' . '</h5>';
                echo '<h6 style="display:inline-block"> &nbsp;' . $product["Price"] . '</h6>';
                echo         '</div>';
                echo         '<div class="col s12">';
                echo '<form action="addCart.php" method="post">';
                echo '  <input type="hidden" id="Order_Item" name="Order_Item" value="' . $_GET['id'] . '">';
                echo '  <input type="number" id="Amount" name="Amount" value="1">';
                echo             '<label><input type="submit" value="submit" class="waves-effect waves-light btn" style="width:100%;"></label>';
                echo '</form>';
                echo         '</div>';
                echo     '</div>';
                echo    '</div>';
                echo '</div>';
                echo'</div>';
                echo '<div class="row">';
                echo '<div class="col s12 card hide-on-med-and-up">';
                echo     '<div class="card-content">';
                echo '<p>' . $product["Price"] . '</p>';
                echo '<p> Rating: ' . $product["Rating"] . '</p>';
                echo     '</div>';
                echo '</div>';
                echo     '</div> ';
                echo    '<div class="row">';
                echo '<div class="col hide-on-med-and-up s12 blue-grey lighten-4 addcartboxm" style="padding:0;">';
                echo     '<a class="waves-effect waves-light btn" style="width:100%;">PLEASE DO NOT USE THE MOBILE SITE!<i class="material-icons left">add_shopping_cart</i></a>';
                echo '</div>';
                echo     '</div>';
            } 
        }
        else {
            echo "<h2>Error! A Product with this Id does not exsist!</h2>";
        }
    ?>
    </body>

    </html>
