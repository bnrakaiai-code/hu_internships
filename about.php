<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลหลักสูตร สาขาสารสนเทศศึกษา</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./about.css">
</head>
<body>
<!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light navbar-swu sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php">
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
                <li class="nav-item"><a class="nav-link active" href="index.php#">หน้าแรก</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php#showcase">หลักสูตร</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php#news">ประชาสัมพันธ์</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">บุคลากร</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-menu-item nav-link text-dark px-3" href="staff_1.php">คณะอาจารย์</a></li>
                        <li><a class="dropdown-menu-item nav-link text-dark px-3" href="staff_2.php">คณะผู้จัดทำ</a></li>
                        <li><a class="dropdown-menu-item nav-link text-dark px-3" href="students.php">สมุดรายชื่อนิสิต</a></li>
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
<!-- ข้อมูลเกี่ยวกับหลักสูตร -->
    <main class="container py-5">
        
        <div class="text-center mb-5">
            <h1 class="fw-bold text-swu">เกี่ยวกับหลักสูตร</h1>
            <div class="mx-auto mt-3" style="width: 80px; height: 4px; background-color: #931e1e;"></div>
        </div>

        <section class="row mb-5">
            <div class="col-lg-12 mb-4">
                <div class="card info-card shadow-sm bg-swu-light p-4">
                    <h4 class="fw-bold text-swu mb-3"><i class="bi bi-lightbulb"></i> ปรัชญา</h4>
                    <p class="mb-0 fs-5 fw-bold">"สารสนเทศนำไปสู่การจัดการสารสนเทศเพื่อสังคมในยุคดิจิทัล"</p>
                </div>
            </div>
            <div class="col-lg-12" >
                <h4 class="fw-bold text-swu mb-3" >ความสำคัญของหลักสูตร</h4>
                <p class="text-muted" style="text-indent: 2em; text-align: justify;">
                    หลักสูตรศิลปศาสตรบัณฑิต สาขาวิชาสารสนเทศศึกษา (หลักสูตรปรับปรุง พ.ศ. 2560) เป็นหลักสูตรระดับปริญญาตรีของศูนย์การศึกษาระดับปริญญาตรี คณะมนุษยศาสตร์ มหาวิทยาลัยศรีนครินทรวิโรฒ ที่ปรับเปลี่ยนมาจากสาขาวิชาบรรณารักษศาสตร์และสารสนเทศศาสตร์ ดำเนินการสอนมาตั้งแต่ปีการศึกษา 2560 จนถึงปีการศึกษา 2564 โดยเริ่มใช้หลักสูตรตั้งแต่ภาคการเรียนที่ 1 ปีการศึกษา 2560 และจะครบวาระที่ต้องปรับปรุงหลักสูตรให้ทันสมัย เหมาะสมและสอดคล้องกับความต้องการของตลาดงานเพื่อให้ทันการใช้ในปีการศึกษา 2565 ตามเกณฑ์ของสำนักงานคณะกรรมการการอุดมศึกษา 
                </p>
                <p class="text-muted" style="text-indent: 2em; text-align: justify;">
                    การเปลี่ยนแปลงจากสภาวะการณ์โลกในปัจจุบันที่มาเยือนแบบไม่ทันตั้งตัว ส่งผลกระทบต่อองค์กรอย่างหลีกเลี่ยงไม่ได้และจำเป็นต้องได้รับการแก้ไขอย่างทันท่วงที จากวิกฤตการณ์ที่เกิดขึ้นมีผลให้เกิดการแพร่กระจายของเทคโนโลยีในวงกว้างอย่างรวดเร็ว ซึ่งกระทบต่อการใช้ในชีวิตประจำวัน การทำงาน ธุรกิจ รวมถึงเศรษฐกิจ ผู้คนต้องพัฒนาทักษะเพื่อปรับตัวให้อยู่รอดในยุค Disruptive Technology ที่มีการเปลี่ยนแปลงจนทำให้เกิดผลกระทบอย่างรอบด้าน สารสนเทศมีความหลากหลายและปริมาณเพิ่มมากขึ้น องค์กรทั้งภาครัฐและเอกชนต้องศึกษาและสังเกตการเปลี่ยนแปลงที่เกิดขึ้นอย่างต่อเนื่องเพื่อปรับตัวให้สามารถใช้ประโยชน์จากเทคโนโลยีในการตอบสนองความต้องการของผู้ใช้ที่เปลี่ยนแปลงอย่างรวดเร็ว การประยุกต์ใช้เทคโนโลยีในองค์กรสารสนเทศ เช่น การนำ Artificial Intelligence หรือปัญญาประดิษฐ์เข้ามาใช้ในการรวบรวม จัดเก็บ ให้บริการทรัพยากรสารสนเทศ การวิเคราะห์ข้อมูลเพื่อนำมาใช้บริหารจัดการสารสนเทศที่มีปริมาณเพิ่มมากขึ้นและสลับซับซ้อนยิ่งขึ้น นอกจากนี้ นโยบายปฏิรูประบบอุดมศึกษาของรัฐบาล (Reinventing University) ได้ปรับปรุงรูปแบบการดำเนินงานอย่างก้าวกระโดด มีลักษณะการบูรณาการแบบข้ามศาสตร์ เพื่อให้ผู้เรียนสามารถเชื่อมโยงองค์ความรู้ในหลากหลายมิติ สนับสนุนผลลัพธ์การเรียนรู้ตามความต้องการของตลาดแรงงานในยุคปัจจุบัน รวมทั้งแผนยุทธศาสตร์ชาติ 20 ปี พ.ศ. 2561-2580 ได้กำหนดยุทธศาสตร์ในการนำเทคโนโลยีดิจิทัลมาใช้เป็นเครื่องมือสำคัญในการขับเคลื่อนพัฒนาประเทศ จึงต้องเสริมสร้างและพัฒนาศักยภาพทุนมนุษย์ มุ่งเน้นการพัฒนาคนทุกช่วงวัย เพื่อให้คนไทยเป็นคนดี คนเก่ง มีระเบียบวินัย และมีคุณภาพชีวิตที่ดี พัฒนาศักยภาพคนเพื่อเป็นฐานการเพิ่มขีดความสามารถในการแข่งขันและรองรับตลาดงาน โดยการยกระดับคุณภาพการศึกษาและการเรียนรู้ที่สอดคล้องกับการเรียนรู้ในศตวรรษที่ 21 เสริมสร้างบทบาทของสถาบันทางสังคมและทุนทางวัฒนธรรมในการส่งเสริมคุณธรรมจริยธรรมในสังคม
                </p>
                <p class="text-muted" style="text-indent: 2em; text-align: justify;">
                    การเปลี่ยนแปลงรวมทั้งยุทธศาสตร์การเสริมสร้างและพัฒนาศักยภาพทุนมนุษย์ดังกล่าวจะสามารถบรรลุเป้าหมายได้ จำเป็นต้องอาศัยบุคลากรที่มีเชี่ยวชาญในเรื่อง การจัดการสารสนเทศ การบริการสารสนเทศ และการใช้เทคโนโลยีดิจิทัล การพัฒนาหลักสูตรมุ่งเน้นผลิตบัณฑิตที่มีทักษะการทำงานในวิชาชีพ พร้อมปรับตัว และการจัดการเรียนการสอนให้เข้าถึงการทำงานในสภาพแวดล้อมจริง ดังนั้นการออกแบบหลักสูตรจึงใช้วิธีการจัดการเรียนการสอนแบบโมดูล (Module System) หรือระบบบล็อก (Block System) ซึ่งนิสิตจะได้รับความเชี่ยวชาญที่จะทำการฝึกประสบการณ์ในองค์กรสารสนเทศเพื่อผลิตบัณฑิตให้พร้อมทำงานได้ในสถานการณ์จริง
                </p>
            </div>
        </section>

        <section class="row mb-5 g-4">
            <div class="col-md-6">
                <div class="card h-100 shadow-sm border-0 bg-light p-4 rounded-4">
                    <h5 class="fw-bold text-swu"> รหัสและชื่อหลักสูตร</h5>
                    <ul class="list-unstyled mt-3 mb-0">
                        <li class="mb-2"><strong>รหัสหลักสูตร:</strong> 25520091104002</li>
                        <li class="mb-2"><strong>ภาษาไทย:</strong> หลักสูตรศิลปศาสตรบัณฑิต สาขาวิชาสารสนเทศศึกษา</li>
                        <li><strong>ภาษาอังกฤษ:</strong> Bachelor of Arts Program in Information Studies</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100 shadow-sm border-0 bg-light p-4 rounded-4">
                    <h5 class="fw-bold text-swu"> ชื่อปริญญาและสาขาวิชา</h5>
                    <ul class="list-unstyled mt-3 mb-0">
                        <li class="mb-2"><strong>ภาษาไทย (ชื่อเต็ม):</strong> ศิลปศาสตรบัณฑิต (สารสนเทศศึกษา)</li>
                        <li class="mb-2"><strong>ภาษาไทย (ชื่อย่อ):</strong> ศศ.บ. (สารสนเทศศึกษา)</li>
                        <li class="mb-2"><strong>ภาษาอังกฤษ (ชื่อเต็ม):</strong> Bachelor of Arts (Information Studies)</li>
                        <li><strong>ภาษาอังกฤษ (ชื่อย่อ):</strong> B.A. (Information Studies)</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="row mb-5 g-4">
            <div class="col-lg-6">
                <h4 class="fw-bold text-swu mb-3"> วัตถุประสงค์ของหลักสูตร</h4>
                <p class="text-muted">เพื่อผลิตบัณฑิตให้มีคุณลักษณะดังต่อไปนี้</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex align-items-start">
                        <span>1. มีคุณธรรมจริยธรรมทางวิชาชีพ และจิตสำนึกความรับผิดชอบต่อสังคม</span>
                    </li>
                    <li class="list-group-item d-flex align-items-start">
                        <span>2. มีทักษะการรู้สารสนเทศเพื่อพัฒนาตนเองและผู้อื่นให้สามารถเรียนรู้ได้ตลอดชีวิต</span>
                    </li>
                    <li class="list-group-item d-flex align-items-start">
                        <span>3. มีความรู้ความสามารถในการใช้เทคโนโลยีดิจิทัลได้อย่างมีประสิทธิภาพเพื่อช่วยในการจัดการองค์กรสารสนเทศ</span>
                    </li>
                </ul>
            </div>
            
            <div class="col-lg-6">
                <h4 class="fw-bold text-swu mb-3"> ผลลัพธ์การเรียนรู้ (PLOs)</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>PLO1:</strong> สามารถให้บริการสารสนเทศได้อย่างมีจิตสำนึกสาธารณะ</li>
                    <li class="list-group-item"><strong>PLO2:</strong> สามารถจัดระบบสารสนเทศได้อย่างถูกต้องและเหมาะสม</li>
                    <li class="list-group-item"><strong>PLO3:</strong> สามารถออกแบบและพัฒนาระบบงานสารสนเทศ</li>
                    <li class="list-group-item"><strong>PLO4:</strong> สามารถค้นคืน วิเคราะห์ แปลผลข้อมูล เพื่อนำเสนอและสื่อสารได้เหมาะสมกับทุกระดับผู้ใช้งาน</li>
                    <li class="list-group-item"><strong>PLO5:</strong> สามารถบูรณาการความรู้เพื่อการทำวิจัยและทำผลงานนวัตกรรมสารสนเทศได้อย่างมีจริยธรรมในวิชาชีพ มุ่งเน้นการรับใช้สังคม</li>
                </ul>
            </div>
        </section>

        <section class="row mb-5 g-4">
            <div class="col-lg-6">
                <div class="card h-100 shadow-sm border-0 p-4 rounded-4" >
                    <h4 class="fw-bold text-swu mb-3">จุดเด่นของหลักสูตร</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2">(1) บัณฑิตมีความสามารถในการใช้เทคโนโลยีเพื่อการจัดเก็บและค้นคืนสารสนเทศ</li>
                        <li class="mb-2">(2) บัณฑิตมีความสามารถในการทำรายการและจัดหมวดหมู่ทรัพยากรสารสนเทศ</li>
                        <li class="mb-2">(3) บัณฑิตมีความสามารถในการใช้ระบบฐานข้อมูลและการวิเคราะห์ข้อมูล</li>
                        <li class="mb-2">(4) บัณฑิตสามารถนำความรู้เกี่ยวกับการวิจัยไปใช้เพื่อการวิจัยกับศาสตร์อื่นได้</li>
                        <li>(5) บัณฑิตสามารถบูรณาการศาสตร์ และนำไปประยุกต์ใช้ในการปฏิบัติงานได้อย่างมีประสิทธิภาพ</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card h-100 shadow-sm border-0 p-4 rounded-4 bg-white">
                    <h4 class="fw-bold text-swu mb-3"> อาชีพที่ประกอบได้หลังสำเร็จการศึกษา</h4>
                    <p class="text-muted" style="text-align: justify;">
                        หลักสูตรนี้ได้ออกแบบไว้เพื่อให้บัณฑิตสามารถประกอบอาชีพในหน่วยงานที่ให้บริการสารสนเทศ ตลอดจนการทำงานที่เกี่ยวกับการใช้เทคโนโลยีสารสนเทศและการสื่อสาร ทั้งหน่วยงานของภาครัฐและเอกชน เช่น 
                    </p>
                    <div class="d-flex flex-wrap gap-2 mt-3">
                        <span class="badge rounded-pill px-3 py-2 fs-6" style="background-color: #931e1e;">อาจารย์</span>
                        <span class="badge rounded-pill px-3 py-2 fs-6" style="background-color: #931e1e;">บรรณารักษ์</span>
                        <span class="badge rounded-pill px-3 py-2 fs-6" style="background-color: #931e1e;">นักเอกสารสนเทศ</span>
                        <span class="badge rounded-pill px-3 py-2 fs-6" style="background-color: #931e1e;">นักวิชาการสารสนเทศ</span>
                        <span class="badge rounded-pill px-3 py-2 fs-6" style="background-color: #931e1e;">นักวิเคราะห์ระบบสารสนเทศ</span>
                        <span class="badge rounded-pill px-3 py-2 fs-6" style="background-color: #931e1e;">นักจดหมายเหตุ</span>
                    </div>
                </div>
            </div>
        </section>

    </main>
<!-- footer -->
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