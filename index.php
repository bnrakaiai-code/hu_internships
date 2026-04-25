<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สาขาวิชาสารสนเทศศึกษา | มศว</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./index.css">
    <style>
        .card-news {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-news:hover {
            transform: translateY(-8px); 
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); 
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light navbar-swu sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
            <img src="https://unity.swu.ac.th/wp-content/uploads/2020/06/Srinakharinwirot_Logo_EN_Color-1-300x300.jpg" 
                 alt="SWU Logo" 
                 width="70" 
                 height="70" 
                 class="d-inline-block align-top me-2 bg-white rounded-circle p-1">
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
                <li class="nav-item"><a class="nav-link active" href="#">หน้าแรก</a></li>
                <li class="nav-item"><a class="nav-link" href="#showcase">หลักสูตร</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">ประชาสัมพันธ์</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-menu-item nav-link text-dark px-3" href="#news">ประชาสัมพันธ์</a></li>
                        <li><a class="dropdown-menu-item nav-link text-dark px-3" href="#activities">กิจกรรม</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">บุคลากร</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-menu-item nav-link text-dark px-3" href="staff_1.php" target="_self">คณะอาจารย์</a></li>
                        <li><a class="dropdown-menu-item nav-link text-dark px-3" href="staff_2.php">คณะผู้จัดทำ</a></li>
                        <li><a class="dropdown-menu-item nav-link text-dark px-3" href="students.php">สมุดรายชื่อนิสิต</a></li>
                    </ul>
                </li>
                <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                    <a class="btn btn-swu rounded-pill" href="login.php" style="padding: 8px 25px;">เข้าสู่ระบบ</a>
                </li>
            </ul>
        </div>
    </div>
    </nav>
    
    <header id="swuCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#swuCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#swuCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#swuCarousel" data-bs-slide-to="2"></button>
    </div>

    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="hero-section slide-1">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-10 col-lg-8 text-start">
                            <div class="title-bar p-3 p-md-4 mb-4" style="background-color: rgba(73, 73, 73, 0.2);">
                                <h1 class="display-3 fw-bold text-white mb-1" style="font-size: calc(1.4rem + 1vw);">
                                หลักสูตรศิลปศาสตรบัณฑิต<br>สาขาวิชาสารสนเทศศึกษา
                                </h1>
                                <h2 class="h2 fw-bold text-white mb-0" style="font-size: calc(1.1rem + 0.6vw);">
                                Bachelor of Arts Program in Information Studies
                                </h2>
                            </div>
                            <div class="subtitle text-white ps-3 ps-md-4" style="line-height: 1.2;">
                                <p class="mb-0 fs-5">คณะมนุษยศาสตร์ มหาวิทยาลัยศรีนครินทรวิโรฒ</p>
                                <p class="mb-0 fs-5">Faculty of Humanities Srinakharinwirot University</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="hero-section slide-2">
                <div class="container text-white text-center">
                    <h1 class="display-4 fw-bold">ข่าวประชาสัมพันธ์</h1>
                    <p class="fs-5">ติดตามข่าวสารและประกาศล่าสุดจากทางสาขาวิชา</p>
                    <a href="#news" class="btn btn-light rounded-pill px-4">อ่านข่าวทั้งหมด</a>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="hero-section slide-3">
                <div class="container text-white text-center">
                    <h1 class="display-4 fw-bold">กิจกรรมสาขาวิชา</h1>
                    <p class="fs-5">ภาพบรรยากาศกิจกรรมและการพัฒนานิสิต</p>
                    <a href="#activities" class="btn btn-swu rounded-pill px-4">ดูกิจกรรมทั้งหมด</a>
                </div>
            </div>
        </div>
    </div>

    <button class="carousel-control-prev custom-control" type="button" data-bs-target="#swuCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next custom-control" type="button" data-bs-target="#swuCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
    </header>

    <!-- ข้อมูลหลักสูตร -->
    <section id="showcase" class="py-5 bg-light anchor-section">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-6 mb-lg-0">
                    <h2 class="font-serif text-swu-red fw-bold mb-4">ข้อมูลหลักสูตร</h2>
                    <p class="text-muted mb-4 line-height-lg course-info-text">
                        รหัสและชื่อหลักสูตร <br>
                        รหัสหลักสูตร 25520091104002 <br>
                        ภาษาไทย : หลักสูตรศิลปศาสตรบัณฑิต สาขาวิชาสารสนเทศศึกษา <br>
                        ภาษาอังกฤษ : Bachelor of Arts Program in Information Studies <br>
                        ชื่อปริญญาและสาขาวิชา <br>
                        ภาษาไทย <br>
                        ชื่อเต็ม : ศิลปศาสตรบัณฑิต (สารสนเทศศึกษา) <br>
                        ชื่อย่อ : ศศ.บ. (สารสนเทศศึกษา) <br>
                        ภาษาอังกฤษ <br>
                        ชื่อเต็ม : Bachelor of Arts (Information Studies) <br>
                        ชื่อย่อ : B.A. (Information Studies)</p>
                    <a class="btn btn-swu rounded-pill" href="http://localhost/hu_internships/about.php" style="padding: 8px 25px;">Read More</a>
                </div>
                <div class="col-lg-4 offset-lg-1">
                    <div class="row g-4">
                            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Students studying" class="img-fluid rounded-4 shadow-sm mb-4">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ประชาสัมพันธ์ -->
    <section id="news" class="bg-light py-5">
        <div class="container">
            <h2 class="fw-bold mb-4">
                <span style="border-bottom: 2px solid #bb1c1a; padding-bottom: 2px;">ข่าวประชาสัมพันธ์</span>
            </h2>
            <div class="row">
                <!-- News Item 1 -->
                <div class="col-md-4">
                    <div class="card card-news h-100 p-3">
                        <img src="https://scontent.fbkk5-6.fna.fbcdn.net/v/t39.30808-6/670998104_1629937591589794_6485844448341266661_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=13d280&_nc_ohc=9z8ZiTwNjDsQ7kNvwE24Ez7&_nc_oc=Adpv9mCd2_Y3PlgNxwQJk4xObEleRWvPVphfxaXCWNSZAEJNlPRYZ4Qed7QVykv0KFw&_nc_zt=23&_nc_ht=scontent.fbkk5-6.fna&_nc_gid=S4b0yFxA-AmSBmvbKtL64Q&_nc_ss=7a389&oh=00_Af1YhL5-ibVRUct1GI6aM1t_40RlU8ia017_23UQSM3PLA&oe=69ED30CF" style="width: 100%; height: 250px; object-fit: cover;" class="card-img-top rounded-3 mb-3" alt="Event">
                        <div class="card-body p-0">
                            <div class="d-flex text-muted mb-2 small">
                                <span class="me-3"><i class="bi bi-calendar3 me-1"></i> 17 Apr 2026</span>
                                <span><i class="bi bi-folder2 me-1"></i> News</span>
                            </div>
                            <h5 class="card-title fw-bold">ขอแสดงความยินดีและร่วมเผยแพร่ผลงานวิจัยระดับนานาชาติ</h5>
                            <p class="card-text text-muted">ผลงานวิจัยจากคณาจารย์หลักสูตร ศศ.ม. สารสนเทศศึกษา กลุ่มสาขาวิชาพัฒนาศักยภาพมนุษย์ ได้รับการตีพิมพ์ในฐานข้อมูลระดับนานาชาติ (SCOPUS)
                                บทความเรื่อง: “Information Services of Bangkok Metropolitan Administration's Discovery Learning Libraries: Roles and Potential in Driving the Sustainable Development Goals (SDGs)”</p>
                            <a href="https://www.facebook.com/share/p/1AZtfxuYSV/?mibextid=wwXIfr" class="text-danger text-decoration-none fw-bold">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- News Item 2 -->
                <div class="col-md-4">
                    <div class="card card-news h-100 p-3">
                        <img src="https://scontent.fbkk5-7.fna.fbcdn.net/v/t39.30808-6/510810177_1391707838746105_1169973082441495128_n.jpg?stp=cp6_dst-jpg_tt6&_nc_cat=108&ccb=1-7&_nc_sid=13d280&_nc_ohc=v1B3zml-vJ0Q7kNvwE98OhU&_nc_oc=Adp7GeAnUSEe6t6-rYbNDgo3AB9Ad6yHV77Krj7wYw-ovz9bA0pq9y0CkSSeP_0yUbk&_nc_zt=23&_nc_ht=scontent.fbkk5-7.fna&_nc_gid=ArxoOyUhu_b-cRVuY_Lkfw&_nc_ss=7a389&oh=00_Af0L7BCXAhEJ084hlixkBE_-sJ_DxJUVTSg3FqFMfsdp3w&oe=69ED5A2A" style="width: 100%; height: 250px; object-fit: cover;" class="card-img-top rounded-3 mb-3" alt="Event">
                        <div class="card-body p-0">
                            <div class="d-flex text-muted mb-2 small">
                                <span class="me-3"><i class="bi bi-calendar3 me-1"></i> 24 Jun 2025</span>
                                <span><i class="bi bi-folder2 me-1"></i> News</span>
                            </div>
                            <h5 class="card-title fw-bold">กิจกรรมการประเมินคุณภาพการศึกษาภายในระดับหลักสูตร</h5>
                            <p class="card-text text-muted">คณะมนุษยศาสตร์จัดกิจกรรมการประเมินคุณภาพการศึกษาภายในระดับหลักสูตร ตามเกณฑ์ AUN-QA ในรูปแบบ Individual ของหลักสูตรศิลปศาสตรบัณฑิต สาขาวิชาสารสนเทศศึกษา 
                                ระหว่างวันที่ 24-25 มิถุนายน 2568 โดยในวันที่ 24 มิถุนายน 2568 กิจกรรมจัดขึ้น ณ ห้องประชุมชั้น 4 อาคาร 38 เเละ วันที่ 25 มิถุนายน 2568 รูปแบบออนไลน์</p>
                            <a href="https://www.facebook.com/share/p/14a3e3hLrZP/?mibextid=wwXIfr" class="text-danger text-decoration-none fw-bold">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- News Item 3 -->
                <div class="col-md-4">
                    <div class="card card-news h-100 p-3">
                        <img src="https://scontent.fbkk5-7.fna.fbcdn.net/v/t39.30808-6/511082402_1395557561694466_3455437914072884955_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=7b2446&_nc_ohc=0G6hQK6l2IEQ7kNvwH2o8cK&_nc_oc=AdrEj_tbHNBNTxDobO1JkbF5ectzO7ucu0dfPNHtOAltX7NPeEhpAOxzBC-ojU2E5x4&_nc_zt=23&_nc_ht=scontent.fbkk5-7.fna&_nc_gid=iqx-wj6jkr3v9XWHuo0j3w&_nc_ss=7a389&oh=00_Af2IPf7Ev8G_Dy9ISNQ2jYNwc8-b_5N8l9XTQLSNHtdtEA&oe=69ED3C3C" style="width: 100%; height: 250px; object-fit: cover;" class="card-img-top rounded-3 mb-3" alt="Event">
                        <div class="card-body p-0">
                            <div class="d-flex text-muted mb-2 small">
                                <span class="me-3"><i class="bi bi-calendar3 me-1"></i> 10 Jun 2025</span>
                                <span><i class="bi bi-folder2 me-1"></i> News</span>
                            </div>
                            <h5 class="card-title fw-bold">ได้รับการแต่งตั้งให้ดำรงตำแหน่ง 'ผู้ช่วยศาสตราจารย์ สาขาวิชาสารสนเทศศึกษา'</h5>
                            <p class="card-text text-muted">ขอเเสดงความยินดีแก่ "ผู้ช่วยศาสตราจารย์ ดร.วิภากร  วัฒนสินธุ์" ที่ได้รับการแต่งตั้งให้ดำรงตำแหน่ง 'ผู้ช่วยศาสตราจารย์ สาขาวิชาสารสนเทศศึกษา'
                                ตามมติสภามหาวิทยาลัยศรีนครินทรวิโรฒ ครั้งที่ 7/2568 เมื่อวันที่ 10 มิถุนายน 2568</p>
                            <a href="https://www.facebook.com/share/p/1J1cmqsnJ7/?mibextid=wwXIfr" class="text-danger text-decoration-none fw-bold">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- กิจกรรม -->
    <section id="activities" class="bg-light py-5">
        <div class="container">
            <h2 class="fw-bold mb-4">
                <span style="border-bottom: 2px solid #bb1c1a; padding-bottom: 2px;">กิจกรรม</span>
            </h2>
            <div class="row">
                <!-- activities Item 1 -->
                <div class="col-md-4">
                    <div class="card card-activities h-100 p-3">
                        <img src="https://scontent.fbkk5-1.fna.fbcdn.net/v/t39.30808-6/655661822_1613297087049223_2758694381761646677_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=7b2446&_nc_ohc=y2z0_yHIu7AQ7kNvwH6aEpa&_nc_oc=AdoiuIMoONr1uab2ojIErTS8uYYnzVmP2SBQclRNtyTqQLVSRqZM6w5jcd0PJP9W2Ts&_nc_zt=23&_nc_ht=scontent.fbkk5-1.fna&_nc_gid=JixGEuTLx_icV1cmHJI9KQ&_nc_ss=7a389&oh=00_Af26QoMOeHs4maau-iGMBC3GOfp1xq2IAVDX39ifknJpqg&oe=69ED39AC" style="width: 100%; height: 250px; object-fit: cover;" class="card-img-top rounded-3 mb-3" alt="Event">
                        <div class="card-body p-0">
                            <div class="d-flex text-muted mb-2 small">
                                <span class="me-3"><i class="bi bi-calendar3 me-1"></i> 23 Feb 2026</span>
                                <span><i class="bi bi-folder2 me-1"></i> Activity</span>
                            </div>
                            <h5 class="card-title fw-bold">Cyber Guardians & Digital Art Challenge  (ครั้งที่ 2)</h5>
                            <p class="card-text text-muted">นิสิตชั้นปีที่ 4 สาขาวิชาสารสนเทศศึกษา คว้ารางวัล ชมเชยอันดับ 1 จากการแข่งขัน Cyber Guardians & Digital Art Challenge ครั้งที่ 2 (23 กุมภาพันธ์ 2569) 
                                จัดโดยกระทรวงดิจิทัลเพื่อเศรษฐกิจและสังคม (MDES) เพื่อส่งเสริมความตระหนักรู้ด้านภัยออนไลน์และทักษะการใช้ AI สร้างสรรค์นวัตกรรมดิจิทัล</p>
                            <a href="https://www.facebook.com/share/p/1BAda68hpM/?mibextid=wwXIfr" class="text-danger text-decoration-none fw-bold">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- activities Item 2 -->
                <div class="col-md-4">
                    <div class="card card-activities h-100 p-3">
                        <img src="https://scontent.fbkk5-7.fna.fbcdn.net/v/t39.30808-6/493042177_1322665172779084_2061443328447931420_n.jpg?_nc_cat=107&ccb=1-7&_nc_sid=13d280&_nc_ohc=wXHcbs1s3QEQ7kNvwG9qfG0&_nc_oc=AdoHDC0SlYt5v4gK9wlnsJJa5QOXcvO_4t9cCR3Vu21NV2d6ctwftbResBDG7ZA4APg&_nc_zt=23&_nc_ht=scontent.fbkk5-7.fna&_nc_gid=rHoHlz_7epkgNXBzlb8vkA&oh=00_Af39i4aO24H0nkmZMp-joxAw5gVyc_0PKItBWrQvpDjgzw&oe=69F014E5" style="width: 100%; height: 250px; object-fit: cover;" class="card-img-top rounded-3 mb-3" alt="Event">
                        <div class="card-body p-0">
                            <div class="d-flex text-muted mb-2 small">
                                <span class="me-3"><i class="bi bi-calendar3 me-1"></i> 30 Oct 2024</span>
                                <span><i class="bi bi-folder2 me-1"></i> Activity</span>
                            </div>
                            <h5 class="card-title fw-bold">นิสิตสารสนเทศศึกษา เยี่ยมชมห้องสมุดเพื่อการเรียนรู้ห้วยขวาง</h5>
                            <p class="card-text text-muted">อาจารย์ประจำวิชา IS101 Information Resource Development (B02) หลักสูตรสารสนเทศศึกษา ได้พานิสิตภาคพิเศษ ชั้นปีที่ 1 
                                เข้าเยี่ยมชม ศึกษาดูงาน ฟังบรรยายเกี่ยวกับกระบวนการพัฒนาทรัพยากรสารสนเทศ และทำกิจกรรมส่งเสริมการอ่าน ณ ห้องสมุดเพื่อการเรียนรู้ห้วยขวาง</p>
                            <a href="https://www.facebook.com/share/p/1G16HYdNs4/?mibextid=wwXIfr" class="text-danger text-decoration-none fw-bold">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- activities Item 3 -->
                <div class="col-md-4">
                    <div class="card card-activities h-100 p-3">
                        <img src="https://scontent.fbkk5-5.fna.fbcdn.net/v/t39.30808-6/523032281_1416069249643297_3662674924218715301_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=13d280&_nc_ohc=TFPY5mF--e0Q7kNvwG_KTLx&_nc_oc=Adrq7MdGPd2U40iitdiuTXTaebPQ8Hf5aVsmPwUQKr8EKu6eNRorX0C0tVf1J_h7cKQ&_nc_zt=23&_nc_ht=scontent.fbkk5-5.fna&_nc_gid=7b1MjBhQZTSCvvv-fnwqtw&oh=00_Af2AB8ljNk0eDbVTTmjOnTZM4ZqR0mGVOUI6eqeWJFAC3w&oe=69F01EEA" style="width: 100%; height: 250px; object-fit: cover;" class="card-img-top rounded-3 mb-3" alt="Event">
                        <div class="card-body p-0">
                            <div class="d-flex text-muted mb-2 small">
                                <span class="me-3"><i class="bi bi-calendar3 me-1"></i> 24 Jul 2025</span>
                                <span><i class="bi bi-folder2 me-1"></i> Activity</span>
                            </div>
                            <h5 class="card-title fw-bold">โครงการ "พัฒนาแหล่งเรียนรู้สู่ชุมชน"</h5>
                            <p class="card-text text-muted">หลักสูตรศิลปศาสตรบัณฑิต สาขาวิชาสารสนเทศศึกษา ได้จัดโครงการพัฒนาแหล่งเรียนรู้สู่ชุมชน ณ โรงเรียนวัดวังปลาจีด จ.นครนายก และโรงเรียนวัดท่าช้าง (แสงปัญญาวิทยาคาร) จ.นครนายก 
                                เพื่อให้นิสิตได้บูรณาการวิชาชีพสารสนเทศ กับการจัดแหล่งเรียนรู้ ที่มีประโยชน์ตรงตามความต้องการของชุมชน และมีทักษะทางปัญญา ทักษะชีวิต และทักษะวิชาชีพเพิ่มขึ้น</p>
                            <a href="https://www.facebook.com/share/p/1Gtwbui7uD/?mibextid=wwXIfr" class="text-danger text-decoration-none fw-bold">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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