<?php
session_start();
include('../includes/db_connect.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_SESSION['user_id'];
    $input_company_id = trim($_POST['company_id']); 
    $company_name     = trim($_POST['company_name']);
    $company_address  = trim($_POST['company_address']);
    $contact_person   = trim($_POST['contact_person']);
    $position_title   = trim($_POST['position_title']);
    $start_date       = $_POST['start_date'];
    $end_date         = $_POST['end_date'];
    $status_id        = 1;

    // --- ส่วนการจัดการไฟล์เอกสาร ---
    $document_name = null;
    if (isset($_FILES['request_document']['name']) && $_FILES['request_document']['error'] == 0) {
        $upload_dir = "../uploads/"; // โฟลเดอร์เก็บไฟล์ 
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $document_name = basename($_FILES['request_document']['name']);
        // ตั้งชื่อไฟล์ใหม่ป้องกันซ้ำ: รหัสนิสิต.นามสกุล
        $document_name = str_replace(' ', '_', $document_name);
        $target_path = $upload_dir . $document_name;

        // ตรวจสอบว่ามีไฟล์ชื่อนี้อยู่แล้วหรือไม่ (เพื่อป้องกันการเขียนทับ)
        if (file_exists($target_path)) {
            // ถ้าชื่อซ้ำ ให้เติม timestamp นำหน้าชื่อไฟล์เดิม
            $document_name = time() . "_" . $document_name;
            $target_path = $upload_dir . $document_name;
        }

        if (!move_uploaded_file($_FILES['request_document']['tmp_name'], $target_path)) {
            echo "<script>alert('อัปโหลดไฟล์ไม่สำเร็จ'); window.history.back();</script>";
            exit();
        }
    }

    try {
        $conn->beginTransaction();

        $stmt_check = $conn->prepare("SELECT company_id FROM companies WHERE company_id = :id LIMIT 1");
        $stmt_check->execute([':id' => $input_company_id]);
        $company = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($company) {
            $stmt_upd = $conn->prepare("UPDATE companies SET company_name = :cname, company_address = :addr, contact_person = :cp WHERE company_id = :id");
            $stmt_upd->execute([':cname' => $company_name, ':addr' => $company_address, ':cp' => $contact_person, ':id' => $input_company_id]);
        } else {
            $stmt_add_comp = $conn->prepare("INSERT INTO companies (company_id, company_name, company_address, contact_person) VALUES (:id, :cname, :addr, :cp)");
            $stmt_add_comp->execute([':id' => $input_company_id, ':cname' => $company_name, ':addr' => $company_address, ':cp' => $contact_person]);
        }

        $sql = "INSERT INTO internship_requests (student_id, company_id, position_title, start_date, end_date, request_document, status_id, request_date) 
                VALUES (:student_id, :company_id, :position_title, :start_date, :end_date, :doc, :status_id, NOW())";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':student_id'     => $student_id,
            ':company_id'     => $input_company_id,
            ':position_title' => $position_title,
            ':start_date'     => $start_date,
            ':end_date'       => $end_date,
            ':doc'            => $document_name, // บันทึกชื่อไฟล์ลง DB
            ':status_id'      => $status_id
        ]);

        $conn->commit();
        echo "<script>alert('ส่งคำร้องพร้อมแนบไฟล์สำเร็จ!'); window.location.href = 'index.php';</script>";

    } catch (Exception $e) {
        $conn->rollBack();
        echo "<script>alert('Error: " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
    }
}
?>