<?php
session_start();
if (isset($_SESSION["loggedIn"])){
    if($_SESSION["loggedIn"]){
        $_SESSION['erc'] = 0;
    } else {
        $_SESSION['erc'] = 3;
        header("Location: /rchang/parkamon2/signin.php");
    }
} else {
    $_SESSION["loggedIn"] = false;
    $_SESSIO["name"] = "";
    $_SESSION['erc'] = 3;
    header("Location: /rchang/parkamon2/signin.php");
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
<title> Gotta coatch them all </title>
<link href="/rchang/p2/css/materialize.min.css" rel="stylesheet" type="text/css">
<link href="/rchang/p2/js/materialize.min.js" rel="stylesheet" type="text/css">
</head>
<body class="container">
<h4>Welcome <?php 
if (isset($_SESSION['name'])){
    echo htmlspecialchars($_SESSION['name']);
} else {
    echo "<p>Please Log In </p>";
    $shouldLoad = false;
}
?>
</h4>
<?php
$sth = $dbh->prepare("SELECT *, ownership.id AS ownership_id FROM ownership JOIN player ON ownership.player_id = player.id JOIN parkamon ON ownership.parkamon_id = parkamon.id WHERE player_id = :player_id ORDER BY name ASC, breed ASC");
$sth->bindValue(':player_id', $_SESSION['id'], PDO::PARAM_INT);

$sth->execute();
$owned = $sth->fetchAll();

?>
<form action="catch.php">
<input class="btn waves-effect waves-light" type="submit" value="Catch" name="action"> </input>
</form>
<h4>Rename Your Parkamon</h4>
<form action="rename.php" method="POST">
    <select name="ownershipid" class="browser-default" required>
    <option value="" disabled selected>Choose your option</option>
    <?php
    foreach ($owned as $own) {
        echo '<option value='. $own['ownership_id'] .'>' . $own['name'] . " - " . $own['breed'] . '</options>';
    }
    ?>
    </select>
    Change nickname to: <input type="text" name="rename" required><br>
    <input class="btn waves-effect waves-light" type="submit" value="Rename" name="action"> </input>
</form>
<br><br>
<h4> Owned Parkamon </h4>
<table>
<tr>
<td>
Player
</td>
<td>
Parkamon
</td>
<td>
Location
</td>
<td>
Nickname
</td>
</tr>
<?php
$sth = $dbh->prepare("SELECT * FROM ownership JOIN player ON ownership.player_id = player.id JOIN parkamon ON ownership.parkamon_id = parkamon.id WHERE player_id = :player_id ORDER BY name DESC, breed ASC");
$sth->bindValue(':player_id', $_SESSION['id'], PDO::PARAM_INT);
$sth->execute();
$owned = $sth->fetchAll();

foreach ($owned as $own) {
    echo "<tr>";
    echo "<td>" . $own['name'] . "</td>";
    echo "<td>" . $own['location'] . "</td>";
    echo "<td>" . $own['breed'] . "</td>";
    echo "<td>" . htmlspecialchars($own['nickname']) . "</td>";
    echo "</tr>";
}
?>
</table>
<form action="signin.php" method="POST">
    <input class="btn waves-effect waves-light" type="submit" value="logout" name="logout"> </input>
</form>
<body>
</html>
