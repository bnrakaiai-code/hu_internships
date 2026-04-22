<?php
session_start();
include('../includes/db_connect.php');

// ตรวจสอบสิทธิ์
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'teacher' && $_SESSION['role'] !== 'staff')) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าจาก Form
    $request_id = $_POST['request_id'];
    $status_id = $_POST['status_id'];

    try {
        // อัปเดตสถานะในตาราง internship_requests
        // 💡 เช็คให้ชัวร์ว่า Primary Key ชื่อ request_id หรือไม่
        $stmt = $conn->prepare("UPDATE internship_requests SET status_id = :status_id WHERE request_id = :req_id");
        $stmt->execute([
            ':status_id' => $status_id,
            ':req_id'    => $request_id
        ]);

        echo "<script>
                alert('อัปเดตสถานะคำร้องสำเร็จ!');
                window.location.href = 'view_all.php';
              </script>";

    } catch (PDOException $e) {
        // หากเกิด Error ให้แจ้งเตือนและกลับหน้าเดิม
        echo "<script>
                alert('เกิดข้อผิดพลาดในการอัปเดต: " . addslashes($e->getMessage()) . "');
                window.history.back();
              </script>";
    }
} else {
    // ถ้าไม่ได้เข้ามาผ่าน POST ให้เด้งกลับ
    header("Location: view_all.php");
    exit();
}
?>