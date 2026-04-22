<?php
session_start();
include('../includes/db_connect.php');

// 1. ตรวจสอบสิทธิ์ (ต้องเป็นนิสิต)
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../login.php");
    exit();
}

$student_id = $_SESSION['user_id'];

// 2. ดึงข้อมูลนิสิต
$stmt = $conn->prepare("SELECT * FROM students WHERE student_id = :id");
$stmt->execute(['id' => $student_id]);
$user = $stmt->fetch();

// 3. ดึงสถานะคำร้องล่าสุด 
$query = "SELECT r.*, s.status_name, c.company_name 
          FROM internship_requests r
          JOIN status_list s ON r.status_id = s.status_id
          JOIN companies c ON r.company_id = c.company_id
          WHERE r.student_id = :id
          ORDER BY r.create_at DESC LIMIT 1"; 

$stmt_req = $conn->prepare($query); // เตรียมคำสั่ง (ต้องมีบรรทัดนี้เพื่อป้องกันข้อผิดพลาด Undefined variable)
$stmt_req->execute(['id' => $student_id]);
$last_request = $stmt_req->fetch();
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Dashboard นิสิต | IS SWU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            font-family: 'Prompt', sans-serif;
            background-color: #ffffff;
        }
        .sidebar { 
            background: #931e1e; 
            min-height: 100vh; 
            color: white; 
            position: sticky; top: 0; 
        }
        .nav-link { 
            color: rgba(255,255,255,0.8); 
            margin-bottom: 10px; 
            border-radius: 10px; 
        }
        .nav-link:hover, .nav-link.active { 
            color: white; 
            background: rgba(255,255,255,0.1); 
        }
        .card-custom { 
            border: none; 
            border-radius: 15px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.05); 
            transition: 0.3s; 
        }
        .card-custom:hover { 
            transform: translateY(-5px); 
        }
        .welcome-section { 
            background: white; 
            padding: 30px; 
            border-radius: 15px; 
            border-left: 5px solid #931e1e; 
        }
        .btn-swu { 
            background: #931e1e; 
            color: white; 
            border-radius: 25px; 
            border: none; 
        }
        .btn-swu:hover { 
            background: #7a1818; 
            color: white; 
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-md-block sidebar p-4 shadow">
            <div class="text-center mb-4">
                <img src="https://unity.swu.ac.th/wp-content/uploads/2020/06/Srinakharinwirot_Logo_EN_Color-1-300x300.jpg" width="60" class="bg-white rounded-circle p-1 mb-2">
                <h5 class="fw-bold">IS SWU</h5>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link active" href="index.php"><i class="bi bi-house-door me-2"></i> หน้าแรก</a></li>
                <li class="nav-item"><a class="nav-link" href="internship_apply.php"><i class="bi bi-file-earmark-plus me-2"></i> ยื่นคำร้องใหม่</a></li>
                <li class="nav-item"><a class="nav-link" href="http://localhost/hu_internships/students/view_status.php"><i class="bi bi-search me-2"></i> ติดตามสถานะ</a></li>
                <li class="nav-item mt-5"><a class="nav-link text-warning" href="http://localhost/hu_internships/logout.php"><i class="bi bi-box-arrow-left me-2"></i> ออกจากระบบ</a></li>
            </ul>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <div class="welcome-section shadow-sm mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="fw-bold">สวัสดีคุณ, <?php echo $user['fullname']; ?> </h2>
                        <p class="text-muted mb-0">ระบบจัดการการฝึกงาน สาขาวิชาสารสนเทศศึกษา</p>
                    </div>
                    <a href="internship_apply.php" class="btn btn-swu py-2 px-4 shadow-sm">
                        <i class="bi bi-plus-circle me-2"></i> ยื่นคำร้องขอฝึกงาน
                    </a>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card card-custom p-4 h-100">
                        <h5 class="fw-bold mb-4 text-danger"><i class="bi bi-person-badge me-2"></i> ข้อมูลส่วนตัว</h5>
                        <div class="mb-3">
                            <small class="text-muted d-block">รหัสนิสิต</small>
                            <span class="fw-bold fs-5"><?php echo $user['student_id']; ?></span>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted d-block">สาขาวิชา</small>
                            <span><?php echo $user['major']; ?></span>
                        </div>
                        <div>
                            <small class="text-muted d-block">ชั้นปีที่</small>
                            <span class="badge bg-secondary">ปี <?php echo $user['year_level']; ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card card-custom p-4 h-100">
                        <h5 class="fw-bold mb-4 text-danger"><i class="bi bi-info-circle me-2"></i> สถานะคำร้องล่าสุด</h5>

                        <?php if($last_request): ?>
                            <div class="p-4 border rounded-3 bg-light">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h5 class="fw-bold mb-1"><?php echo $last_request['company_name']; ?></h5>
                                        <p class="text-muted mb-2"><?php echo $last_request['position_title']; ?></p>

                                        <small class="text-muted">
                                            ส่งเมื่อ: <?php echo date('d/m/Y', strtotime($last_request['create_at'])); ?>
                                        </small>
                                    </div>
                                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                        <span class="badge rounded-pill p-2 px-4 fs-6" style="background-color: #931e1e;">
                                            <?php echo $last_request['status_name']; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="bi bi-file-earmark-text text-muted" style="font-size: 3rem;"></i>
                                <p class="text-muted mt-3">คุณยังไม่ได้ยื่นคำร้องขอฝึกงาน</p>
                                <a href="internship_apply.php" class="btn btn-outline-danger rounded-pill px-4">เริ่มยื่นคำร้องทันที</a>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

</body>
</html>