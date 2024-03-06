<?php
session_start();
// Xóa tất cả dữ liệu phiên
$_SESSION = array();
// Hủy phiên
session_destroy();
// Chuyển hướng người dùng về trang đăng nhập
echo "<script>alert('Bạn đã đăng xuất thành công.'); window.location.href='login.php';</script>";
exit;