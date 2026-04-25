<?php
session_start();
include('../../includes/db_connect.php');

// เช็คสิทธิ์ Admin/Staff เท่านั้น
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'staff' && $_SESSION['role'] !== 'admin')) {
    die("Access Denied");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_id = $_POST['request_id'];
    $status_id = $_POST['status_id']; // รับค่าจาก Select menu ในหน้า view_all.php
    $user_id = $_SESSION['user_id'];

    try {
        $sql = "UPDATE internship_requests 
                SET status_id = :status, 
                    action_by = :action_by, 
                    action_date = NOW() 
                WHERE request_id = :req_id";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':status' => $status_id,
            ':action_by' => $user_id,
            ':req_id' => $request_id
        ]);

        echo "<script>alert('อัปเดตสถานะโดยแอดมินเรียบร้อย'); window.location='view_all.php';</script>";
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}