<?php
session_start();
include('../includes/db_connect.php');

// ตรวจสอบสิทธิ์การเข้าถึง (Students)
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../login.php");
    exit();
}

$student_id = $_SESSION['user_id']; // ดึง ID ของนิสิตที่ Login อยู่
$request_id = $_GET['id'] ?? null;

if (!$request_id) {
    header("Location: index.php");
    exit();
}

try {
    // เพิ่มเงื่อนไข AND r.student_id = :student_id เพื่อความปลอดภัย
    $query = "
        SELECT r.*, 
               s.fullname as student_name, 
               c.company_name, c.company_address, c.contact_person
        FROM internship_requests r
        LEFT JOIN students s ON r.student_id = s.student_id
        LEFT JOIN companies c ON r.company_id = c.company_id
        WHERE r.request_id = :id AND r.student_id = :student_id
    ";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $request_id, PDO::PARAM_INT);
    $stmt->bindParam(':student_id', $student_id); // Bind ค่า student_id จาก session
    $stmt->execute();
    $req = $stmt->fetch(PDO::FETCH_ASSOC);

    // หากไม่พบข้อมูล (อาจเพราะ ID ไม่ใช่ของตัวเอง หรือไม่มี ID นี้) ให้เด้งกลับ
    if (!$req) {
        echo "<script>alert('ไม่พบข้อมูลคำร้องของคุณ หรือคุณไม่มีสิทธิ์เข้าถึงข้อมูลนี้'); window.location='index.php';</script>";
        exit();
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดคำร้อง #<?= sprintf("%03d", $req['request_id']) ?> | IS SWU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { 
            font-family: 'Prompt', sans-serif; 
            background-color: #f4f7f6; 
        }
        .detail-card { 
            border: none; 
            border-radius: 20px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.1); 
            overflow: hidden; 
        }
        .card-header-swu { 
            background: #931e1e; 
            color: white; 
            padding: 2rem; 
            border: none; 
        }
        .section-title { 
            color: #931e1e; 
            border-left: 5px solid #931e1e; 
            padding-left: 15px; 
            margin-bottom: 20px; 
            font-weight: 600; 
            margin-top: 30px; 
        }
        .info-label { 
            color: #888; 
            font-size: 0.85rem; 
            font-weight: 600; 
            text-transform: uppercase; }
        .info-value { 
            color: #333; 
            font-size: 1.1rem; 
            margin-bottom: 1.2rem; 
            border-bottom: 1px solid #f0f0f0; 
            padding-bottom: 5px; 
        }
        .status-badge { 
            padding: 0.5rem 1.5rem; 
            border-radius: 50px; 
            font-weight: 600; 
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <a href="index.php" class="btn btn-link text-decoration-none text-dark mb-3">
                <i class="bi bi-chevron-left"></i> ย้อนกลับ
            </a>

            <div class="card detail-card">
                <div class="card-header-swu d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="fw-bold mb-1">ข้อมูลการยื่นขอฝึกงาน</h3>
                        <p class="mb-0 opacity-75">เลขที่คำร้อง: <?= sprintf("%03d", $req['request_id']) ?></p>
                    </div>
                    <div class="text-end">
                        <span class="badge status-badge bg-white text-dark shadow-sm">
                            ยื่นเมื่อ: <?= date('d/m/Y', strtotime($req['request_date'])) ?>
                        </span>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5 bg-white">
                    
                    <h5 class="section-title" style="margin-top: 0;">ข้อมูลนิสิต</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="info-label">รหัสนิสิต</label>
                            <div class="info-value"><?= htmlspecialchars($req['student_id']) ?></div>
                        </div>
                        <div class="col-md-8">
                            <label class="info-label">ชื่อ-นามสกุล</label>
                            <div class="info-value"><?= htmlspecialchars($req['student_name'] ?? 'ไม่พบข้อมูลชื่อในระบบ') ?></div>
                        </div>
                    </div>

                    <h5 class="section-title">ข้อมูลสถานประกอบการ</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="info-label">รหัสบริษัท</label>
                            <div class="info-value"><?= htmlspecialchars($req['company_id']) ?></div>
                        </div>
                        <div class="col-md-8">
                            <label class="info-label">ชื่อบริษัท/หน่วยงาน</label>
                            <div class="info-value fw-bold"><?= htmlspecialchars($req['company_name']) ?></div>
                        </div>
                        <div class="col-12">
                            <label class="info-label">ที่อยู่บริษัท</label>
                            <div class="info-value"><?= nl2br(htmlspecialchars($req['company_address'])) ?></div>
                        </div>
                        <div class="col-md-12">
                            <label class="info-label">ผู้ประสานงาน / ช่องทางติดต่อ</label>
                            <div class="info-value"><i class="bi bi-telephone me-2"></i><?= htmlspecialchars($req['contact_person']) ?></div>
                        </div>
                    </div>

                    <h5 class="section-title">รายละเอียดการฝึกงาน</h5>
                    <div class="row">
                        <div class="col-12">
                            <label class="info-label">ตำแหน่งงาน</label>
                            <div class="info-value fw-bold"><?= htmlspecialchars($req['position_title']) ?></div>
                        </div>
                        <div class="col-md-6">
                            <label class="info-label">วันที่เริ่มฝึกงาน</label>
                            <div class="info-value"><i class="bi bi-calendar-check me-2"></i><?= date('d/m/Y', strtotime($req['start_date'])) ?></div>
                        </div>
                        <div class="col-md-6">
                            <label class="info-label">วันที่สิ้นสุดการฝึกงาน</label>
                            <div class="info-value"><i class="bi bi-calendar-x me-2"></i><?= date('d/m/Y', strtotime($req['end_date'])) ?></div>
                        </div>
                        <div class="col-md-12">
                            <label class="info-label">เอกสารแบบฟอร์มขอฝึกงาน</label>
                            <div class="info-value">
                                <?php if (!empty($req['request_document'])): ?>
                                    <?php 
                                        $file_path = "../uploads/" . $req['request_document']; 
                                    ?>
            
                                    <div class="d-flex align-items-center p-3 border rounded bg-light">
                                        <i class="bi bi-file-earmark-pdf-fill text-danger fs-2 me-3"></i>
                                        <div>
                                            <div class="fw-bold text-dark"><?= htmlspecialchars($req['request_document']) ?></div>
                                            <a href="<?= $file_path ?>" class="btn btn-sm btn-primary mt-2" target="_blank">
                                                เปิดดูไฟล์เอกสาร
                                            </a>
                                            <a href="<?= $file_path ?>" class="btn btn-sm btn-outline-secondary mt-2" download>
                                                <i class="bi bi-download me-1"></i> ดาวน์โหลด
                                            </a>
                                        </div>
                                    </div>
            
                                <?php else: ?>
                                    <div class="text-muted italic">
                                        <i class="bi bi-exclamation-circle me-1"></i> นิสิตไม่ได้แนบไฟล์เอกสารมา
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>