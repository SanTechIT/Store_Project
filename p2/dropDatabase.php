<html>
<head>
    <title>Drop Chalkboard Manifesto DB</title>
</head>
<body>
<?php
require_once "config.php";

try {
    $dbh = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
    $dbh->exec('DROP TABLE Customers; DROP TABLE Products; DROP TABLE Orders; DROP TABLE Order_Items; DROP TABLE Orders_Order_Id; DROP TABLE Types;');
    echo "<p>Successfully dropped databases</p>";
}
catch (PDOException $e) {
    echo "<p>Error: {$e->getMessage()}</p>";
}
?>
</body>
</html>