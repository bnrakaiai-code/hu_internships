<?php
session_start();
// เรียกใช้ไฟล์เชื่อมต่อฐานข้อมูล (แบบ PDO)
include('includes/db_connect.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $table = "";
    $user_column = "";
    $redirect_page = "";
    $role_condition = ""; // เพิ่มตัวแปรเช็ค Role ในตาราง staff

    // 1. กำหนดตารางและเงื่อนไขตามโครงสร้าง Database จริง
    if ($role == 'student') {
        $table = "students";
        $user_column = "student_id";    
        $redirect_page = "students/index.php";  
    } elseif ($role == 'admin') {
        $table = "staff";               
        $user_column = "role";
        $role_condition = "AND role = 'admin'"; 
        $redirect_page = "staff/admin/index.php"; 
    } elseif ($role == 'teacher') {
        $table = "staff";               
        $user_column = "username";
        $role_condition = "AND role = 'teacher'"; 
        $redirect_page = "staff/teacher/index.php"; 
    } else {
        $_SESSION['error'] = "ประเภทผู้ใช้งานไม่ถูกต้อง";
        header("Location: login.php");
        exit();
    }

    try {
        // 2. ค้นหาข้อมูล
        $sql = "SELECT * FROM $table WHERE $user_column = :username $role_condition";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        
        // 3. ตรวจสอบรหัสผ่านแบบข้อความธรรมดา
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            
            if (trim($password) == trim($row['password'])) { 
                // ล็อกอินสำเร็จ!
                $_SESSION['user_id'] = $row[$user_column];
                $_SESSION['role'] = $role;
                $_SESSION['fullname'] = $row['fullname']; // เก็บชื่อไว้แสดงผลได้ด้วย
                
                header("Location: " . $redirect_page);
                exit();
            } else {
                $_SESSION['error'] = "รหัสผ่านไม่ถูกต้อง";
                header("Location: login.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "ไม่พบชื่อผู้ใช้งาน หรือเลือกประเภทผู้ใช้งานผิด";
            header("Location: login.php");
            exit();
        }
    } catch(PDOException $e) {
        $_SESSION['error'] = "ระบบฐานข้อมูลขัดข้อง: " . $e->getMessage();
        header("Location: login.php");
        exit();
    }

} else {
    header("Location: login.php");
    exit();
}
?>