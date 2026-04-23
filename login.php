<?php
session_start();
// ตรวจสอบว่ามี error ส่งมาจากหน้า check_login.php หรือไม่
$error = isset($_SESSION['error']) ? $_SESSION['error'] : "";
// แสดง error เสร็จแล้วให้ล้างค่าทิ้ง จะได้ไม่ค้างตอนรีเฟรช
unset($_SESSION['error']);
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>เข้าสู่ระบบ | IS SWU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Prompt', sans-serif; 
            background: #f4f4f4; 
            display: flex; 
            align-items: center; 
            min-height: 100vh; 
        }
        .login-card { 
            max-width: 400px; 
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
    <div class="login-card w-100">
        <div class="text-center mb-4">
            <h4 class="fw-bold" style="color: #931e1e;">เข้าสู่ระบบนิสิต</h4>
            <p class="text-muted small">ระบบจัดการการฝึกงาน IS SWU</p>
        </div>
        <?php if($error) echo "<div class='alert alert-danger py-2 small'>$error</div>"; ?>
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
                <input type="text" class="form-control" name="username" placeholder="user" required>
            </div>
            <div class="mb-4">
                <label class="form-label">รหัสผ่าน</label>
                <input type="password" class="form-control" name="password" placeholder="password" required>
            </div>
            <button type="submit" class="btn btn-swu w-100 mb-3">เข้าสู่ระบบ</button>
            <div class="text-center">
                <small>กลับหน้าหลัก <a href="index.php" class="text-decoration-none">click</a></small>
            </div>
        </form>
    </div>
</body>
</html>