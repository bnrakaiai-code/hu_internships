<?php
// การตั้งค่าการเชื่อมต่อฐานข้อมูล MySQL
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "internships";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");

// รับค่าคำค้นหาจาก Form
$search = isset($_GET['search']) ? $_GET['search'] : '';

// สร้างคำสั่ง SQL โดยใช้ชื่อคอลัมน์ตามโครงสร้างตารางจริง
$sql = "SELECT student_id, fullname, email, year_level, major FROM students";
if ($search != "") {
    // ค้นหาจากชื่อ (fullname) หรือ รหัสนิสิต (student_id)
    $sql .= " WHERE fullname LIKE '%" . $conn->real_escape_string($search) . "%' 
              OR student_id LIKE '%" . $conn->real_escape_string($search) . "%'";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมุดรายชื่อ | สาขาวิชาสารสนเทศศึกษา | มศว</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./index.css">
    <style>
        body { font-family: 'Prompt', sans-serif; background-color: #f8f9fa; }
        .table-custom th { background-color: #fdfdfd; font-weight: 600; color: #555; }
        .search-box { max-width: 800px; margin: 0 auto; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light navbar-swu sticky-top bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
                <img src="https://unity.swu.ac.th/wp-content/uploads/2020/06/Srinakharinwirot_Logo_EN_Color-1-300x300.jpg" 
                     alt="SWU Logo" width="70" height="70" class="d-inline-block align-top me-2 bg-white rounded-circle p-1">
                <div>
                    <h5 class="mb-0 font-serif fw-bold" style="color: #931e1e; font-size: 24px; line-height: 0.7;">Information Studies</h5>
                    <small class="text-muted" style="font-size: 0.8rem; letter-spacing: 1px;">SRINAKHARINWIROT UNIVERSITY</small>
                </div>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="index.php#">หน้าแรก</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#showcase">หลักสูตร</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#news">ประชาสัมพันธ์</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">บุคลากร</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-menu-item nav-link text-dark px-3" href="#">คณะอาจารย์</a></li>
                            <li><a class="dropdown-menu-item nav-link text-dark px-3" href="#">คณะผู้จัดทำ</a></li>
                            <li><a class="dropdown-menu-item nav-link text-dark px-3 fw-bold" href="#">สมุดรายชื่อนิสิต</a></li>
                        </ul>
                    </li>
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <a class="btn btn-danger rounded-pill" href="login.php" style="background-color: #931e1e; padding: 8px 25px;">เข้าสู่ระบบ</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-5 min-vh-100">
        <div class="d-flex align-items-center mb-4">
            <i class="bi bi-book fs-4 me-2 text-secondary"></i>
            <h4 class="mb-0 fw-bold">สมุดรายชื่อนิสิต</h4>
        </div>

        <div class="search-box bg-white p-3 rounded shadow-sm border mb-4">
            <form method="GET" action="">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-people-fill"></i></span>
                    <input type="text" class="form-control border-start-0" name="search" placeholder="ค้นหารายชื่อ นิสิต มหาวิทยาลัยศรีนครินทรวิโรฒ" value="<?php echo htmlspecialchars($search); ?>">
                    <select class="form-select border-start-0" style="max-width: 150px;">
                        <option value="all">ทั้งหมด</option>
                        <option value="student" selected>นิสิต</option>
                    </select>
                    <button class="btn btn-light border px-4" type="submit">ค้นหา</button>
                </div>
            </form>
        </div>

        <div class="bg-white p-4 rounded shadow-sm border">
            <h5 class="mb-4"><i class="bi bi-mortarboard-fill me-2"></i> นิสิต</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle table-custom">
                    <thead class="border-bottom border-2">
                        <tr>
                            <th class="py-3 text-center" style="width: 5%">#</th>
                            <th class="py-3" style="width: 20%">ชื่อ-นามสกุล</th>
                            <th class="py-3" style="width: 15%">รหัสนิสิต</th>
                            <th class="py-3" style="width: 20%">Email</th>
                            <th class="py-3" style="width: 20%">สาขาวิชา</th>
                            <th class="py-3" style="width: 10%">ชั้นปี</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result && $result->num_rows > 0) {
                            $i = 1;
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td class='text-center text-muted'>" . $i++ . "</td>";
                                // แก้ชื่อ index ให้ตรงกับฐานข้อมูล: fullname
                                echo "<td class='fw-bold text-dark'>" . htmlspecialchars($row['fullname']) . "</td>";
                                echo "<td class='fw-bold' style='color: #6f42c1;'>" . htmlspecialchars($row['student_id']) . "</td>";
                                echo "<td class='text-dark'>" . htmlspecialchars($row['email']) . "</td>";
                                // เพิ่มการแสดงผลสาขาวิชา: major
                                echo "<td class='text-muted'>" . htmlspecialchars($row['major']) . "</td>";
                                // แก้ชื่อ index ให้ตรงกับฐานข้อมูล: year_level
                                echo "<td class='text-muted'>ปี " . htmlspecialchars($row['year_level']) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center py-5 text-muted'>ไม่พบข้อมูลนิสิตที่ค้นหา</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <footer class="py-5 text-white" style="background-color: #931e1e;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <h5 class="fw-bold">Information Studies, SWU</h5>
                    <p class="mb-0 small opacity-75">© 2026 สาขาวิชาสารสนเทศศึกษา คณะมนุษยศาสตร์ มหาวิทยาลัยศรีนครินทรวิโรฒ</p>
                </div>
                
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-2 small fw-bold text-uppercase">ช่องทางติดต่อเรา</p>
                    <div class="d-flex justify-content-center justify-content-md-end gap-3">
                        <a href="https://www.facebook.com/isswuofficial/" target="_blank" class="text-white fs-4 transition-hover">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://www.instagram.com/is.hmswu/" target="_blank" class="text-white fs-4 transition-hover">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="https://x.com/IS_SWU" target="_blank" class="text-white fs-4 transition-hover">
                            <i class="bi bi-twitter-x"></i> 
                        </a>
                        <a href="mailto:is@g.swu.ac.th" class="text-white fs-4 transition-hover">
                            <i class="bi bi-envelope-fill"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// ปิดการเชื่อมต่อฐานข้อมูล
if(isset($conn)) {
    $conn->close();
}
?>