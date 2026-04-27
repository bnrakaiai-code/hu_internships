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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ | IS SWU</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&family=Prompt:wght@400;500;600&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body { 
            font-family: 'Prompt', 'Poppins', sans-serif; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh; 
            /* ใส่ URL รูปภาพพื้นหลังของคุณตรงนี้ */
            background-image: url('./img/login.jpg'); 
            background-size: cover; 
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            overflow: hidden;
            position: relative;
        }

        /* พื้นหลังสีดำโปร่งแสงทับรูปภาพ (Overlay) */
        body::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(15, 23, 42, 0.4);
            z-index: 1;
        }

        /* กล่อง Glassmorphism */
        .login-box { 
            position: relative;
            width: 420px; 
            padding: 50px 40px; 
            background: rgba(255, 255, 255, 0.05); 
            border-radius: 16px; 
            backdrop-filter: blur(12px); 
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2); 
            box-shadow: 0 25px 50px rgba(0,0,0,0.2); 
            z-index: 10; 
        }

        .login-box h4 {
            color: #ffffff;
            text-align: center;
            margin-bottom: 5px;
            font-weight: 600;
            letter-spacing: 1px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .login-box p.subtitle {
            color: rgba(255, 255, 255, 0.7);
            text-align: center;
            margin-bottom: 35px;
            font-size: 14px;
        }

        /* ปรับแต่งกลุ่ม Input แบบในรูป */
        .glass-input-group {
            position: relative;
            margin-bottom: 35px;
        }

        .glass-input-group i.icon-left {
            position: absolute;
            left: 0;
            top: 12px;
            color: rgba(255, 255, 255, 0.6);
            font-size: 16px;
            transition: 0.3s;
        }

        .glass-input-group input, 
        .glass-input-group select {
            width: 100%;
            padding: 12px 5px 12px 30px;
            font-size: 15px;
            color: #ffffff;
            background: transparent;
            border: none;
            border-bottom: 1.5px solid rgba(255, 255, 255, 0.4);
            outline: none;
            transition: 0.3s;
            font-family: inherit;
        }

        /* เอาลูกศรของ select ออกให้ดูเรียบขึ้น */
        .glass-input-group select {
            appearance: none;
            cursor: pointer;
        }
        .glass-input-group select option {
            background: #b67d7d; /* สีพื้นหลัง dropdown เมื่อกดเลือก */
            color: #ffffff;
        }

        .glass-input-group label {
            position: absolute;
            top: 12px;
            left: 30px;
            color: rgba(255, 255, 255, 0.8);
            pointer-events: none;
            transition: 0.3s ease;
        }

        /* Animation เมื่อพิมพ์หรือคลิกที่ Input */
        .glass-input-group input:focus ~ label,
        .glass-input-group input:valid ~ label,
        .glass-input-group label.active-label {
            top: -18px;
            left: 0;
            font-size: 12px;
            color: #fefcfc;
            font-weight: 500;
        }

        .glass-input-group input:focus,
        .glass-input-group select:focus {
            border-bottom: 1.5px solid #931e1e;
        }

        .glass-input-group input:focus ~ i.icon-left,
        .glass-input-group input:valid ~ i.icon-left,
        .glass-input-group select:focus ~ i.icon-left {
            color: #931e1e;
        }

        /* ปุ่มซ่อน/แสดงรหัสผ่าน */
        .peek-btn {
            position: absolute;
            right: 0;
            top: 10px;
            border: none;
            background: transparent;
            cursor: pointer;
            color: rgba(255, 255, 255, 0.6);
            z-index: 10;
            padding: 0;
            transition: 0.3s;
        }
        .peek-btn:hover, .peek-btn:focus {
            color: #931e1e;
            outline: none;
        }

        /* ปุ่มเข้าสู่ระบบ */
        .login-btn { 
            width: 100%;
            padding: 14px;
            background: #931e1e; 
            border: none;
            border-radius: 8px; 
            color: #ffffff; 
            font-size: 15px;
            font-weight: 600; 
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease; 
            margin-top: 10px;
            font-family: inherit;
        }
        .login-btn:hover { 
            background: #931e1e; 
            box-shadow: 0 10px 20px rgba(233, 14, 14, 0.3); 
            transform: translateY(-1px); 
        }
        .login-btn:active {
            transform: translateY(0);
        }

        /* ลิงก์สร้างบัญชีใหม่ & หน้าหลัก */
        .bottom-links {
            text-align: center;
            margin-top: 25px;
            color: #ffffff;
            font-size: 13px;
        }
        .bottom-links a {
            color: #9fd1fc;
            text-decoration: none;
            font-weight: 600;
            margin-left: 5px;
            transition: 0.3s;
        }
        .bottom-links a:hover {
            color: #64b2f7;
            text-decoration: underline;
        }
        .home-link {
            display: block;
            margin-top: 15px;
            color: rgba(255, 255, 255, 0.6) !important;
            font-weight: 400 !important;
        }
        .home-link:hover {
            color: #ffffff !important;
        }

        /* แต่ง Alert error ของ Bootstrap ให้เข้ากับธีมเข้ม */
        .alert-glass {
            background: rgba(220, 53, 69, 0.2);
            color: #ffb3b3;
            border: 1px solid rgba(220, 53, 69, 0.4);
            border-radius: 8px;
        }

    </style>
</head>
<body>

    <div class="login-box">
        <h4>เข้าสู่ระบบนิสิต</h4>
        <p class="subtitle">ระบบจัดการการฝึกงาน IS SWU</p>
        
        <?php if($error) echo "<div class='alert alert-glass py-2 small text-center mb-4'>$error</div>"; ?>
        
        <form action="check_login.php" method="POST" id="loginForm">
            
            <div class="glass-input-group">
                <i class="bi bi-person-badge icon-left"></i>
                <select name="role" required>
                    <option value="student">นิสิต (รหัสนิสิต)</option>
                    <option value="admin">เจ้าหน้าที่ (admin)</option>
                    <option value="teacher">อาจารย์ (teacher)</option>
                </select>
                <label class="active-label">ประเภทผู้ใช้งาน</label>
            </div>

            <div class="glass-input-group">
                <i class="bi bi-person icon-left"></i>
                <input type="text" name="username" required autocomplete="off">
                <label>ชื่อผู้ใช้งาน / รหัสนิสิต</label>
            </div>
            
            <div class="glass-input-group">
                <i class="bi bi-lock icon-left"></i>
                <input type="password" id="password" name="password" required>
                <label>รหัสผ่าน</label>
                <button type="button" class="peek-btn" id="togglePassword">
                    <i class="bi bi-eye-slash" id="toggleIcon"></i>
                </button>
            </div>

            <button type="submit" class="login-btn">
                เข้าสู่ระบบ
            </button>

            <div class="bottom-links">
                ยังไม่มีบัญชี? <a href="students/register.php">สร้างบัญชีใหม่</a>
                <a href="index.php" class="home-link">
                    <i class="bi bi-house-door me-1"></i> กลับสู่หน้าหลัก
                </a>
            </div>
        </form>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        const toggleIcon = document.querySelector('#toggleIcon');

        togglePassword.addEventListener('click', function (e) {
            // สลับการแสดงผล password/text
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            // สลับไอคอนดวงตา
            toggleIcon.classList.toggle('bi-eye');
            toggleIcon.classList.toggle('bi-eye-slash');
        });
    </script>
</body>
</html>