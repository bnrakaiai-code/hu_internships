<?php
session_start();
include('../../includes/db_connect.php');

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'teacher' && $_SESSION['role'] !== 'staff')) {
    header("Location: ../../login.php");
    exit();
}

// ดึงข้อมูลคำร้องทั้งหมด พร้อมชื่อสถานะ (สมมติว่า join กับตาราง status_list)
// หากคุณไม่มีตาราง status_list ให้ลบ JOIN ออกแล้วใช้ if-else เช็คจาก status_id ใน HTML แทนได้ครับ
$query = "
    SELECT r.*, s.status_name 
    FROM internship_requests r
    LEFT JOIN status_list s ON r.status_id = s.status_id
    ORDER BY r.request_date DESC
";
$stmt = $conn->query($query);
$all_requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ดูคำขอทั้งหมด | IS SWU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Prompt', sans-serif; background-color: #f8f9fa; }
        .sidebar { background: #931e1e; min-height: 100vh; color: white; position: sticky; top: 0; }
        .nav-link { color: rgba(255,255,255,0.8); margin-bottom: 10px; border-radius: 10px; }
        .nav-link:hover, .nav-link.active { color: white; background: rgba(255,255,255,0.1); }
        .card-custom { border: none; border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-md-block sidebar p-4 shadow">
            <div class="text-center mb-4">
                <img src="https://unity.swu.ac.th/wp-content/uploads/2020/06/Srinakharinwirot_Logo_EN_Color-1-300x300.jpg" width="60" class="bg-white rounded-circle p-1 mb-2">
                <h5 class="fw-bold">IS | SWU Teacher</h5>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="index.php"><i class="bi bi-house-door me-2"></i> หน้าแรก</a></li>
                <li class="nav-item"><a class="nav-link active" href="view_all.php"><i class="bi bi-card-list me-2"></i> ดูคำขอทั้งหมด</a></li>
                <li class="nav-item mt-5"><a class="nav-link text-warning" href="../../logout.php"><i class="bi bi-box-arrow-left me-2"></i> ออกจากระบบ</a></li>
            </ul>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            
            <h3 class="fw-bold mb-4">ประวัติคำร้องของนิสิตทั้งหมด</h3>

            <div class="card card-custom p-4 bg-white">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>รหัสคำร้อง</th>
                                <th>รหัสนิสิต</th>
                                <th>วันที่ยื่นเรื่อง</th>
                                <th>สถานะปัจจุบัน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($all_requests) > 0): ?>
                                <?php foreach ($all_requests as $row): ?>
                                <tr>
                                    <td><?= sprintf("%03d", $row['request_id']) ?></td>
                                    <td><?= htmlspecialchars($row['student_id']) ?></td>
                                    <td><?= date('d/m/Y', strtotime($row['request_date'])) ?></td>
                                    <td>
                                        <?php 
                                            // จัดสี Badge ตามสถานะ
                                            $badge_class = "bg-secondary";
                                            if ($row['status_id'] == 1) $badge_class = "bg-warning text-dark"; // รออาจารย์
                                            elseif ($row['status_id'] == 2) $badge_class = "bg-info text-dark"; // รอแอดมิน
                                            elseif ($row['status_id'] == 3) $badge_class = "bg-success"; // อนุมัติแล้ว
                                            elseif ($row['status_id'] == 4) $badge_class = "bg-danger"; // ปฏิเสธ

                                            // ถ้าไม่มีตาราง status_list ให้เปลี่ยน $row['status_name'] เป็นข้อความเองได้เลยครับ
                                            $status_text = isset($row['status_name']) ? $row['status_name'] : "สถานะ " . $row['status_id'];
                                        ?>
                                        <span class="badge rounded-pill <?= $badge_class ?> px-3 py-2">
                                            <?= htmlspecialchars($status_text) ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="4" class="text-center text-muted py-3">ยังไม่มีข้อมูลคำร้องในระบบ</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>