<?php
session_start();
include('../../includes/db_connect.php');

// 1. ตรวจสอบสิทธิ์ (Admin, Staff, หรือ Teacher)
if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['staff', 'admin', 'teacher'])) {
    header("Location: ../../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_id = $_POST['request_id'];
    $new_status_id = $_POST['status_id'];
    $action_by = $_SESSION['username']; // ดึงชื่อผู้ใช้งานที่ทำการล็อกอินอยู่

    try {
        // เริ่มต้น Transaction เพื่อให้แน่ใจว่าต้องสำเร็จทั้งคู่ (Update และ Log)
        $conn->beginTransaction();

        // 2. ดึงสถานะปัจจุบัน (Old Status) มาเก็บไว้ก่อน
        $stmt_old = $conn->prepare("SELECT status_id FROM internship_requests WHERE request_id = :request_id");
        $stmt_old->execute([':request_id' => $request_id]);
        $old_status = $stmt_old->fetchColumn();

        // 3. อัปเดตสถานะใหม่ในตาราง internship_requests
        $sql_update = "UPDATE internship_requests SET status_id = :new_status WHERE request_id = :request_id";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->execute([
            ':new_status' => $new_status_id,
            ':request_id' => $request_id
        ]);

        // 4. บันทึกประวัติลงในตาราง status_log ตามโครงสร้างที่คุณส่งมา
        $sql_log = "INSERT INTO status_log (request_id, action_by, old_status_id, new_status_id, changed_at) 
                    VALUES (:request_id, :action_by, :old_status, :new_status, NOW())";
        $stmt_log = $conn->prepare($sql_log);
        $stmt_log->execute([
            ':request_id'   => $request_id,
            ':action_by'    => $action_by,
            ':old_status'   => $old_status,
            ':new_status'   => $new_status_id
        ]);

        // ยืนยันการทำงานทั้งหมด
        $conn->commit();

        echo "<script>
                alert('อัปเดตสถานะและบันทึกประวัติเรียบร้อยแล้ว');
                window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';
              </script>";

    } catch (Exception $e) {
        // หากเกิดข้อผิดพลาด ให้ยกเลิกสิ่งที่ทำมาทั้งหมดใน Transaction นี้
        $conn->rollBack();
        echo "<script>
                alert('เกิดข้อผิดพลาด: " . addslashes($e->getMessage()) . "');
                window.history.back();
              </script>";
    }
} else {
    header("Location: index.php");
    exit();
}