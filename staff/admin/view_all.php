<?php
session_start();
include('../../includes/db_connect.php');

// 1. ตรวจสอบสิทธิ์ Admin/Staff
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'staff' && $_SESSION['role'] !== 'admin')) {
    header("Location: ../../login.php");
    exit();
}

$requests = []; 

try {
    // 2. ดึงข้อมูล (SQL เดิมใช้ r.* ซึ่งมี position_title อยู่แล้ว)
    $sql = "SELECT r.*, s.status_name, c.company_name, st.fullname 
            FROM internship_requests r
            JOIN status_list s ON r.status_id = s.status_id
            JOIN companies c ON r.company_id = c.company_id
            JOIN students st ON r.student_id = st.student_id
            WHERE r.status_id != 1  
            ORDER BY r.request_date DESC";
            
    $stmt = $conn->query($sql);
    $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $requests = [];
}
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
        body { font-family: 'Prompt', sans-serif; background-color: #f8f9fa; }
        .card { border: none; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
        .table thead { background-color: #931e1e; color: white; }
    </style>
</head>
<body>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold mb-0 text-dark">รายการคำร้องขอฝึกงาน (Admin)</h4>
                    <a href="index.php" class="btn btn-outline-secondary btn-sm">กลับหน้า Dashboard</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="10%">รหัสนิสิต</th>
                                <th width="15%">ชื่อ-นามสกุล</th>
                                <th width="15%">บริษัท</th>
                                <th width="15%">ตำแหน่งงาน</th> <th width="10%">วันที่ยื่น</th>
                                <th width="15%">สถานะ</th>
                                <th width="15%">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($requests)): ?>
                            <?php foreach ($requests as $req): ?>
                            <tr>
                                <td><?php echo $req['request_id']; ?></td>
                                <td><?php echo htmlspecialchars($req['student_id']); ?></td>
                                <td><?php echo htmlspecialchars($req['fullname']); ?></td>
                                <td><?php echo htmlspecialchars($req['company_name']); ?></td>
                                <td class="fw-bold"><?php echo htmlspecialchars($req['position_title'] ?? '-'); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($req['request_date'])); ?></td>
                                <td>
                                    <?php 
                                        $badge_class = "bg-secondary"; // สีเริ่มต้น (เทา)
                                        if($req['status_id'] == 2) $badge_class = "bg-info text-dark"; // อาจารย์อนุมัติ
                                        if($req['status_id'] == 3) $badge_class = "bg-success";        // ออกหนังสือแล้ว
                                        if($req['status_id'] == 4) $badge_class = "bg-primary";        // เสร็จสิ้น
                                        if($req['status_id'] == 9) $badge_class = "bg-danger";         // ยกเลิก
                                    ?>
                                    <span class="badge rounded-pill <?php echo $badge_class; ?> px-3 py-2">
                                        <?php echo $req['status_name']; ?>
                                    </span>
                                </td>
                                <td>
                                    <form action="update_status.php" method="POST" class="d-flex gap-1">
                                        <input type="hidden" name="request_id" value="<?php echo $req['request_id']; ?>">
                                        <select name="status_id" class="form-select form-select-sm" required>
                                            <option value="">-- แก้ไข --</option>
                                            <option value="3" <?php if($req['status_id']==3) echo 'selected'; ?>>ออกหนังสือส่งตัวแล้ว</option>
                                            <option value="4" <?php if($req['status_id']==4) echo 'selected'; ?>>เสร็จสิ้นการฝึกงาน</option>
                                            <option value="9" <?php if($req['status_id']==9) echo 'selected'; ?>>ยกเลิก</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary btn-sm">บันทึก</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>