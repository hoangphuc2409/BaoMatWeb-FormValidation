<?php
session_start();

// Kiểm tra nếu người dùng chưa đăng nhập, chuyển hướng về trang đăng nhập
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Truy xuất tên người dùng từ phiên
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="main">
        <h1>Chào mừng <?php echo htmlspecialchars($username); ?> đến với Trang Chủ!</h1>
        <p>Bạn đã đăng nhập thành công.</p>
        <p><a href="logout.php">Đăng xuất</a></p>
    </div>
</body>
</html>