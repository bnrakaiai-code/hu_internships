<?php
session_start();
include('../../includes/db_connect.php');

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'staff' && $_SESSION['role'] !== 'admin')) {
    header("Location: ../../login.php");
    exit();
}

$pending_requests = []; 

try {
    $count_all = $conn->query("SELECT COUNT(*) FROM internship_requests")->fetchColumn();
    $count_student = $conn->query("SELECT COUNT(*) FROM internship_requests WHERE status_id in (1,2,3,4)")->fetchColumn();
    $count_teacher = $conn->query("SELECT COUNT(*) FROM internship_requests WHERE status_id = 1")->fetchColumn();
    $count_approved = $conn->query("SELECT COUNT(*) FROM internship_requests WHERE status_id = 2")->fetchColumn();

    $stmt_pending = $conn->prepare("
        SELECT r.*, s.status_name, c.company_name, st.fullname 
        FROM internship_requests r
        JOIN status_list s ON r.status_id = s.status_id
        JOIN companies c ON r.company_id = c.company_id
        JOIN students st ON r.student_id = st.student_id
        WHERE r.status_id = 4
        ORDER BY r.request_date DESC
    ");
    $stmt_pending->execute();
    $pending_requests = $stmt_pending->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $pending_requests = []; 
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | SWU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Prompt', sans-serif; background-color: #f8f9fa; }
        
        /* ปรับปรุง Sidebar ให้รองรับ Responsive */
        .sidebar { 
            background: #931e1e; 
            min-height: 100vh; 
            color: white; 
            transition: all 0.3s;
        }

        .nav-link { 
            color: rgba(255,255,255,0.8); 
            margin-bottom: 8px; 
            border-radius: 10px; 
            transition: 0.3s; 
        }

        .nav-link:hover, .nav-link.active { 
            color: white; 
            background: rgba(255,255,255,0.2); 
        }

        .card-custom { 
            border: none; 
            border-radius: 15px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.05); 
            transition: 0.3s; 
        }

        .welcome-section { 
            background: white; 
            padding: 25px; 
            border-radius: 15px; 
            border-left: 5px solid #931e1e; 
        }

        /* สำหรับมือถือ: ซ่อน Sidebar ปกติ และใช้ Offcanvas แทน */
        @media (max-width: 767.98px) {
            .sidebar { display: none; }
            .main-content { padding-top: 20px; }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-danger d-md-none p-3 shadow-sm">
    <div class="container-fluid">
        <span class="navbar-brand fw-bold">Admin Panel</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-none d-md-block sidebar p-4 sticky-top">
            <div class="text-center mb-4">
                <img src="/hu_internships/img/swulogo_en.png" width="70" class="bg-white rounded-circle p-0 mb-2">
                <h5 class="fw-bold">Admin Panel</h5>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link active" href="#"><i class="bi bi-house-door me-2"></i> หน้าแรก</a></li>
                <li class="nav-item"><a class="nav-link" href="view_all.php"><i class="bi bi-search me-2"></i> ดูคำขอทั้งหมด</a></li>
                <li class="nav-item mt-5"><a class="nav-link text-warning" href="../../logout.php"><i class="bi bi-box-arrow-left me-2"></i> ออกจากระบบ</a></li>
            </ul>
        </nav>

        <div class="offcanvas offcanvas-start bg-danger text-white d-md-none" tabindex="-1" id="mobileSidebar" style="width: 280px; background: #931e1e !important;">
            <div class="offcanvas-header border-bottom border-white border-opacity-25">
                <h5 class="offcanvas-title fw-bold">IS | SWU Admin</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link active text-white" href="#"><i class="bi bi-house-door me-2"></i> หน้าแรก</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="view_all.php"><i class="bi bi-search me-2"></i> ดูคำขอทั้งหมด</a></li>
                    <li class="nav-item mt-4"><a class="nav-link text-warning" href="../../logout.php"><i class="bi bi-box-arrow-left me-2"></i> ออกจากระบบ</a></li>
                </ul>
            </div>
        </div>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4 main-content">
            <div class="welcome-section shadow-sm mb-4">
                <h2 class="fw-bold h4">ระบบจัดการสำหรับเจ้าหน้าที่</h2>
                <p class="text-muted mb-0 small">ตรวจสอบสถานะการฝึกงานของนิสิต สาขาสารสนเทศศึกษา</p>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="card card-custom p-4 bg-white border-start border-primary border-5 h-100">
                        <h6 class="text-muted small">คำยื่นขอฝึกงานของนิสิต</h6>
                        <h2 class="fw-bold mb-0 text-primary"><?php echo $count_student; ?> <small class="fs-6 text-muted">รายการ</small></h2>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="card card-custom p-4 bg-white border-start border-warning border-5 h-100">
                        <h6 class="text-muted small">รออาจารย์ตรวจสอบ</h6>
                        <h2 class="fw-bold mb-0 text-warning"><?php echo $count_teacher; ?> <small class="fs-6 text-muted">รายการ</small></h2>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-4">
                    <div class="card card-custom p-4 bg-white border-start border-success border-5 h-100">
                        <h6 class="text-muted small">อนุมัติเรียบร้อย</h6>
                        <h2 class="fw-bold mb-0 text-success"><?php echo $count_approved; ?> <small class="fs-6 text-muted">รายการ</small></h2>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0 h6"><i class="bi bi-clock-history me-2 text-primary"></i> รายการที่ต้องจัดการด่วน</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="min-width: 800px;">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">รหัสนิสิต</th>
                                    <th>ชื่อ-นามสกุล</th>
                                    <th>บริษัท</th>
                                    <th>วันที่ส่ง</th>
                                    <th class="text-center">ดำเนินการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($pending_requests) > 0): ?>
                                    <?php foreach($pending_requests as $req): ?>
                                    <tr>
                                        <td class="ps-4 fw-bold"><?php echo $req['student_id']; ?></td>
                                        <td><?php echo $req['fullname']; ?></td>
                                        <td><?php echo $req['company_name']; ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($req['request_date'])); ?></td>
                                        <td class="text-center">
                                            <form action="update_status.php" method="POST" class="d-flex gap-2 justify-content-center">
                                                <input type="hidden" name="request_id" value="<?php echo $req['request_id']; ?>">
                                                <select name="status_id" class="form-select form-select-sm w-auto" required>
                                                    <option value="4" selected>รอเจ้าหน้าที่</option>
                                                    <option value="2">อนุมัติ</option>
                                                    <option value="3">ยกเลิก</option>
                                                </select>
                                                <button type="submit" class="btn btn-dark btn-sm px-3 rounded-pill">ยืนยัน</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="5" class="text-center py-4 text-muted">ไม่มีรายการด่วน</td></tr>
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