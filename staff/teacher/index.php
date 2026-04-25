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

// นับจำนวนคำร้องที่ "อนุมัติเรียบร้อย" (status_id = 2,3,4) ---
$stmt_approved = $conn->query("SELECT COUNT(*) FROM internship_requests WHERE status_id IN (2, 3, 4)");
$approved_count = $stmt_approved->fetchColumn();

// ดึงข้อมูลคำร้องที่ "รออาจารย์ตรวจสอบ" (status_id = 1)
$stmt_requests = $conn->query("SELECT * FROM internship_requests WHERE status_id = 1 ORDER BY request_date DESC");
$pending_requests = $stmt_requests->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            transition: 0.3s; 
        }
        .nav-link:hover, .nav-link.active { 
            color: white; 
            background: rgba(255,255,255,0.1); 
        }
        .card-custom { 
            border: none; 
            border-radius: 15px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.05); 
        }
        .welcome-section { 
            background: white; 
            padding: 25px; 
            border-radius: 15px; 
            border-left: 5px solid #931e1e; 
        }
        
        .btn-success { 
            background-color: #198754; 
            border: none; 
        }
        .btn-danger { 
            background-color: #dc3545; 
            border: none; 
        }

        @media (max-width: 767.98px) {
            .sidebar { 
                display: none; 
            }
            .welcome-section { 
                text-align: center; 
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-danger d-md-none p-3 shadow-sm" style="background: #931e1e !important;">
    <div class="container-fluid">
        <span class="navbar-brand fw-bold">IS | SWU Teacher</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#teacherSidebar">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-none d-md-block sidebar p-4 shadow">
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

        <div class="offcanvas offcanvas-start text-white" tabindex="-1" id="teacherSidebar" style="background: #931e1e; width: 280px;">
            <div class="offcanvas-header border-bottom border-white border-opacity-25">
                <h5 class="offcanvas-title fw-bold">เมนูจัดการ</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link active text-white" href="index.php"><i class="bi bi-house-door me-2"></i> หน้าแรก</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="view_all.php"><i class="bi bi-card-list me-2"></i> ดูคำขอทั้งหมด</a></li>
                    <li class="nav-item mt-4"><a class="nav-link text-warning" href="../../logout.php"><i class="bi bi-box-arrow-left me-2"></i> ออกจากระบบ</a></li>
                </ul>
            </div>
        </div>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <div class="welcome-section shadow-sm mb-4">
                <h2 class="fw-bold h4">ระบบจัดการสำหรับอาจารย์</h2>
                <p class="text-muted mb-0 small">จัดการคำร้องขอฝึกงานของนิสิตในที่ปรึกษา/สาขาวิชา</p>
            </div>

            <div class="row mb-4">
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="card card-custom bg-warning text-dark p-4 border-0">
                        <div class="d-flex align-items-center">
                            <div class="fs-1 me-3"><i class="bi bi-hourglass-split"></i></div>
                            <div>
                                <h6 class="fw-bold mb-1">คำร้องขอฝึกงานที่รอตรวจสอบ</h6>
                                <h2 class="fw-bold mb-0"><?= $pending_count ?> <small class="fs-6">รายการ</small></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="card card-custom bg-success text-white p-4 border-0"> <div class="d-flex align-items-center">
                            <div class="fs-1 me-3"><i class="bi bi-check-circle"></i></div> <div>
                                <h6 class="fw-bold mb-1">อนุมัติเรียบร้อย</h6>
                                <h2 class="fw-bold mb-0"><?= $approved_count ?> <small class="fs-6">รายการ</small></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-custom border-0 shadow-sm overflow-hidden">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="mb-0 fw-bold text-dark"><i class="bi bi-list-stars me-2 text-danger"></i> รายการคำร้องจากนิสิต (รออนุมัติ)</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="min-width: 600px;">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">รหัสคำร้อง</th>
                                    <th>รหัสนิสิต</th>
                                    <th>วันที่ยื่นเรื่อง</th>
                                    <th class="text-center">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($pending_requests) > 0): ?>
                                    <?php foreach ($pending_requests as $row): ?>
                                    <tr>
                                        <td class="ps-4 fw-bold text-primary">#<?= sprintf("%03d", $row['request_id']) ?></td>
                                        <td><?= htmlspecialchars($row['student_id']) ?></td>
                                        <td><?= date('d/m/Y', strtotime($row['request_date'])) ?></td>
                                        <td class="text-center">
                                            <div class="d-flex gap-2 justify-content-center">
                                                <a href="view_detail.php?id=<?= $row['request_id'] ?>" class="btn btn-outline-primary btn-sm rounded-pill px-3"> ดูรายละเอียด </a>

                                                <form action="approve_request.php" method="POST" class="d-flex gap-2">
                                                    <input type="hidden" name="request_id" value="<?= $row['request_id'] ?>">
                                                    <button type="submit" name="action" value="approve" class="btn btn-success btn-sm rounded-pill px-3" onclick="return confirm('ยืนยันการอนุมัติ?');">
                                                        <i class="bi bi-check2"></i> อนุมัติ
                                                    </button>
                                                    <button type="submit" name="action" value="reject" class="btn btn-outline-danger btn-sm rounded-pill px-3" onclick="return confirm('ยืนยันการปฏิเสธ?');">
                                                        <i class="bi bi-x-lg"></i> ปฏิเสธ
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="4" class="text-center text-muted py-5">ไม่มีคำร้องที่รอการตรวจสอบในขณะนี้</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>