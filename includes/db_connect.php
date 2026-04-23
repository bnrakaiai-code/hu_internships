<?php
$host = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "internships";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "connection failed: " . $e->getMessage();
}
?>