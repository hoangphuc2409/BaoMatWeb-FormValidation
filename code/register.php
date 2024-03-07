<?php
include 'db.php';

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Thu thập và lọc dữ liệu đầu vào
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $password = $conn->real_escape_string($_POST['password']);
    $password2 = $conn->real_escape_string($_POST['password2']);

    // Kiểm tra xem có trường nào chưa được nhập hay không
    if (empty($username) || empty($email) || empty($phone) || empty($password) || empty($password2)) {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin.');</script>";
    } else {
        // Kiểm tra mật khẩu và mật khẩu xác nhận có giống nhau không
        if ($password !== $password2) {
            echo "<script>alert('Mật khẩu xác nhận không khớp.');</script>";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Mã hóa mật khẩu

            // Kiểm tra xem username hoặc email đã tồn tại chưa
            $sql = "SELECT id FROM users WHERE username = '$username' OR email = '$email'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Người dùng đã tồn tại
                echo "<script>alert('Username hoặc Email đã được sử dụng');</script>";
            } else {
                // Thêm người dùng mới vào cơ sở dữ liệu
                $sql = "INSERT INTO users (username, email, phone, password) VALUES ('$username', '$email', '$phone', '$hashed_password')";

                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Đăng ký thành công!'); window.location.href='login.php';</script>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
    }

    $conn->close();
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang đăng ký</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="main">
        <form id="Form" class="registerForm" action="register.php" method="post">
            <h1>Đăng ký</h1>

            <div class="inputData">
                <label for="username">Username</label>
                <input id="username" name="username" type="text" required>
                <div class="errorInfo"></div>
            </div>

            <div class="inputData">
                <label for="email">Email</label>
                <input id="email" name="email" type="text" required>
                <div class="errorInfo"></div>
            </div>

            <div class="inputData">
                <label for="phone">Phone Number</label>
                <input id="phone" name="phone" type="text" required>
                <div class="errorInfo"></div>
            </div>

            <div class="inputData">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" required>
                <div class="errorInfo"></div>
            </div>

            <div class="inputData">
                <label for="password2">Confirmed Password </label>
                <input id="password2" name="password2" type="password" required>
                <div class="errorInfo"></div>
            </div>

            <button type="submit">Đăng ký</button>
            <p class="registerNav">Bạn đã có tài khoản? <a style="color: blue;" href="login.php">Đăng nhập tại đây</a></p>
        </form>
    </div>

    <script>
    document.getElementById("Form").addEventListener("submit", function(event) {
        var username = document.getElementById("username").value;
        var email = document.getElementById("email").value;
        var phone = document.getElementById("phone").value;
        var password = document.getElementById("password").value;
        var password2 = document.getElementById("password2").value;

        if (username === "" || email === "" || phone === "" || password === "" || password2 === "") {
            alert("Vui lòng nhập đầy đủ thông tin");
            event.preventDefault();
        }
    });
    </script>
</body>
</html>