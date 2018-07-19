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
    $sth = $dbh->prepare("SELECT * FROM parkamon");
    $sth->execute();
    $parkas = $sth->fetchAll(); //an array of arrays
    //$comics[0]['title']
}
catch (PDOException $e) {
    echo "<p>Error connecting to database!</p>" . $e;
}
?>
<table>
<tr>
<td>id</td>
<td>breed</td>
<td>location</td>
<tr>
<?php
echo "<h2>Parkamon</h2>";
foreach ($parkas as $parka) {
    echo "<tr>";
    echo "<td>". $parka["id"] ."</td>";
    echo "<td>". $parka["breed"] ."</td>";
    echo "<td>". $parka["location"] ."</td>";
    echo "</td>";
}
?>
</table>