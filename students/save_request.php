<?php
session_start();
include('../includes/db_connect.php');

// ตรวจสอบสิทธิ์การเข้าถึง
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_SESSION['user_id'];
    
    // รับค่าข้อมูลบริษัท (เพิ่มการรับค่า company_id จากฟอร์ม)
    $input_company_id = trim($_POST['company_id']); 
    $company_name     = trim($_POST['company_name']);
    $company_address  = trim($_POST['company_address']);
    $contact_person   = trim($_POST['contact_person']);
    
    // รับค่ารายละเอียดการฝึกงาน
    $position_title   = trim($_POST['position_title']);
    $start_date       = $_POST['start_date'];
    $end_date         = $_POST['end_date'];
    $status_id        = 1; // 1 คือ "รอการตรวจสอบ"

    try {
        $conn->beginTransaction();

        // 1. จัดการตาราง companies (เช็คจาก company_id ที่รับมาเป็นหลัก)
        $stmt_check = $conn->prepare("SELECT company_id FROM companies WHERE company_id = :id LIMIT 1");
        $stmt_check->execute([':id' => $input_company_id]);
        $company = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($company) {
            // กรณีมีรหัสบริษัทนี้อยู่แล้ว -> อัปเดตข้อมูลให้เป็นปัจจุบัน
            $stmt_upd = $conn->prepare("UPDATE companies SET company_name = :cname, company_address = :addr, contact_person = :cp WHERE company_id = :id");
            $stmt_upd->execute([
                ':cname' => $company_name,
                ':addr'  => $company_address,
                ':cp'    => $contact_person,
                ':id'    => $input_company_id
            ]);
            $final_company_id = $input_company_id;
        } else {
            // กรณีไม่มีรหัสบริษัทนี้ -> Insert ใหม่ พร้อมระบุ company_id ที่ผู้ใช้กรอก
            $stmt_add_comp = $conn->prepare("INSERT INTO companies (company_id, company_name, company_address, contact_person) 
                                             VALUES (:id, :cname, :addr, :cp)");
            $stmt_add_comp->execute([
                ':id'    => $input_company_id,
                ':cname' => $company_name,
                ':addr'  => $company_address,
                ':cp'    => $contact_person
            ]);
            $final_company_id = $input_company_id;
        }

        // 2. บันทึกข้อมูลลงตาราง internship_requests
        $sql = "INSERT INTO internship_requests (student_id, company_id, position_title, start_date, end_date, status_id, request_date) 
                VALUES (:student_id, :company_id, :position_title, :start_date, :end_date, :status_id, NOW())";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':student_id'     => $student_id,
            ':company_id'     => $final_company_id,
            ':position_title' => $position_title,
            ':start_date'     => $start_date,
            ':end_date'       => $end_date,
            ':status_id'      => $status_id
        ]);

        // หากทุกอย่างผ่านไปได้ด้วยดี ค่อยทำการ Commit ข้อมูลทั้งหมด
        $conn->commit();

        echo "<script>
                alert('ส่งคำร้องขอฝึกงานสำเร็จ!');
                window.location.href = 'index.php'; 
              </script>";

    } catch (Exception $e) {
        // หากมี Error ให้ย้อนกลับ (Rollback) ข้อมูลที่ทำมาทั้งหมด
        $conn->rollBack();
        
        // แสดง Error ที่เข้าใจง่าย และไม่ทำให้หน้าเว็บค้างเป็นหน้าขาว
        echo "<script>
                alert('เกิดข้อผิดพลาดทางฐานข้อมูล: " . addslashes($e->getMessage()) . "');
                window.history.back();
              </script>";
        exit();
    }
}
?>