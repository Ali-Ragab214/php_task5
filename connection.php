<?php
$dbname = "users";
$dbtype = "mysql";
$host = "localhost";
$username = "root";
$password = "";

try {
    $connection = new PDO("$dbtype:host=$host;dbname=$dbname", $username, $password);
    session_start();
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}   


$query = "select * from users";
$sqlquery = $connection->prepare($query);
$sqlquery->execute();
$data = $sqlquery->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
print_r($data);
echo "</pre>";


?>