<?php
session_start();
include('../../includes/db_connect.php');

// 1. ตรวจสอบสิทธิ์ Admin/Staff
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'staff' && $_SESSION['role'] !== 'admin')) {
    header("Location: ../../login.php");
    exit();
}

$requests = []; // ประกาศตัวแปรเป็นอาเรย์ว่างไว้ก่อนกัน Error

try {
    // 2. ดึงข้อมูลคำร้องทั้งหมด (ยกเว้นสถานะ 1 ที่ยังอยู่กับอาจารย์)
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
    // กรณี Query ผิดพลาด (เช่น ชื่อคอลัมน์ผิด) ให้ตั้งเป็นอาเรย์ว่างไว้
    $requests = [];
    // echo "Error: " . $e->getMessage(); // เปิดบรรทัดนี้ไว้เช็คถ้าข้อมูลไม่มา
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายการคำร้องทั้งหมด | IS SWU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { 
            font-family: 'Prompt', sans-serif; 
            background-color: #f4f7f6; 
        }
        .table-container { 
            background: white; 
            border-radius: 15px; 
            padding: 20px; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.05); 
        }
    </style>
</head>
<body>

<div class="container-fluid py-5 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold"><i class="bi bi-file-earmark-text text-danger me-2"></i> จัดการคำร้องนิสิต</h3>
        <a href="index.php" class="btn btn-secondary rounded-pill px-4">กลับหน้าหลัก</a>
    </div>

    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>รหัสนิสิต</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>บริษัทที่ขอฝึก</th>
                        <th>ตำแหน่ง</th>
                        <th>วันที่ยื่น</th>
                        <th>สถานะ</th>
                        <th class="text-center">ดำเนินการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (is_array($requests) && count($requests) > 0): ?>
                        <?php foreach ($requests as $req): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($req['student_id']); ?></td>
                                <td><?php echo htmlspecialchars($req['fullname']); ?></td>
                                <td><?php echo htmlspecialchars($req['company_name']); ?></td>
                                <td>
                                    <?php echo date('d/m/Y', strtotime($req['create_at'])); ?>
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        <?php echo htmlspecialchars($req['status_name']); ?>
                                    </span>
                                </td>
                                <td>
                                    <form action="update_status.php" method="POST" class="d-flex gap-2">
                                        <input type="hidden" name="request_id" value="<?php echo $req['request_id']; ?>">
    
                                        <select name="status_id" class="form-select form-select-sm">
                                            <option value="<?php echo $req['status_id']; ?>" selected>--- แก้ไขสถานะ ---</option>
        
                                            <option value="2"> อาจารย์ที่ปรึกษาอนุมัติ (ปัจจุบัน)</option>
                                            <option value="3"> ส่งหนังสือส่งตัวแล้ว</option>
                                            <option value="4"> เสร็จสิ้นการฝึกงาน</option>
                                            <option value="9"> ไม่ผ่านการอนุมัติ/ยกเลิก</option>
                                        </select>
    
                                        <button type="submit" class="btn btn-primary btn-sm">บันทึก</button>
                                    </form>
                                </td>
                                <tr>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4">ไม่พบข้อมูลคำร้อง</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

</body>
</html>