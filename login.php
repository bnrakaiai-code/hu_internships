<?php include('includes/db_connect.php'); ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ | IS SWU Internships</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Sarabun', sans-serif; background-color: #f8f9fa; }
        .login-card { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .btn-swu { background-color: #931e1e; color: white; } /* สีแดงเลือดหมู มศว */
        .btn-swu:hover { background-color: #701616; color: white; }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card login-card p-4" style="width: 100%; max-width: 400px;">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-dark">IS Internships</h3>
                <p class="text-muted small">ระบบจัดการการฝึกงาน สารสนเทศศึกษา มศว</p>
            </div>
            <form action="check_login.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">ประเภทผู้ใช้งาน</label>
                    <select class="form-select" name="role" required>
                        <option value="student">นิสิต (รหัสนิสิต)</option>
                        <option value="staff">เจ้าหน้าที่ (admin)</option>
                        <option value="teacher">อาจารย์ (teacher)</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">ชื่อผู้ใช้งาน / รหัสนิสิต</label>
                    <input type="text" class="form-control" name="username" placeholder="กรอกชื่อผู้ใช้" required>
                </div>
                <div class="mb-4">
                    <label class="form-label">รหัสผ่าน</label>
                    <input type="password" class="form-control" name="password" placeholder="1234" required>
                </div>
                <button type="submit" class="btn btn-swu w-100 mb-3">เข้าสู่ระบบ</button>
                <div class="text-center">
                    <small>ยังไม่มีบัญชี? <a href="student/register.php" class="text-decoration-none">ลงทะเบียนนิสิต</a></small>
                </div>
            </form>
        </div>
    </div>
</body>
</html>