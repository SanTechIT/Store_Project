<!doctype html>
<html>
<head>
    <title> Comics </title>
    <link href="./primary.css" rel="stylesheet" type="text/css">
</head>
<body>

</body>
</html>

<?php
require 'config.php';

try {
    $dbha = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
    $stha = $dbha->prepare("SELECT * FROM comic ORDER BY date DESC LIMIT 1");
    $stha->execute();
    $sthength = $stha->fetchAll();
    $dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
    //getting multiple rows
    if(isset($_GET["id"])){
        if(filter_var($_GET["id"],FILTER_VALIDATE_INT)){
            if(isset($_GET["id"]) && ($_GET["id"] > 0) && ($_GET["id"] < ($sthength[0]["comicID"] + 1))){
                $sth = $dbh->prepare("SELECT * FROM comic WHERE comicID=:cid");
                $sth->bindValue(":cid",$_GET["id"]);
            } else {
                echo "Error: Comic with that id is not found, instead showing latest";
                $sth = $dbh->prepare("SELECT * FROM comic ORDER BY date DESC LIMIT 1");
            }
        } else {
            echo "Error, Id is not a int, instead showing latest";
            $sth = $dbh->prepare("SELECT * FROM comic ORDER BY date DESC LIMIT 1");
        } 
        
        
    } else {    
        $sth = $dbh->prepare("SELECT * FROM comic ORDER BY date DESC LIMIT 1");
    }
    
    $sth->execute();
    $comics = $sth->fetchAll(); //an array of arrays
}
catch (PDOException $e) {
    echo "<p>Error connecting to database!</p>";
}
echo "<h2>Comics</h2>";
foreach ($comics as $comic) {
    $date = new DateTime($comic['date']);
    $dateFormat = $date->format("m/d/Y");
    echo "<p>".$comic['title']."</p>"; 
    echo "<p>". $dateFormat ."</p>";
    echo "<img src='http://chalkboardmanifesto.com/{$comic['fileName']}'>";      
    $nextId = $_GET['id'] + 1;
    $prevId = $_GET['id'] - 1;
    echo "<br>";
    if($nextId <= $sthength[0]["comicID"]){
        echo '<a href="comic.php?id=' . $nextId . '">Next</a><br>';
    }
    if($prevId >= 0){
        echo '<a href="comic.php?id=' . $prevId . '">Previous</a><br>';
    }
    echo'<a href="archive.php">Archive</a>';
    
}
?>