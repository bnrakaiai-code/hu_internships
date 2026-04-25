<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>คณะผู้จัดทำ | IS SWU</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./staff2.css">
    <link rel="stylesheet" href="./img">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-swu sticky-top shadow">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php">
                <img src="https://unity.swu.ac.th/wp-content/uploads/2020/06/Srinakharinwirot_Logo_EN_Color-1-300x300.jpg" 
                 alt="SWU Logo" 
                 width="70" 
                 height="70" 
                 class="d-inline-block align-top me-2 bg-white rounded-circle p-1">
                <div>
                    <h5 class="mb-0 font-serif fw-bold" style="color: #931e1e; font-size: 24px; line-height: 0.7;">Information Studies | บุคลากร</h5>
                    <small class="text-muted" style="font-size: 0.8rem; letter-spacing: 1px;">SRINAKHARINWIROT UNIVERSITY</small>
                </div>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link active" href="http://localhost/hu_internships/index.php#">หน้าแรก</a></li>
                    <li class="nav-item"><a class="nav-link" href="http://localhost/hu_internships/index.php#showcase">หลักสูตร</a></li>
                    <li class="nav-item"><a class="nav-link" href="http://localhost/hu_internships/index.php#news">ประชาสัมพันธ์</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">บุคลากร</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-menu-item nav-link text-dark px-3" href="http://localhost/hu_internships/staff_1.php" target="_self">คณะอาจารย์</a></li>
                            <li><a class="dropdown-menu-item nav-link text-dark px-3" href="http://localhost/hu_internships/staff_2.php" target="_self">คณะผู้จัดทำ</a></li>
                        <li><a class="dropdown-menu-item nav-link text-dark px-3" href="http://localhost/hu_internships/students.php">สมุดรายชื่อนิสิต</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="http://localhost/hu_internships/contact.php">ติดต่อเรา</a></li>
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <a class="btn btn-swu rounded-pill" href="login.php" style="padding: 8px 25px;">เข้าสู่ระบบ</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="staff-header text-center py-5 bg-light">
        <div class="container">
            <h1 class="display-4 fw-bold">คณะผู้จัดทำ</h1>
            <p class="lead mb-0">สาขาวิชาสารสนเทศศึกษา คณะมนุษยศาสตร์ มหาวิทยาลัยศรีนครินทรวิโรฒ</p>
        </div>
    </header>

    <div class="container py-5">
        
        <h2 class="text-center section-title mb-4">ผู้จัดทำ</h2>
        <!-- admin 1 -->
        <div class="row g-4 justify-content-center mb-4">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card staff-card border-top border-danger border-5 h-100 shadow-sm">
                    <div class="img-container">
                        <img src="./img/paployii.jpg" class="staff-img w-100" alt="Bundita">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="fw-bold mb-1">นางสาวบัณฑิตา จินรัตน์</h5>
                        <p class="text-danger small fw-bold mb-1">67101010629</p>
                        <p class="text-muted small">Bundita Chinrat</p>
                        <a href="mailto:bundita.bunny@g.swu.ac.th" class="email-link text-decoration-none">
                            <i class="bi bi-envelope-at-fill"></i> bundita.bunny@g.swu.ac.th
                        </a>
                    </div>
                </div>
            </div>
            <!-- admin 2 -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card staff-card border-top border-danger border-5 h-100 shadow-sm">
                    <div class="img-container">
                        <img src="./img/saalee.jpg" class="staff-img w-100" alt="Boonraksa">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="fw-bold mb-1">นางสาวบุญรักษา น้อยอ้าย</h5>
                        <p class="text-danger small fw-bold mb-1">67101010630</p>
                        <p class="text-muted small">Boonraksa Noiai</p>
                        <a href="mailto:boonraksa.aiai@g.swu.ac.th" class="email-link text-decoration-none">
                            <i class="bi bi-envelope-at-fill"></i> boonraksa.aiai@g.swu.ac.th
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="row g-4 justify-content-center">
            <!-- admin 3 -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card staff-card border-top border-danger border-5 h-100 shadow-sm">
                    <div class="img-container">
                        <img src="./img/hana.jpg" style="width: 250px; height: 250px; object-fit: cover;" class="staff-img w-100" alt="Papitchaya">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="fw-bold mb-1">นางสาวปพิชญา จงศรีวัฒนาพร</h5>
                        <p class="text-danger small fw-bold mb-1">67101010631</p>
                        <p class="text-muted small">Papitchaya Jongsriwattanaporn</p>
                        <a href="mailto:papitchaya.hana@g.swu.ac.th" class="email-link text-decoration-none">
                            <i class="bi bi-envelope-at-fill"></i> papitchaya.hana@g.swu.ac.th
                        </a>
                    </div>
                </div>
            </div>
            <!-- admin 4 -->
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card staff-card border-top border-danger border-5 h-100 shadow-sm">
                    <div class="img-container">
                        <img src="./img/pimkim.jpg" class="staff-img w-100" alt="Mopim">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="fw-bold mb-1">นางสาวโม๋พิม สุขประเสริฐ</h5>
                        <p class="text-danger small fw-bold mb-1">67101010644</p>
                        <p class="text-muted small">Mopim Sukprasert</p>
                        <a href="mailto:mopim.sukprasert@g.swu.ac.th" class="email-link text-decoration-none">
                            <i class="bi bi-envelope-at-fill"></i> mopim.sukprasert@g.swu.ac.th
                        </a>
                    </div>
                </div>
            </div>
        </div>

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