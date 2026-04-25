<?php
session_start();
include('../../includes/db_connect.php');

// 1. ตรวจสอบสิทธิ์ Admin/Staff
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'staff' && $_SESSION['role'] !== 'admin')) {
    header("Location: ../../login.php");
    exit();
}

// 2. ตรวจสอบว่ามีการส่งข้อมูลแบบ POST มาหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // รับค่าจากฟอร์ม
    $request_id = $_POST['request_id'] ?? null;
    $status_id = $_POST['status_id'] ?? null;

    // ตรวจสอบว่าค่าไม่ว่างเปล่า
    if (!empty($request_id) && $status_id !== null && $status_id !== '') {
        try {
            // 3. อัปเดตสถานะในตาราง internship_requests
            $stmt = $conn->prepare("UPDATE internship_requests SET status_id = :status_id WHERE request_id = :request_id");
            $stmt->bindParam(':status_id', $status_id, PDO::PARAM_INT);
            $stmt->bindParam(':request_id', $request_id, PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                $_SESSION['message'] = "อัปเดตสถานะคำร้องเรียบร้อยแล้ว";
                $_SESSION['msg_type'] = "success";
            } else {
                $_SESSION['message'] = "ไม่สามารถอัปเดตสถานะได้";
                $_SESSION['msg_type'] = "danger";
            }
        } catch (PDOException $e) {
            $_SESSION['message'] = "เกิดข้อผิดพลาดฐานข้อมูล: " . $e->getMessage();
            $_SESSION['msg_type'] = "danger";
        }
    } else {
        $_SESSION['message'] = "ข้อมูลไม่ครบถ้วน กรุณาเลือกสถานะ";
        $_SESSION['msg_type'] = "warning";
    }

    // 4. เช็คว่าส่งมาจากหน้าไหน เพื่อให้ Redirect กลับไปหน้าเดิม
    // ถ้าไม่มีค่าอ้างอิงให้กลับไปที่ index.php เป็นค่าเริ่มต้น
    $referer = $_SERVER['HTTP_REFERER'] ?? 'index.php';
    header("Location: " . $referer);
    exit();

} else {
    // ถ้าไม่ได้เข้ามาด้วย POST ให้กลับไปที่หน้า Dashboard
    header("Location: index.php");
    exit();
}
?>