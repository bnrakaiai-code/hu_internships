<?php
session_start();
include('../includes/db_connect.php');

// ตรวจสอบสิทธิ์ ว่าเป็น teacher หรือ staff หรือไม่
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'teacher' && $_SESSION['role'] !== 'staff')) {
    header("Location: ../login.php");
    exit();
}

// นับจำนวนคำร้องที่ "รอการตรวจสอบ" (สมมติว่า status_id = 1 คือรอตรวจสอบ)
$stmt = $conn->query("SELECT COUNT(*) FROM internship_requests WHERE status_id = 1");
$pending_count = $stmt->fetchColumn();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>หน้าแรกอาจารย์ | IS SWU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Prompt', sans-serif; background-color: #f4f7f6; }
        .card-custom { border: none; border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-top: 5px solid #931e1e; }
        .btn-swu { background: #931e1e; color: white; border-radius: 25px; padding: 10px 30px; transition: 0.3s; }
        .btn-swu:hover { background: #701616; color: white; transform: scale(1.05); }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-custom p-5 text-center">
                <i class="bi bi-person-workspace text-danger" style="font-size: 4rem;"></i>
                <h2 class="fw-bold mt-3">ระบบจัดการคำร้องขอฝึกงาน (ส่วนของอาจารย์)</h2>
                <p class="text-muted">ยินดีต้อนรับเข้าสู่ระบบจัดการและอนุมัติการฝึกงานของนิสิต</p>
                
                <div class="alert alert-warning mt-4 d-inline-block px-4 rounded-pill">
                    <i class="bi bi-bell-fill me-2"></i> มีคำร้องที่รอการอนุมัติ <strong><?php echo $pending_count; ?></strong> รายการ
                </div>

                <div class="mt-4">
                    <a href="view_all.php" class="btn btn-swu shadow-sm">
                        <i class="bi bi-card-list me-2"></i> ดูคำร้องทั้งหมด / อนุมัติคำร้อง
                    </a>
                    <a href="../logout.php" class="btn btn-outline-secondary rounded-pill ms-2 px-4">
                        ออกจากระบบ
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>