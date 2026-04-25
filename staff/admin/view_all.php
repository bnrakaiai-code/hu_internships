<?php
session_start();
include('../../includes/db_connect.php');

// 1. ตรวจสอบสิทธิ์ Staff/Admin
if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'staff' && $_SESSION['role'] !== 'admin')) {
    header("Location: ../../login.php");
    exit();
}

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$requests = []; 

try {
    // 2. ดึงข้อมูล SQL พร้อมเงื่อนไขการค้นหา
    $sql = "SELECT r.*, s.status_name, c.company_name, st.fullname 
            FROM internship_requests r
            JOIN status_list s ON r.status_id = s.status_id
            JOIN companies c ON r.company_id = c.company_id
            JOIN students st ON r.student_id = st.student_id
            WHERE r.status_id != 1";
            
    // ค้นหาคำร้องของนิสิต 
    if ($search !== '') {
        $sql .= " AND (st.fullname LIKE :search OR st.student_id LIKE :search OR c.company_name LIKE :search)";
    }

    $sql .= " ORDER BY r.request_id ASC";
    
    $stmt = $conn->prepare($sql);

    if ($search !== '') {
        $searchTerm = "%$search%";
        $stmt->bindParam(':search', $searchTerm);
    }

    $stmt->execute();
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
        body { 
            font-family: 'Prompt', sans-serif; 
            background-color: #f8f9fa; 
        }
        .card { 
            border: none; 
            border-radius: 15px; 
            box-shadow: 0 4px 20px rgba(0,0,0,0.05); 
        }
        .table thead { 
            background-color: #931e1e; 
            color: white; 
        }

        /* ตกแต่งช่องค้นหาตามรูปภาพตัวอย่าง */
        .search-container {
            background: white;
            padding: 8px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border: 1px solid #e0e0e0;
        }
        .search-input-group {
            display: flex;
            align-items: center;
        }
        .search-input-group i {
            padding: 0 15px;
            color: #6c757d;
            font-size: 1.1rem;
        }
        .search-input-group input {
            border: none;
            outline: none;
            flex-grow: 1;
            padding: 10px 0;
            font-size: 1rem;
        }
        .search-input-group select {
            border: none;
            border-left: 1px solid #eee;
            padding: 0 15px;
            outline: none;
            background: transparent;
            color: #333;
            cursor: pointer;
        }
        .btn-search {
            background: #f8f9fa;
            border: 1px solid #eee;
            padding: 8px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: 0.2s;
            margin-left: 10px;
        }
        .btn-search:hover {
            background: #e9ecef;
        }
    </style>
</head>
<body>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-11">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold mb-0 text-dark">จัดการคำร้องทั้งหมด (Admin)</h4>
                <a href="index.php" class="btn btn-outline-secondary btn-sm">กลับหน้า Dashboard</a>
            </div>

            <div class="search-container mb-4">
                <form method="GET" action="view_all.php">
                    <div class="search-input-group">
                        <i class="bi bi-people-fill"></i>
                        <input type="text" name="search" placeholder="ค้นหาคำร้องของ นิสิต" value="<?= htmlspecialchars($search) ?>">
                        <select name="type">
                            <option value="student">นิสิต</option>
                        </select>
                        <button type="submit" class="btn-search">ค้นหา</button>
                    </div>
                </form>
            </div>

            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-list-task me-2"></i> รายการคำร้อง</h5>
                    <?php if($search !== ''): ?>
                        <a href="view_all.php" class="text-decoration-none text-muted small">ล้างการค้นหา</a>
                    <?php endif; ?>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="10%">รหัสนิสิต</th>
                                <th width="15%">ชื่อ-นามสกุล</th>
                                <th width="15%">บริษัท</th>
                                <th width="15%">ตำแหน่งงาน</th> 
                                <th width="10%">วันที่ยื่น</th>
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
                                        $badge_class = "bg-secondary";
                                        if($req['status_id'] == 2) $badge_class = "bg-info text-dark";
                                        if($req['status_id'] == 3) $badge_class = "bg-success";
                                        if($req['status_id'] == 4) $badge_class = "bg-primary";
                                        if($req['status_id'] == 9) $badge_class = "bg-danger";
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
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">ไม่พบข้อมูลที่ค้นหา</td>
                                </tr>
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