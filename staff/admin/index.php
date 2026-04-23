<?php
session_start();
include('../../includes/db_connect.php');

// 1. ตรวจสอบสิทธิ์
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'staff' && $_SESSION['role'] !== 'admin')) {
    header("Location: ../../login.php");
    exit();
}

// ประกาศตัวแปรไว้เป็นอาเรย์ว่างก่อน เผื่อกรณี Query มีปัญหาจะได้รับไม่ Error
$pending_requests = []; 

try {
    // นับจำนวนสถานะต่างๆ
    $count_all = $conn->query("SELECT COUNT(*) FROM internship_requests")->fetchColumn();
    $count_teacher = $conn->query("SELECT COUNT(*) FROM internship_requests WHERE status_id = 1")->fetchColumn();
    $count_staff = $conn->query("SELECT COUNT(*) FROM internship_requests WHERE status_id = 4")->fetchColumn();
    $count_approved = $conn->query("SELECT COUNT(*) FROM internship_requests WHERE status_id = 2")->fetchColumn();

    // ดึงรายการคำร้องที่ "รอเจ้าหน้าที่ดำเนินการ" (ID 4)
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
    $pending_requests = $stmt_pending->fetchAll(PDO::FETCH_ASSOC); // ตรวจสอบว่ามีบรรทัดนี้

} catch (PDOException $e) {
    // ถ้า Query ผิดพลาดให้แสดง Error (เฉพาะช่วงพัฒนา)
    // echo "Error: " . $e->getMessage(); 
    $pending_requests = []; 
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | IS SWU</title>
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
            transition: 0.3s; 
            border-bottom: 4px solid transparent; 
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
            padding: 10px 25px; }
        .btn-swu:hover { 
            background: #7a1818; 
            color: white; }
        
        /* สีสถานะพิเศษ */
        .border-staff { 
            border-bottom-color: #0d6efd; 
        } /* สีน้ำเงินสำหรับ Admin */
        .border-teacher { 
            border-bottom-color: #ffc107; 
        } /* สีเหลืองสำหรับ Teacher */
        .border-success { 
            border-bottom-color: #198754; 
        } /* สีเขียวสำหรับผ่านแล้ว */
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-md-block sidebar p-4 shadow">
            <div class="text-center mb-4">
                <img src="https://unity.swu.ac.th/wp-content/uploads/2020/06/Srinakharinwirot_Logo_EN_Color-1-300x300.jpg" width="60" class="bg-white rounded-circle p-1 mb-2">
                <h5 class="fw-bold">IS | SWU Admin</h5>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link active" href="index.php"><i class="bi bi-house-door me-2"></i> หน้าแรก</a></li>
                <li class="nav-item"><a class="nav-link" href="view_all.php"><i class="bi bi-search me-2"></i> ดูคำขอทั้งหมด</a></li>
                <li class="nav-item mt-5"><a class="nav-link text-warning" href="../../logout.php"><i class="bi bi-box-arrow-left me-2"></i> ออกจากระบบ</a></li>
            </ul>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <div class="welcome-section shadow-sm mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="fw-bold">ระบบจัดการสำหรับเจ้าหน้าที่</h2>
                        <p class="text-muted mb-0">ตรวจสอบสถานะการฝึกงานของนิสิต สาขาสารสนเทศศึกษา</p>
                    </div>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card card-custom p-4 bg-white text-white border-start border-primary border-5">
                        <h6 class="text-muted">รอดำเนินการ (จากอาจารย์)</h6>
                        <h2 class="fw-bold mb-0 text-primary"><?php echo $count_staff; ?> <small class="fs-6 text-muted">รายการ</small></h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom p-4 bg-white border-start border-warning border-5">
                        <h6 class="text-muted">รออาจารย์ตรวจสอบ</h6>
                        <h2 class="fw-bold mb-0 text-warning"><?php echo $count_teacher; ?> <small class="fs-6 text-muted">รายการ</small></h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-custom p-4 bg-white border-start border-success border-5">
                        <h6 class="text-muted">อนุมัติเรียบร้อย</h6>
                        <h2 class="fw-bold mb-0 text-success"><?php echo $count_approved; ?> <small class="fs-6 text-muted">รายการ</small></h2>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0"><i class="bi bi-clock-history me-2 text-primary"></i> รายการที่ต้องจัดการด่วน</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">รหัสนิสิต</th>
                                    <th>ชื่อ-นามสกุล</th>
                                    <th>บริษัท</th>
                                    <th>วันที่ส่ง</th>
                                    <th class="text-center">ดำเนินการอัปเดต</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($pending_requests) > 0): ?>
                                    <?php foreach($pending_requests as $req): ?>
                                    <tr>
                                        <td class="ps-4 fw-bold"><?php echo $req['student_id']; ?></td>
                                        <td><?php echo $req['fullname']; ?></td>
                                        <td><?php echo $req['company_name']; ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($req['create_at'])); ?></td>
                                        <td class="text-center">
                                            <form action="update_status.php" method="POST" class="d-flex gap-2 justify-content-center">
                                                <input type="hidden" name="request_id" value="<?php echo $req['request_id']; ?>">
                                                <select name="status_id" class="form-select form-select-sm" style="width: 150px;" required>
                                                    <option value="4" selected>รอเจ้าหน้าที่ดำเนินการ</option>
                                                    <option value="2"> อนุมัติเข้าระบบ</option>
                                                    <option value="3"> ยกเลิกคำร้อง</option>
                                                </select>
                                                <button type="submit" class="btn btn-dark btn-sm px-3 rounded-pill">ยืนยัน</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">ไม่มีคำร้องที่รอการจัดการในขณะนี้</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 text-center py-3">
                    <a href="view_all.php" class="text-decoration-none small text-danger fw-bold">ดูคำขอทั้งหมดที่นี่ <i class="bi bi-chevron-right"></i></a>
                </div>
            </div>
        </main>
    </div>
</div>

</body>
</html>