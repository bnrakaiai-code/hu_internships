<?php
session_start();
include('../includes/db_connect.php');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ยื่นคำร้องขอฝึกงาน | IS SWU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { 
            font-family: 'Prompt', sans-serif; 
            background-color: #f8f9fa; 
        }
        .form-container { 
            max-width: 900px; 
            margin: 50px auto; 
        }
        .card-form { 
            border: none; 
            border-radius: 20px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.1); 
            overflow: hidden; 
        }
        .card-header-swu { 
            background: #931e1e; 
            color: white; 
            padding: 25px; 
            border: none; 
        }
        .btn-swu { 
            background: #931e1e; 
            color: white; 
            border-radius: 25px; 
            padding: 10px 40px; 
            font-weight: 600; 
        }
        .btn-swu:hover { 
            background: #7a1818; 
            color: white; 
            transform: translateY(-2px); 
            transition: 0.3s; 
        }
        .section-title { 
            color: #931e1e; 
            border-left: 5px solid #931e1e; 
            padding-left: 15px; 
            margin-bottom: 25px; 
            font-weight: 600; 
        }
    </style>
</head>
<body>

<div class="container form-container">
    <div class="card card-form">
        <div class="card-header-swu text-center">
            <h3 class="mb-0 fw-bold"><i class="bi bi-file-earmark-text me-2"></i> แบบฟอร์มขอเข้าฝึกงาน</h3>
            <p class="mb-0 opacity-75 mt-2">กรุณากรอกข้อมูลให้ครบถ้วนเพื่อดำเนินการออกหนังสือขอความอนุเคราะห์</p>
        </div>
        <div class="card-body p-4 p-md-5">
            <form action="save_request.php" method="POST">
                
                <h5 class="section-title">ข้อมูลผู้ยื่นคำร้อง</h5>
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold text-muted">รหัสนิสิต</label>
                        <input type="text" class="form-control bg-light" value="<?php echo $_SESSION['user_id']; ?>" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold text-muted">ชื่อ-นามสกุล</label>
                        <input type="text" class="form-control bg-light" value="<?php echo $_SESSION['fullname']; ?>" readonly>
                    </div>
                </div>

                <h5 class="section-title">ข้อมูลสถานประกอบการ</h5>
                <div class="mb-3">
                    <label class="form-label fw-bold"> รหัสบริษัท <span class="text-danger">*</span></label>
                    <input type="text" name="company_id" class="form-control" placeholder="เช่น 12001" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">ชื่อบริษัท/หน่วยงาน <span class="text-danger">*</span></label>
                    <input type="text" name="company_name" class="form-control" placeholder="Company" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">ที่อยู่บริษัท <span class="text-danger">*</span></label>
                    <textarea name="company_address" class="form-control" rows="3" placeholder="Address" required></textarea>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">ช่องทางติดต่อผู้ประสานงาน <span class="text-danger">*</span></label>
                        <input type="text" name="contact_person" class="form-control" placeholder="ชื่อ(เบอร์โทร)" required>
                    </div>
                </div>

                <h5 class="section-title">รายละเอียดการฝึกงาน</h5>
                <div class="mb-3">
                    <label class="form-label fw-bold">ตำแหน่งที่เข้าฝึกงาน <span class="text-danger">*</span></label>
                    <input type="text" name="position_title" class="form-control" placeholder="เช่น Software Developer, Assistant Librarian" required>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">วันที่เริ่มฝึกงาน <span class="text-danger">*</span></label>
                        <input type="date" name="start_date" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">วันที่สิ้นสุด <span class="text-danger">*</span></label>
                        <input type="date" name="end_date" class="form-control" required>
                    </div>
                </div>

                <div class="d-flex gap-2 justify-content-center mt-4">
                    <button type="submit" class="btn btn-swu shadow-sm">
                        <i class="bi bi-send-check me-2"></i> ส่งคำร้องขอฝึกงาน
                    </button>
                    <a href="index.php" class="btn btn-outline-secondary rounded-pill px-4">ยกเลิก</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>