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
    $dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
    //getting multiple rows
    $sth = $dbh->prepare("SELECT * FROM comic ORDER BY date DESC LIMIT 1");
    $sth->execute();
    $comics = $sth->fetchAll(); //an array of arrays
    //$comics[0]['title']
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
    echo "<img src='http://chalkboardmanifesto.com/{$comic['fileName']}'>";"      
}
?>