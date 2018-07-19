<html>
<head>
    <title>Parkamon DB</title>
</head>
<body>
<?php
require_once "config.php";
try {
    $dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);

    $query = file_get_contents('./parkamon.sql');
    //https://www.w3schools.com/php/func_filesystem_file_get_contents.asp
    //Reads content of sql file and saves into string to be executed
    $dbh->exec($query);
    // http://php.net/manual/en/pdo.exec.php
    // Runs code and returns affected rows number
    echo "<p>Successfully installed databases</p>";
}
catch (PDOException $e) {
    echo "<p>Error: {$e->getMessage()}</p>";
}
?>
</body>
</html>