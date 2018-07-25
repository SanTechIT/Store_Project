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
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="/rchang/p2/js/jquery-3.2.1.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="/rchang/p2/js/materialize.min.js"></script>
    <link href="/rchang/p2/css/materialize.min.css" rel="stylesheet" type="text/css">
    <link href="/rchang/p2/css/primary.css" rel="stylesheet" type="text/css"></head>
<body>
    <nav class="light-green darken-3">
    <h4 class="navtitle"><a href="/rchang/p2/">ATDP Store</a></h4>
        <span class="user float-right">
            <?php
                if($_SESSION['loggedIn'] == true){
                    echo '<a href="/rchang/p2/profile.php">' . htmlspecialchars($_SESSION["name"]) . '</a>';
                } else {
                    echo '<a href="/rchang/p2/login.php">Log In</a>';
                }
            ?>
        </span>
        <span class="float-right browsebutton"><a href="./store.php">Browse</a></span>
    </nav>
    <div class="container content" "float:none;">
        <a href="/rchang/p2/logouthandler.php">Logout</a>
        <?php 
            $sth = $dbh->prepare("SELECT * FROM Orders JOIN Customers ON Orders.Customers_Customer_Id = Customers.Customer_Id JOIN Order_Items ON Order_Items.Orders_Order_Id = Orders.Order_Id JOIN Products ON Products.Product_Id = Order_Items.Products_Product_Id WHERE Customers_Customer_Id = :uid AND Orders_Order_Id = :oid ORDER BY Order_Id ASC");
            $sth->bindValue(':uid', $_SESSION['uid']);
            $sth->bindValue(':oid', $_SESSION['oid']);
            $sth->execute();
            $orders = $sth->fetchAll();
            echo '<table class="white-text">';
            echo '<tr><td>Order #</td><td>Product</td><td>Desc</td><td>Amount</td><td>Total</td></tr>';
            foreach ($orders as $order) {
                echo '<tr>';
                echo '<td>' . $order["Order_Id"] . '</td>';
                echo '<td>' . $order["Product_Name"] . '</td>';
                echo '<td>' . $order["Product_Description"] . '</td>';
                echo '<td>' . $order["Amount"] . '</td>';
                echo '<td>' . $order["Total_Price"] . '</td>';
                echo '</tr>';
            }
            
            $sth = $dbh->prepare("SELECT * FROM Order_Items WHERE Orders_Order_Id = :oid");
            $sth->bindValue(':oid', $_SESSION['oid']);
            $sth->execute();
            $orderscalc = $sth->fetchAll();
            $total = 0.00;
            foreach ($orderscalc as $orderc) {
                $total += $orderc['Total_Price']; 
            }
            echo '<tr>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td>Total: $' . $total . '</td>';
                echo '</tr>';
            echo '</table>';
            echo '<form method="POST" action="checkout.php"><label><input type="submit" value="Checkout" class="waves-effect waves-light btn"></label></form>';
            echo '<h4> Order History </h4>';
            $sth = $dbh->prepare("SELECT * FROM Orders JOIN Customers ON Orders.Customers_Customer_Id = Customers.Customer_Id JOIN Order_Items ON Order_Items.Orders_Order_Id = Orders.Order_Id JOIN Products ON Products.Product_Id = Order_Items.Products_Product_Id WHERE Customers_Customer_Id = :uid");
            $sth->bindValue(':uid', $_SESSION['uid']);
            $sth->execute();
            $orders = $sth->fetchAll();
            echo '<table class="white-text">';
            echo '<tr><td>Order #</td><td>Product</td><td>Desc</td><td>Amount</td><td>Total</td></tr>';
            foreach ($orders as $order) {
                echo '<tr>';
                echo '<td>' . $order["Order_Id"] . '</td>';
                echo '<td>' . $order["Product_Name"] . '</td>';
                echo '<td>' . $order["Product_Description"] . '</td>';
                echo '<td>' . $order["Amount"] . '</td>';
                echo '<td>' . $order["Total_Price"] . '</td>';
                echo '</tr>';
            }
        ?>
    </div>
</body>
</html>