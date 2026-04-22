<?php
session_start();

// ลบค่าทั้งหมดใน session
$_SESSION = [];

// ทำลาย session
session_destroy();

// (เสริม) ลบ session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// redirect ไปหน้า login
header("Location: login.php");
exit();
?>