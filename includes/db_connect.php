<?php
$host = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "internships";

try {
    // แก้คำว่า dpname เป็น dbname เรียบร้อยแล้วครับ
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "connection failed: " . $e->getMessage();
}
?>