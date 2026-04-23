<?php
session_start();
include('../../includes/db_connect.php');

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'teacher' && $_SESSION['role'] !== 'staff')) {
    header("Location: ../../login.php");
    exit();
}

// นับจำนวนคำร้องที่ "รออาจารย์ตรวจสอบ" (status_id = 1)
$stmt = $conn->query("SELECT COUNT(*) FROM internship_requests WHERE status_id = 1");
$pending_count = $stmt->fetchColumn();

// ดึงข้อมูลคำร้องที่ "รออาจารย์ตรวจสอบ" มาแสดงในตาราง (status_id = 1)
$stmt_requests = $conn->query("SELECT * FROM internship_requests WHERE status_id = 1 ORDER BY request_date DESC");
$pending_requests = $stmt_requests->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Teacher | IS SWU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { 
            font-family: 'Prompt', sans-serif; 
            background-color: #f8f9fa; 
        }
        .sidebar { 
            background: #931e1e; 
            min-height: 100vh; 
            color: white; 
            position: sticky; 
            top: 0; 
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
            border: none; }
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
                <h5 class="fw-bold">IS | SWU Teacher</h5>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link active" href="index.php"><i class="bi bi-house-door me-2"></i> หน้าแรก</a></li>
                <li class="nav-item"><a class="nav-link" href="view_all.php"><i class="bi bi-card-list me-2"></i> ดูคำขอทั้งหมด</a></li>
                <li class="nav-item mt-5"><a class="nav-link text-warning" href="../../logout.php"><i class="bi bi-box-arrow-left me-2"></i> ออกจากระบบ</a></li>
            </ul>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php 
                        echo $_SESSION['message']; 
                        unset($_SESSION['message']);
                    ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="welcome-section shadow-sm mb-4">
                <h2 class="fw-bold">ระบบจัดการสำหรับอาจารย์</h2>
                <p class="text-muted mb-0">ระบบจัดการการฝึกงานของนิสิต สาขาสารสนเทศศึกษา</p>
            </div>

            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card card-custom bg-warning text-dark p-4">
                        <h5 class="fw-bold"><i class="bi bi-hourglass-split"></i> คำร้องรอตรวจสอบ</h5>
                        <h2 class="mb-0"><?= $pending_count ?> รายการ</h2>
                    </div>
                </div>
            </div>

            <div class="card card-custom p-4 bg-white">
                <h4 class="mb-4 fw-bold">รายการคำร้องจากนิสิต (รออนุมัติ)</h4>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>รหัสคำร้อง</th>
                                <th>รหัสนิสิต</th>
                                <th>วันที่ยื่นเรื่อง</th>
                                <th>จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($pending_requests) > 0): ?>
                                <?php foreach ($pending_requests as $row): ?>
                                <tr>
                                    <td><?= sprintf("%03d", $row['request_id']) ?></td>
                                    <td><?= htmlspecialchars($row['student_id']) ?></td>
                                    <td><?= date('d/m/Y', strtotime($row['request_date'])) ?></td>
                                    <td>
                                        <form action="approve_request.php" method="POST" class="d-inline">
                                            <input type="hidden" name="request_id" value="<?= $row['request_id'] ?>">
                                            <button type="submit" name="action" value="approve" class="btn btn-success btn-sm rounded-pill px-3" onclick="return confirm('ยืนยันการอนุมัติเพื่อส่งต่อให้ Admin?');">
                                                อนุมัติ
                                            </button>
                                            <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm rounded-pill px-3" onclick="return confirm('ยืนยันการปฏิเสธคำร้องนี้?');">
                                                ไม่อนุมัติ
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="4" class="text-center text-muted py-3">ไม่มีคำร้องที่รอการตรวจสอบ</td></tr>
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