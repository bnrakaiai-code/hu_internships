<?php
session_start();
include('../includes/db_connect.php');

// ตรวจสอบสิทธิ์
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../login.php");
    exit();
}

$student_id = $_SESSION['user_id'];

// ดึงคำร้องทั้งหมดของนิสิต
// 💡 จุดแก้ไขที่ 1: เปลี่ยน ORDER BY r.request_date เป็นคอลัมน์ที่มีอยู่จริง (สมมติว่าเป็น create_at)
// หากใน Database ของคุณใช้ชื่ออื่น เช่น created_at หรือ date_submitted ให้เปลี่ยนตรงนี้ด้วยครับ
$stmt = $conn->prepare("
    SELECT r.*, s.status_name, c.company_name 
    FROM internship_requests r
    JOIN status_list s ON r.status_id = s.status_id
    JOIN companies c ON r.company_id = c.company_id
    WHERE r.student_id = :id
    ORDER BY r.create_at DESC 
");
$stmt->execute(['id' => $student_id]);
$requests = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ติดตามสถานะคำร้อง | IS SWU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body { 
            font-family: 'Prompt', sans-serif; 
            background-color: #f4f7f6; 
        }
        .card-custom { 
            border: none; 
            border-radius: 15px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.05); 
        }
        .status-badge { 
            padding: 6px 15px; 
            border-radius: 20px; 
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="card card-custom p-4">
        <h3 class="fw-bold text-danger mb-4">
            <i class="bi bi-clock-history me-2"></i> ประวัติคำร้องฝึกงานทั้งหมด
        </h3>

        <?php if(count($requests) > 0): ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>บริษัท</th>
                            <th>ตำแหน่ง</th>
                            <th>วันที่เริ่ม</th>
                            <th>วันที่สิ้นสุด</th>
                            <th>วันที่ยื่น</th>
                            <th>สถานะ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($requests as $index => $req): ?>
                            <tr>
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo htmlspecialchars($req['company_name']); ?></td>
                                <td><?php echo htmlspecialchars($req['position_title']); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($req['start_date'])); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($req['end_date'])); ?></td>
                                
                                <td>
                                    <?php 
                                        if (!empty($req['create_at'])) {
                                            echo date('d/m/Y', strtotime($req['create_at'])); 
                                        } else {
                                            echo "-";
                                        }
                                    ?>
                                </td>
                                
                                <td>
                                    <?php 
                                        $badge_class = 'bg-secondary';
                                        if(strpos($req['status_name'], 'อนุมัติ') !== false) $badge_class = 'bg-success';
                                        if(strpos($req['status_name'], 'รอ') !== false) $badge_class = 'bg-warning text-dark';
                                        if(strpos($req['status_name'], 'ไม่อนุมัติ') !== false || strpos($req['status_name'], 'ยกเลิก') !== false) $badge_class = 'bg-danger';
                                    ?>
                                    <span class="badge <?php echo $badge_class; ?> status-badge">
                                        <?php echo htmlspecialchars($req['status_name']); ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-file-earmark-text text-muted" style="font-size: 3rem;"></i>
                <p class="text-muted mt-3">ยังไม่มีประวัติคำร้อง</p>
                <a href="internship_apply.php" class="btn btn-outline-danger rounded-pill px-4">
                    ยื่นคำร้องครั้งแรก
                </a>
            </div>
        <?php endif; ?>

        <div class="mt-4 text-end">
            <a href="index.php" class="btn btn-secondary rounded-pill px-4">
                <i class="bi bi-arrow-left me-2"></i> กลับหน้า Dashboard
            </a>
        </div>
    </div>
</div>

</body>
</html>