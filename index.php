<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สาขาวิชาสารสนเทศศึกษา | มศว</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
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
<!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-swu sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
            <img src="/hu_internships/img/swulogo_en.png" 
                 alt="SWU Logo" 
                 width="80" 
                 height="80" 
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
                <li class="nav-item"><a class="nav-link" href="#news">ประชาสัมพันธ์</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">บุคลากร</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-menu-item nav-link text-dark px-3" href="staff_1.php" target="_self">คณะอาจารย์</a></li>
                        <li><a class="dropdown-menu-item nav-link text-dark px-3" href="staff_2.php">คณะผู้จัดทำ</a></li>
                        <li><a class="dropdown-menu-item nav-link text-dark px-3" href="students.php">สมุดรายชื่อนิสิต</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="contact.php">ติดต่อเรา</a></li>
                <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                    <a class="btn btn-swu rounded-pill" href="login.php" style="padding: 8px 25px;">เข้าสู่ระบบ</a>
                </li>
            </ul>
        </div>
    </div>
    </nav>
    
<!-- สไลด์หน้าหลัก -->
    <header id="swuCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#swuCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#swuCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#swuCarousel" data-bs-slide-to="2"></button>
    </div>
    <!-- Slide 1 -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="hero-section slide-1">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-10 col-lg-8 text-start">
                            <div class="title-bar p-3 p-md-4 mb-4" style="background-color: rgba(73, 73, 73, 0.2);">
                                
                                <h1 class="display-3 fw-bold text-white mb-1 animate__animated animate__fadeInUp" style="font-size: calc(1.4rem + 1vw);">
                                หลักสูตรศิลปศาสตรบัณฑิต<br>สาขาวิชาสารสนเทศศึกษา
                                </h1>
                                
                                <h2 class="h2 fw-bold text-white mb-0 animate__animated animate__fadeInUp animate__delay-1s" style="font-size: calc(1.1rem + 0.6vw);">
                                Bachelor of Arts Program in Information Studies
                                </h2>
                                
                            </div>
                            
                            <div class="subtitle text-white ps-3 ps-md-4 animate__animated animate__fadeIn animate__delay-2s" style="line-height: 1.2;">
                                <p class="mb-0 fs-5">คณะมนุษยศาสตร์ มหาวิทยาลัยศรีนครินทรวิโรฒ</p>
                                <p class="mb-0 fs-5">Faculty of Humanities Srinakharinwirot University</p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Slide 2 -->        
        <div class="carousel-item">
            <div class="hero-section slide-2">
                <div class="container text-white text-center">
                    <h1 class="display-4 fw-bold animate__animated animate__fadeInUp slide-title-custom-2">- ข่าวประชาสัมพันธ์ -</h1>
                    <p class="fs-5 animate__animated animate__fadeInUp animate__delay-1s">ติดตามข่าวสารและประกาศจากทางสาขาวิชา</p>
                    <a href="#news" class="btn btn-custom-2 rounded-pill px-4 animate__animated animate__fadeInUp animate__delay-2s">อ่านข่าวทั้งหมด</a>
                </div>
            </div>
        </div>
        <!-- Slide 3 -->
        <div class="carousel-item">
            <div class="hero-section slide-3">
                <div class="container text-white text-center">
                    <h1 class="display-4 fw-bold animate__animated animate__fadeInUp slide-title-custom-3">- กิจกรรมสาขาวิชา -</h1>
                    <p class="fs-5 animate__animated animate__fadeInUp animate__delay-1s">ภาพบรรยากาศกิจกรรมและการพัฒนานิสิต</p>
                    <a href="#activities" class="btn btn-custom-3 rounded-pill px-4 animate__animated animate__fadeInUp animate__delay-2s">ดูกิจกรรมทั้งหมด</a>
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
                <div class="col-lg-6 mb-6 mb-lg-0" data-aos="fade-right">
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
                        <a class="btn btn-swu rounded-pill" href="about.php" style="padding: 8px 25px;">
                            อ่านเพิ่มเติม <i class="bi bi-arrow-up-right"></i>
                        </a>
                </div>
                <div class="col-lg-5 offset-lg-1 shadow rounded-4 p-0 overflow-hidden" data-aos="fade-left">
                    <img src="./img/student1.jpg" class="w-100 h-100" style="object-fit: cover;">
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
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card card-news h-100 p-3">
                        <img src="./img/news1.jpg" style="width: 100%; height: 250px; object-fit: cover;" class="card-img-top rounded-3 mb-3" alt="Event">
                        <div class="card-body p-0">
                            <div class="d-flex text-muted mb-2 small">
                                <span class="me-3"><i class="bi bi-calendar3 me-1"></i> 17 Apr 2026</span>
                                <span><i class="bi bi-folder2 me-1"></i> News</span>
                            </div>
                            <h5 class="card-title fw-bold">ขอแสดงความยินดีและร่วมเผยแพร่ผลงานวิจัยระดับนานาชาติ</h5>
                            <p class="card-text text-muted">ผลงานวิจัยจากคณาจารย์หลักสูตร ศศ.ม. สารสนเทศศึกษา กลุ่มสาขาวิชาพัฒนาศักยภาพมนุษย์ ได้รับการตีพิมพ์ในฐานข้อมูลระดับนานาชาติ (SCOPUS)
                                บทความเรื่อง: “Information Services of Bangkok Metropolitan Administration's Discovery Learning Libraries: Roles and Potential in Driving the Sustainable Development Goals (SDGs)”</p>
                            <a href="/img/slide4.jpg" class="text-danger text-decoration-none fw-bold" target="_blank">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- News Item 2 -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card card-news h-100 p-3">
                        <img src="./img/news2.jpg" style="width: 100%; height: 250px; object-fit: cover;" class="card-img-top rounded-3 mb-3" alt="Event">
                        <div class="card-body p-0">
                            <div class="d-flex text-muted mb-2 small">
                                <span class="me-3"><i class="bi bi-calendar3 me-1"></i> 24 Jun 2025</span>
                                <span><i class="bi bi-folder2 me-1"></i> News</span>
                            </div>
                            <h5 class="card-title fw-bold">กิจกรรมการประเมินคุณภาพการศึกษาภายในระดับหลักสูตร</h5>
                            <p class="card-text text-muted">คณะมนุษยศาสตร์จัดกิจกรรมการประเมินคุณภาพการศึกษาภายในระดับหลักสูตร ตามเกณฑ์ AUN-QA ในรูปแบบ Individual ของหลักสูตรศิลปศาสตรบัณฑิต สาขาวิชาสารสนเทศศึกษา 
                                ระหว่างวันที่ 24-25 มิถุนายน 2568 โดยในวันที่ 24 มิถุนายน 2568 กิจกรรมจัดขึ้น ณ ห้องประชุมชั้น 4 อาคาร 38 เเละ วันที่ 25 มิถุนายน 2568 รูปแบบออนไลน์</p>
                            <a href="https://www.facebook.com/share/p/14a3e3hLrZP/?mibextid=wwXIfr" class="text-danger text-decoration-none fw-bold" target="_blank">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- News Item 3 -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card card-news h-100 p-3">
                        <img src="./img/news3.jpg" style="width: 100%; height: 250px; object-fit: cover;" class="card-img-top rounded-3 mb-3" alt="Event">
                        <div class="card-body p-0">
                            <div class="d-flex text-muted mb-2 small">
                                <span class="me-3"><i class="bi bi-calendar3 me-1"></i> 10 Jun 2025</span>
                                <span><i class="bi bi-folder2 me-1"></i> News</span>
                            </div>
                            <h5 class="card-title fw-bold">ได้รับการแต่งตั้งให้ดำรงตำแหน่ง 'ผู้ช่วยศาสตราจารย์ สาขาวิชาสารสนเทศศึกษา'</h5>
                            <p class="card-text text-muted">ขอเเสดงความยินดีแก่ "ผู้ช่วยศาสตราจารย์ ดร.วิภากร  วัฒนสินธุ์" ที่ได้รับการแต่งตั้งให้ดำรงตำแหน่ง 'ผู้ช่วยศาสตราจารย์ สาขาวิชาสารสนเทศศึกษา'
                                ตามมติสภามหาวิทยาลัยศรีนครินทรวิโรฒ ครั้งที่ 7/2568 เมื่อวันที่ 10 มิถุนายน 2568</p>
                            <a href="https://www.facebook.com/share/p/1J1cmqsnJ7/?mibextid=wwXIfr" class="text-danger text-decoration-none fw-bold" target="_blank">Read More <i class="bi bi-arrow-right"></i></a>
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
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card card-activities h-100 p-3">
                        <img src="./img/ativity1.jpg" style="width: 100%; height: 250px; object-fit: cover;" class="card-img-top rounded-3 mb-3" alt="Event">
                        <div class="card-body p-0">
                            <div class="d-flex text-muted mb-2 small">
                                <span class="me-3"><i class="bi bi-calendar3 me-1"></i> 23 Feb 2026</span>
                                <span><i class="bi bi-folder2 me-1"></i> Activity</span>
                            </div>
                            <h5 class="card-title fw-bold">Cyber Guardians & Digital Art Challenge  (ครั้งที่ 2)</h5>
                            <p class="card-text text-muted">นิสิตชั้นปีที่ 4 สาขาวิชาสารสนเทศศึกษา คว้ารางวัล ชมเชยอันดับ 1 จากการแข่งขัน Cyber Guardians & Digital Art Challenge ครั้งที่ 2 (23 กุมภาพันธ์ 2569) 
                                จัดโดยกระทรวงดิจิทัลเพื่อเศรษฐกิจและสังคม (MDES) เพื่อส่งเสริมความตระหนักรู้ด้านภัยออนไลน์และทักษะการใช้ AI สร้างสรรค์นวัตกรรมดิจิทัล</p>
                            <a href="https://www.facebook.com/share/p/1BAda68hpM/?mibextid=wwXIfr" class="text-danger text-decoration-none fw-bold" target="_blank">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- activities Item 2 -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card card-activities h-100 p-3">
                        <img src="./img/ativity2.jpg" style="width: 100%; height: 250px; object-fit: cover;" class="card-img-top rounded-3 mb-3" alt="Event">
                        <div class="card-body p-0">
                            <div class="d-flex text-muted mb-2 small">
                                <span class="me-3"><i class="bi bi-calendar3 me-1"></i> 30 Oct 2024</span>
                                <span><i class="bi bi-folder2 me-1"></i> Activity</span>
                            </div>
                            <h5 class="card-title fw-bold">นิสิตสารสนเทศศึกษา เยี่ยมชมห้องสมุดเพื่อการเรียนรู้ห้วยขวาง</h5>
                            <p class="card-text text-muted">อาจารย์ประจำวิชา IS101 Information Resource Development (B02) หลักสูตรสารสนเทศศึกษา ได้พานิสิตภาคพิเศษ ชั้นปีที่ 1 
                                เข้าเยี่ยมชม ศึกษาดูงาน ฟังบรรยายเกี่ยวกับกระบวนการพัฒนาทรัพยากรสารสนเทศ และทำกิจกรรมส่งเสริมการอ่าน ณ ห้องสมุดเพื่อการเรียนรู้ห้วยขวาง</p>
                            <a href="https://www.facebook.com/share/p/1G16HYdNs4/?mibextid=wwXIfr" class="text-danger text-decoration-none fw-bold" target="_blank">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- activities Item 3 -->
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card card-activities h-100 p-3">
                        <img src="./img/ativity3.jpg" style="width: 100%; height: 250px; object-fit: cover;" class="card-img-top rounded-3 mb-3" alt="Event">
                        <div class="card-body p-0">
                            <div class="d-flex text-muted mb-2 small">
                                <span class="me-3"><i class="bi bi-calendar3 me-1"></i> 24 Jul 2025</span>
                                <span><i class="bi bi-folder2 me-1"></i> Activity</span>
                            </div>
                            <h5 class="card-title fw-bold">โครงการ "พัฒนาแหล่งเรียนรู้สู่ชุมชน"</h5>
                            <p class="card-text text-muted">หลักสูตรศิลปศาสตรบัณฑิต สาขาวิชาสารสนเทศศึกษา ได้จัดโครงการพัฒนาแหล่งเรียนรู้สู่ชุมชน ณ โรงเรียนวัดวังปลาจีด จ.นครนายก และโรงเรียนวัดท่าช้าง (แสงปัญญาวิทยาคาร) จ.นครนายก 
                                เพื่อให้นิสิตได้บูรณาการวิชาชีพสารสนเทศ กับการจัดแหล่งเรียนรู้ ที่มีประโยชน์ตรงตามความต้องการของชุมชน และมีทักษะทางปัญญา ทักษะชีวิต และทักษะวิชาชีพเพิ่มขึ้น</p>
                            <a href="https://www.facebook.com/share/p/1Gtwbui7uD/?mibextid=wwXIfr" class="text-danger text-decoration-none fw-bold" target="_blank">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
    AOS.init({
        duration: 1000, // ระยะเวลาของอนิเมชั่น (มิลลิวินาที)
        once: true,     // ให้แสดงเอฟเฟกต์แค่ครั้งเดียวตอนเลื่อนผ่าน
        });
    </script>

<!-- Footer Section -->
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