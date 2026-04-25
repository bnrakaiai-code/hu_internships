<?php
session_start();
include('../includes/db_connect.php'); // เรียกใช้ไฟล์เชื่อมต่อฐานข้อมูล

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าและตัดช่องว่างหัวท้าย
    $student_id = trim($_POST['student_id']);
    $fullname   = trim($_POST['fullname']);
    $email      = trim($_POST['email']);
    $phone      = trim($_POST['phone']);
    $year_level = !empty($_POST['year_level']) ? $_POST['year_level'] : null;
    $major      = trim($_POST['major']);
    $advisor_id = trim($_POST['advisor_id']);
    $password   = trim($_POST['password']);

    // ถ้าไม่ได้กรอกรหัสผ่าน ให้ใช้ค่าเริ่มต้นคือ '1234'
    if (empty($password)) {
        $password = '1234';
    }

    try {
        // 1. เช็คว่ามีรหัสนิสิตนี้ในระบบแล้วหรือยัง
        $stmt_check = $conn->prepare("SELECT student_id FROM students WHERE student_id = :student_id LIMIT 1");
        $stmt_check->execute([':student_id' => $student_id]);
        
        if ($stmt_check->fetch()) {
            $error = "รหัสนิสิตนี้ได้รับการลงทะเบียนเรียบร้อยแล้ว!";
        } else {
            // 2. ถ้ายังไม่มี ให้ทำการบันทึกข้อมูล
            $sql = "INSERT INTO students (student_id, fullname, email, phone, year_level, major, advisor_id, password) 
                    VALUES (:student_id, :fullname, :email, :phone, :year_level, :major, :advisor_id, :password)";
            
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':student_id' => $student_id,
                ':fullname'   => $fullname,
                ':email'      => $email,
                ':phone'      => $phone,
                ':year_level' => $year_level,
                ':major'      => $major,
                ':advisor_id' => $advisor_id,
                ':password'   => $password
            ]);
            
            $success = "สมัครสมาชิกสำเร็จ! คุณสามารถเข้าสู่ระบบได้เลย";
        }
    } catch (Exception $e) {
        $error = "Database Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>สมัครสมาชิก | IS SWU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { 
            font-family: 'Prompt', sans-serif; 
            background: #f4f4f4; 
            display: flex; 
            align-items: center; 
            min-height: 100vh;
            padding: 20px 0; /* เพิ่ม padding เผื่อจอมือถือ */
        }
        .register-card { 
            max-width: 650px; /* ขยายการ์ดให้กว้างขึ้นสำหรับ 2 คอลัมน์ */
            margin: auto; 
            background: white; 
            padding: 40px; 
            border-radius: 15px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.1); 
            border-top: 5px solid #931e1e; 
        }
        .btn-swu { 
            background: #931e1e; 
            color: white; 
            border-radius: 25px; 
            font-weight: 600; 
            transition: 0.3s; 
        }
        .btn-swu:hover { 
            background: #701616; 
            color: white; 
            transform: scale(1.02); 
        }
    </style>
</head>
<body>
    <div class="register-card w-100">
        <div class="text-center mb-4">
            <h4 class="fw-bold" style="color: #931e1e;">สร้างบัญชีนิสิตใหม่</h4>
            <p class="text-muted small">ระบบจัดการการฝึกงาน IS SWU</p>
        </div>

        <?php if($error) echo "<div class='alert alert-danger py-2 small'><i class='bi bi-exclamation-triangle me-1'></i> $error</div>"; ?>
        <?php if($success) echo "<div class='alert alert-success py-2 small'><i class='bi bi-check-circle me-1'></i> $success</div>"; ?>

        <form action="register.php" method="POST">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">รหัสนิสิต <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="student_id" maxlength="11" placeholder="เช่น 67101010123" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">ชื่อ-นามสกุล <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="fullname" placeholder="ชื่อ นามสกุล" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">อีเมล</label>
                    <input type="email" class="form-control" name="email" placeholder="example@g.swu.ac.th">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">เบอร์โทรศัพท์</label>
                    <input type="text" class="form-control" name="phone" maxlength="12" placeholder="08x-xxx-xxxx">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">ชั้นปี</label>
                    <input type="number" class="form-control" name="year_level" min="1" max="4" placeholder="เช่น 3">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">สาขาวิชา</label>
                    <input type="text" class="form-control" name="major" placeholder="เช่น สารสนเทศศึกษา">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">รหัสอาจารย์ที่ปรึกษา</label>
                    <input type="text" class="form-control" name="advisor_id" maxlength="6" placeholder="รหัส 6 หลัก">
                </div>
                <div class="col-md-6 mb-4">
                    <label class="form-label">รหัสผ่าน (PIN)</label>
                    <input type="password" class="form-control" name="password" maxlength="4" placeholder="password">
                </div>
            </div>

            <button type="submit" class="btn btn-swu w-100 mb-3" <?= $success ? 'disabled' : '' ?>>
                <i class="bi bi-person-plus me-2"></i> ยืนยันการสมัครสมาชิก
            </button>
            
            <div class="text-center border-top pt-3 mt-2">
                <a href="../login.php" class="btn btn-link btn-sm text-muted text-decoration-none">
                    <i class="bi bi-arrow-left me-1"></i> กลับไปหน้าเข้าสู่ระบบ
                </a>
            </div>
        </form>
    </div>
</body>
</html>