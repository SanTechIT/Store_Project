<?php
session_start();
if($_SESSION['isAdmin']){
} else {
    header("Location: /rchang/p2/index.php");
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
        default;
            echo "Unknown Error <br>";
            break;
    }
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
    <div class="content float-none">
    </div>
</body>
</html>