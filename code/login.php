<?php
session_start(); // Khởi tạo phiên làm việc
include 'db.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username']; 
    $password = $_POST['password'];

    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['logged_in'] = true;
            echo "<script>alert('Đăng nhập thành công!'); window.location.href='home.php';</script>";
            exit;
        } else {
            echo "<script>alert('Mật khẩu không chính xác');</script>";
        }
    } else {
        echo "<script>alert('Username không tồn tại');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang đăng nhập</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="main">
        <form id="Form" class="loginForm" action="login.php" method="post">
            <h1>Đăng nhập</h1>
            <div class="inputData">
                <label for="username">Username</label>
                <input id="username" name="username" type="text" required>
                <div class="errorInfo"></div>
            </div>
            <div class="inputData">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" required>
                <div class="errorInfo"></div>
            </div>
            <button type="submit">Đăng nhập</button>
            <p class="loginNav">Bạn chưa có tài khoản? <a style="color: blue;" href="register.php">Đăng ký ngay</a></p>
        </form>
    </div>

    <script>
    document.getElementById("Form").addEventListener("submit", function(event) {
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;

        if (username === ""|| password === "") {
            alert("Vui lòng nhập đầy đủ thông tin");
            event.preventDefault();
        }
    });
    </script>
</body>
</html>