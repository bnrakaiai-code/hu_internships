-- ==========================================
-- สร้างและเลือกใช้งานฐานข้อมูล
-- ==========================================
CREATE DATABASE IF NOT EXISTS internships;
USE internships;

CREATE TABLE status_list ( 
    status_id int primary key, 
    status_name varchar(50) not null
) engine=innodb default charset=utf8mb4;

CREATE TABLE students (
    student_id char(11) primary key,
    fullname varchar(100) not null,
    email varchar(100),
    phone varchar(12),
    year_level int,
    major varchar(100),
    advisor_id varchar(6),
    password VARCHAR(4) NOT NULL DEFAULT '1234'
) engine=innodb default charset=utf8mb4;

CREATE TABLE companies (
    company_id varchar(14) primary key,
    company_name varchar(255) not null,
    company_address text,
    contact_person varchar(100)
) engine=innodb default charset=utf8mb4;

CREATE TABLE internship_requests (
    request_id int(3) zerofill auto_increment primary key,
    student_id char(11),
    company_id varchar(14),
    position_title varchar(100),
    start_date date,
    end_date date,
    request_document VARCHAR(255),
    request_date timestamp default current_timestamp(),
    status_id int default 1,
    foreign key (student_id) references students(student_id) on delete cascade,
    foreign key (company_id) references companies(company_id) on delete set null,
    foreign key (status_id) references status_list(status_id)
) engine=innodb default charset=utf8mb4;

CREATE TABLE staff (
    staff_id char(4) primary key,
    username varchar(50) not null unique,
    password varchar(4) not null default '1234',
    role enum('admin', 'teacher') not null
) engine=innodb default charset=utf8mb4;

CREATE TABLE status_log (
    log_id int auto_increment primary key,
    request_id int(3) zerofill not null,
    action_by varchar(50) not null,
    old_status_id int,
    new_status_id int not null,
    changed_at timestamp default current_timestamp(),
    constraint fk_request foreign key (request_id) references internship_requests(request_id) on delete cascade,
    constraint fk_old_status foreign key (old_status_id) references status_list(status_id),
    constraint fk_new_status foreign key (new_status_id) references status_list(status_id)
) engine=innodb default charset=utf8mb4;

-- เพิ่มข้อมูลสถานะ
INSERT INTO status_list (status_id, status_name) VALUES
(1, 'รอตรวจสอบ'),
(2, 'อาจารย์ที่ปรึกษาอนุมัติ'),
(3, 'ส่งหนังสือส่งตัวแล้ว'),
(4, 'เสร็จสิ้นการฝึกงาน'),
(9, 'ไม่ผ่านการอนุมัติ/ยกเลิก');

-- เพิ่มข้อมูลนิสิตจำนวน 40 รายการ
INSERT IGNORE INTO students (student_id, fullname, email, phone, year_level, major, advisor_id) VALUES
('68101010492', 'สมชาย รักดี', 'somchai.r@g.swu.ac.th', '081-234-5678', 1, 'สารสนเทศศึกษา', 708040),
('68101010125', 'กัญญา วัฒนา', 'kanya.w@g.swu.ac.th', '082-345-6789', 1, 'สารสนเทศศึกษา', 708040),
('68101010783', 'อนันดา ศิริ', 'ananda.s@g.swu.ac.th', '083-456-7890', 1, 'สารสนเทศศึกษา', 708040),
('68101010341', 'พัชระ มงคล', 'patchara.m@g.swu.ac.th', '084-567-8901', 1, 'สารสนเทศศึกษา', 708040),
('68101010912', 'สุนิสา ใจเย็น', 'sunisa.j@g.swu.ac.th', '085-678-9012', 1, 'สารสนเทศศึกษา', 708040),
('68101010556', 'ธนวัฒน์ ภูมิ', 'tanawat.p@g.swu.ac.th', '086-789-0123', 1, 'สารสนเทศศึกษา', 708040),
('68101010219', 'นัตยา แก้ว', 'nattaya.k@g.swu.ac.th', '087-890-1234', 1, 'สารสนเทศศึกษา', 708040),
('68101010667', 'วรวิทย์ สุข', 'worawit.s@g.swu.ac.th', '088-901-2345', 1, 'สารสนเทศศึกษา', 708040),
('68101010884', 'ปิยนุช มณี', 'piyanut.m@g.swu.ac.th', '089-012-3456', 1, 'สารสนเทศศึกษา', 708040),
('68101010110', 'ชัยวัฒน์ วงศ์', 'chaiwat.w@g.swu.ac.th', '090-123-4567', 1, 'สารสนเทศศึกษา', 708040),
('67101010394', 'ธนากร ศิลา', 'thanakorn.s@g.swu.ac.th', '081-345-1234', 2, 'สารสนเทศศึกษา', 706924),
('67101010821', 'สรัญญา บุญเย็น', 'saranya.b@g.swu.ac.th', '082-456-2345', 2, 'สารสนเทศศึกษา', 706924),
('67101010456', 'พีรวัฒน์ ดี', 'peerawat.d@g.swu.ac.th', '083-567-3456', 2, 'สารสนเทศศึกษา', 706924),
('67101010129', 'มาลี โชคดี', 'malee.c@g.swu.ac.th', '084-678-4567', 2, 'สารสนเทศศึกษา', 706924),
('67101010772', 'กิตติพจน์ แสง', 'kittipot.s@g.swu.ac.th', '085-789-5678', 2, 'สารสนเทศศึกษา', 706924),
('67101010515', 'ณัฐมล ปิ่น', 'nuttamon.p@g.swu.ac.th', '086-890-6789', 2, 'สารสนเทศศึกษา', 706924),
('67101010933', 'อาทิตย์ ฟ้า', 'arthit.f@g.swu.ac.th', '087-901-7890', 2, 'สารสนเทศศึกษา', 706924),
('67101010248', 'เบญจวรรณ งาม', 'benjawan.n@g.swu.ac.th', '088-012-8901', 2, 'สารสนเทศศึกษา', 706924),
('67101010681', 'ภานุวัฒน์ ยอด', 'phanuwat.y@g.swu.ac.th', '089-123-9012', 2, 'สารสนเทศศึกษา', 706924),
('67101010804', 'จุฬารัตน์ เปรม', 'jularat.p@g.swu.ac.th', '090-234-0123', 2, 'สารสนเทศศึกษา', 706924),
('66101010345', 'ธีรยุทธ คง', 'teerayut.k@g.swu.ac.th', '081-111-2222', 3, 'สารสนเทศศึกษา', 706923),
('66101010721', 'วราภรณ์ สุข', 'waraporn.s@g.swu.ac.th', '082-222-3333', 3, 'สารสนเทศศึกษา', 706923),
('66101010567', 'สุเทพ แสง', 'suthep.s@g.swu.ac.th', '083-333-4444', 3, 'สารสนเทศศึกษา', 706923),
('66101010112', 'ดวงใจ ดี', 'duangjai.d@g.swu.ac.th', '084-444-5555', 3, 'สารสนเทศศึกษา', 706923),
('66101010903', 'ณรงค์ ศรีใส', 'narong.s@g.swu.ac.th', '085-555-6666', 3, 'สารสนเทศศึกษา', 706923),
('66101010444', 'เพ็ญศรี อ่อน', 'pensri.o@g.swu.ac.th', '086-666-7777', 3, 'สารสนเทศศึกษา', 706923),
('66101010221', 'เฉลิมพล', 'chaloem.p@g.swu.ac.th', '087-777-8888', 3, 'สารสนเทศศึกษา', 706923),
('66101010889', 'รัชนี จันทร์', 'rachanee.c@g.swu.ac.th', '088-888-9999', 3, 'สารสนเทศศึกษา', 706923),
('66101010672', 'สิทธิชัย กล้า', 'sitthichai.k@g.swu.ac.th', '089-999-0000', 3, 'สารสนเทศศึกษา', 706923),
('66101010319', 'อมรา รัก', 'amara.r@g.swu.ac.th', '090-000-1111', 3, 'สารสนเทศศึกษา', 706923),
('65101010552', 'ปรีชา มั่น', 'preecha.m@g.swu.ac.th', '081-555-0001', 4, 'สารสนเทศศึกษา', 710238),
('65101010814', 'ศิริพร เพ็ญ', 'siriporn.p@g.swu.ac.th', '082-555-0002', 4, 'สารสนเทศศึกษา', 710238),
('65101010423', 'วิชัย ทอง', 'vichai.t@g.swu.ac.th', '083-555-0003', 4, 'สารสนเทศศึกษา', 710238),
('65101010291', 'ลัดดาวัลย์ เย็น', 'laddawan.y@g.swu.ac.th', '084-555-0004', 4, 'สารสนเทศศึกษา', 710238),
('65101010776', 'สมศักดิ์ บุญ', 'somsak.b@g.swu.ac.th', '085-555-0005', 4, 'สารสนเทศศึกษา', 710238),
('65101010998', 'ขวัญใจ จิตร', 'kwanjai.j@g.swu.ac.th', '086-555-0006', 4, 'สารสนเทศศึกษา', 710238),
('65101010115', 'บุญส่ง แก้ว', 'boonsong.k@g.swu.ac.th', '087-555-0007', 4, 'สารสนเทศศึกษา', 710238),
('65101010362', 'รัตนา ฉัตร', 'rattana.c@g.swu.ac.th', '088-555-0008', 4, 'สารสนเทศศึกษา', 710238),
('65101010649', 'ประเสริฐ ศักดิ์', 'prasert.s@g.swu.ac.th', '089-555-0009', 4, 'สารสนเทศศึกษา', 710238),
('65101010881', 'วิไลวรรณ ศรี', 'wilaiwan.s@g.swu.ac.th', '090-555-0010', 4, 'สารสนเทศศึกษา', 710238);

-- เพิ่มข้อมูลบุคลากร
INSERT INTO staff (staff_id, username, password, role) VALUES
('AM01', 'admin', '1234', 'admin'),
('TC01', 'teacher', '1234', 'teacher');