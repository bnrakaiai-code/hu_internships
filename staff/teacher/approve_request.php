<?php
session_start();
include('../../includes/db_connect.php');

// เช็คสิทธิ์ความปลอดภัย
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'teacher' && $_SESSION['role'] !== 'staff')) {
    header("Location: ../../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_id = $_POST['request_id'];
    $action = $_POST['action'];

    // กำหนดสถานะเป้าหมาย
    if ($action === 'approve') {
        $new_status = 2; // อนุมัติโดยอาจารย์ -> ส่งต่อให้รอ Admin ดำเนินการ (status_id = 2)
        $msg = "อนุมัติคำร้องหมายเลข " . sprintf("%03d", $request_id) . " เรียบร้อยแล้ว (ส่งต่อให้ Admin)";
    } elseif ($action === 'reject') {
        $new_status = 4; // ปฏิเสธคำร้อง (status_id = 4)
        $msg = "ปฏิเสธคำร้องหมายเลข " . sprintf("%03d", $request_id) . " เรียบร้อยแล้ว";
    }

    try {
        // อัปเดตข้อมูลในตาราง internship_requests
        $stmt = $conn->prepare("UPDATE internship_requests SET status_id = :status WHERE request_id = :req_id");
        $stmt->bindParam(':status', $new_status, PDO::PARAM_INT);
        $stmt->bindParam(':req_id', $request_id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            $_SESSION['message'] = $msg;
        } else {
            $_SESSION['message'] = "เกิดข้อผิดพลาดในการอัปเดตข้อมูล";
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = "Error: " . $e->getMessage();
    }

    // กลับไปหน้า Dashboard
    header("Location: index.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}