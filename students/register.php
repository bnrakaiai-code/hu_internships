<?php
include('../includes/db_connect.php'); // ดึงไฟล์เชื่อมต่อ DB

$message = "";
if (isset($_POST['register'])) {
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // เข้ารหัสเพื่อความปลอดภัย

    $sql = "INSERT INTO students (student_id, fullname, password) VALUES ('$student_id', '$fullname', '$password')";
    
    if (mysqli_query($conn, $sql)) {
        $message = "<div class='alert alert-success'>ลงทะเบียนสำเร็จ! <a href='../login.php'>ไปที่หน้าเข้าสู่ระบบ</a></div>";
    } else {
        $message = "<div class='alert alert-danger'>เกิดข้อผิดพลาด: " . mysqli_error($conn) . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ลงทะเบียนนิสิต | IS SWU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Prompt', sans-serif; background: #f4f4f4; }
        .register-box { max-width: 450px; margin: 80px auto; background: white; padding: 30px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); }
        .btn-swu { background: #931e1e; color: white; border-radius: 25px; }
        .btn-swu:hover { background: #701616; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-box">
            <h3 class="text-center fw-bold mb-4" style="color: #931e1e;">ลงทะเบียนนิสิต</h3>
            <?php echo $message; ?>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">รหัสนิสิต</label>
                    <input type="text" name="student_id" class="form-control" required placeholder="เช่น 64xxxxxxxx">
                </div>
                <div class="mb-3">
                    <label class="form-label">ชื่อ-นามสกุล</label>
                    <input type="text" name="fullname" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">รหัสผ่าน</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" name="register" class="btn btn-swu w-100 py-2">ยืนยันการลงทะเบียน</button>
                <div class="text-center mt-3">
                    <a href="../login.php" class="text-decoration-none text-muted small">มีบัญชีแล้ว? เข้าสู่ระบบ</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>