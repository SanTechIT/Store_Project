<?php
session_start();
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
        <a href="/rchang/p2/logouthandler.php">Logout</a>
    </div>
</body>
</html>