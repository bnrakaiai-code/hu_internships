<?php
session_start();
include('../../includes/db_connect.php');

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'teacher' && $_SESSION['role'] !== 'staff')) {
    header("Location: ../../login.php");
    exit();
}

// --- ส่วนที่เพิ่ม/แก้ไข: รับค่าการค้นหา ---
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// เตรียม Query
$query_str = "
    SELECT r.*, s.status_name, st.fullname 
    FROM internship_requests r
    LEFT JOIN status_list s ON r.status_id = s.status_id
    LEFT JOIN students st ON r.student_id = st.student_id
";

if ($search !== '') {
    $query_str .= " WHERE st.fullname LIKE :search OR st.student_id LIKE :search ";
}

$query_str .= " ORDER BY r.request_date DESC";

$stmt = $conn->prepare($query_str);

if ($search !== '') {
    $searchTerm = "%$search%";
    $stmt->bindParam(':search', $searchTerm);
}

$stmt->execute();
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
        }

        .search-container {
            background: white;
            padding: 10px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border: 1px solid #eee;
        }
        .search-input-group {
            display: flex;
            align-items: center;
            background: #fff;
        }
        .search-input-group i {
            padding: 0 15px;
            color: #6c757d;
        }
        .search-input-group input {
            border: none;
            outline: none;
            flex-grow: 1;
            padding: 10px 5px;
            font-size: 1rem;
        }
        .search-input-group select {
            border: none;
            border-left: 1px solid #eee;
            padding: 0 15px;
            outline: none;
            background: transparent;
            color: #333;
        }
        .btn-search {
            background: #f8f9fa;
            border: 1px solid #eee;
            border-left: 1px solid #eee;
            padding: 10px 25px;
            border-radius: 0 8px 8px 0;
            transition: 0.2s;
        }
        .btn-search:hover {
            background: #e9ecef;
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
                <li class="nav-item"><a class="nav-link" href="index.php"><i class="bi bi-house-door me-2"></i> หน้าแรก</a></li>
                <li class="nav-item"><a class="nav-link active" href="view_all.php"><i class="bi bi-card-list me-2"></i> ดูคำขอทั้งหมด</a></li>
                <li class="nav-item mt-5"><a class="nav-link text-warning" href="../../logout.php"><i class="bi bi-box-arrow-left me-2"></i> ออกจากระบบ</a></li>
            </ul>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            
            <h3 class="fw-bold mb-4">ประวัติคำร้องของนิสิตทั้งหมด</h3>

            <div class="search-container mb-4">
                <form method="GET" action="view_all.php">
                    <div class="search-input-group">
                        <i class="bi bi-people-fill"></i>
                        <input type="text" name="search" placeholder="ค้นหาคำร้องของ นิสิต" value="<?= htmlspecialchars($search) ?>">
                        <select name="type">
                            <option value="student">นิสิต</option>
                        </select>
                        <button type="submit" class="btn-search fw-bold text-dark">ค้นหา</button>
                    </div>
                </form>
            </div>
            <div class="card card-custom p-4 bg-white shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0 text-secondary">รายการคำร้อง</h5>
                    <?php if($search): ?>
                        <a href="view_all.php" class="btn btn-sm btn-outline-secondary">ล้างการค้นหา</a>
                    <?php endif; ?>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>รหัสคำร้อง</th>
                                <th>รหัสนิสิต</th>
                                <th>ชื่อนิสิต</th>
                                <th>วันที่ยื่นเรื่อง</th>
                                <th>รายละเอียดข้อมูล</th>
                                <th>สถานะปัจจุบัน</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($all_requests) > 0): ?>
                                <?php foreach ($all_requests as $row): ?>
                                <tr>
                                    <td><?= sprintf("%03d", $row['request_id']) ?></td>
                                    <td><?= htmlspecialchars($row['student_id']) ?></td>
                                    <td><?= htmlspecialchars($row['fullname'] ?? 'ไม่พบข้อมูลชื่อ') ?></td>
                                    <td><?= date('d/m/Y', strtotime($row['request_date'])) ?></td>
                                    <td>
                                        <a href="view_detail.php?id=<?= $row['request_id'] ?>" class="btn btn-outline-primary btn-sm rounded-pill px-3"> ดูรายละเอียด </a></td>
                                    <td>
                                        <?php 
                                            $badge_class = "bg-secondary";
                                            if ($row['status_id'] == 1) $badge_class = "bg-warning text-dark";
                                            elseif ($row['status_id'] == 2) $badge_class = "bg-info text-dark";
                                            elseif ($row['status_id'] == 3) $badge_class = "bg-success";
                                            elseif ($row['status_id'] == 4) $badge_class = "bg-danger";

                                            $status_text = isset($row['status_name']) ? $row['status_name'] : "สถานะ " . $row['status_id'];
                                        ?>
                                        <span class="badge rounded-pill <?= $badge_class ?> px-3 py-2">
                                            <?= htmlspecialchars($status_text) ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="5" class="text-center text-muted py-4">ไม่พบข้อมูลที่ค้นหา</td></tr>
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