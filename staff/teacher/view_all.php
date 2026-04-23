<?php
session_start();
include('../../includes/db_connect.php');

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'teacher' && $_SESSION['role'] !== 'staff')) {
    header("Location: ../../login.php");
    exit();
}

// ดึงคำร้องทั้งหมด พร้อมข้อมูลนิสิต บริษัท และสถานะ 
$sql = "
    SELECT r.*, s.status_name, c.company_name, st.fullname
    FROM internship_requests r
    JOIN status_list s ON r.status_id = s.status_id
    JOIN companies c ON r.company_id = c.company_id
    JOIN students st ON r.student_id = st.student_id
    ORDER BY r.request_date DESC
";

$stmt = $conn->prepare($sql);
$stmt->execute();
$requests = $stmt->fetchAll();

// ดึงรายการสถานะทั้งหมดเพื่อไปทำ Dropdown
$stmt_status = $conn->query("SELECT * FROM status_list");
$statuses = $stmt_status->fetchAll();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>จัดการคำร้องทั้งหมด | IS SWU</title>
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
        .btn-swu { 
            background: #931e1e; 
            color: white; 
            transition: 0.3s; 
        }
        .btn-swu:hover { 
            background: #701616; 
            color: white; 
        }
    </style>
</head>
<body>

<div class="container-fluid py-5 px-4">
    <div class="card card-custom p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-danger mb-0">
                <i class="bi bi-list-check me-2"></i> รายการคำร้องขอฝึกงานของนิสิตทั้งหมด
            </h3>
            <a href="index.php" class="btn btn-outline-secondary rounded-pill px-4">กลับหน้าหลัก</a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>รหัสนิสิต</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>บริษัท</th>
                        <th>ตำแหน่ง</th>
                        <th>วันที่ยื่น</th>
                        <th>สถานะปัจจุบัน</th>
                        <th class="text-center">จัดการ (อนุมัติ/ปฏิเสธ)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($requests) > 0): ?>
                        <?php foreach($requests as $req): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($req['student_id']); ?></td>
                                <td><?php echo htmlspecialchars($req['fullname']); ?></td>
                                <td><?php echo htmlspecialchars($req['company_name']); ?></td>
                                <td><?php echo htmlspecialchars($req['position_title']); ?></td>
                                <td>
                                    <?php 
                                        echo !empty($req['create_at']) ? date('d/m/Y', strtotime($req['create_at'])) : "-"; 
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        $badge = 'bg-secondary';
                                        if($req['status_id'] == 1) $badge = 'bg-warning text-dark';
                                        if($req['status_id'] == 2) $badge = 'bg-success'; 
                                        if($req['status_id'] == 3) $badge = 'bg-danger';  
                                    ?>
                                    <span class="badge <?php echo $badge; ?> px-3 py-2 rounded-pill">
                                        <?php echo htmlspecialchars($req['status_name']); ?>
                                    </span>
                                </td>
                                <td class="text-center" style="min-width: 250px;">
                                    <form action="update_status.php" method="POST" class="d-flex justify-content-center gap-2">
    <input type="hidden" name="request_id" value="<?php echo $req['request_id']; ?>">
    
    <?php if($req['status_id'] == 1): // แสดงปุ่มเฉพาะรายการที่ "รอการตรวจสอบ" ?>
        <select name="status_id" class="form-select form-select-sm" style="width: 180px;">
            <option value="1" selected>รอการตรวจสอบ</option>
            <option value="4">✅ ส่งต่อให้เจ้าหน้าที่</option> <option value="3">❌ ไม่ผ่านการอนุมัติ</option>   </select>
        <button type="submit" class="btn btn-swu btn-sm px-3 rounded-pill" style="background-color: #931e1e; color: white;">บันทึก</button>
    <?php else: ?>
        <span class="text-muted small">
            <i class="bi bi-check-circle"></i> อาจารย์ตรวจสอบแล้ว
        </span>
    <?php endif; ?>
</form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="text-center py-4 text-muted">ยังไม่มีรายการคำร้อง</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>