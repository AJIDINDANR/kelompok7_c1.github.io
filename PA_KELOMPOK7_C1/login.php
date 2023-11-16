<?php
session_start();
require 'koneksi.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $uid = $_POST['loginusername']; 
        $password = $_POST['loginpassword'];

        $sql = "SELECT * FROM user WHERE uid = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $uid, $password);
        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
            
                $_SESSION['id_user'] = $row['id_user'];
                $_SESSION['username'] = $uid;
                $_SESSION['logged_in'] = true;
            
                if ($row['user_type'] == 'admin') {
                    header("Location: admin.php");
                    exit;
                } else {
                    
                    $_SESSION['welcome_message'] = 'Selamat datang, ' . $uid;
            
                    header("Location: index.php");
                    exit;
                }
            } else {
                $message = 'Password atau uid salah.';
                echo "Error: " . $stmt->error;
            }
        }
        mysqli_stmt_close($stmt);
    } else if (isset($_POST['daftar'])) {
        $uid = $_POST['username'];
        $password = $_POST['password'];
        $ulangi = $_POST['ulangi'];
        if ($password == $ulangi) {
            $stmt = $conn->prepare("INSERT INTO user (uid, password) VALUES (?, ?)"); 
            $stmt->bind_param("ss", $uid, $password);
            if ($stmt->execute()) {
                header("Location: login.php");
                exit;
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "Error: Passwords do not match.";
        }
        mysqli_stmt_close($stmt);
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membuat Form Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<div class="wrapper">
    <div class="title-text">
        <div class="title login">Login</div>
        <div class="title signup">Registrasi</div>
    </div>
    <div class="form-container">
        <div class="slide-controls">
            <input type="radio" name="slide" id="login" checked>
            <input type="radio" name="slide" id="signup">
            <label for="login" class="slide login">Login</label>
            <label for="signup" class="slide signup">Daftar</label>
            <div class="slider-tab"></div>
        </div>
        <div class="form-inner">
            <form action="login.php" class="login" method="post">
                <div class="field">
                    <input type="text" name="loginusername" placeholder="Masukan Nama" required>
                </div>
                <div class="field">
                    <input type="password" name="loginpassword" placeholder="Masukan Password" required>
                </div>
                <?php echo $message; ?>
                <div class="field btn">
                    <div class="btn-layer"></div>
                    <input type="submit" name="login">
                </div>
                <div class="signup-link">Buat akun <a href="">Daftar sekarang</a></div>
            </form>
            <form method="post" onsubmit="return confirmform();" class="signup">
                <div class="field">
                    <input type="text" name="username" placeholder="Masukan Nama" required>
                </div>
                <div class="field">
                    <input type="password" id="password" name="password" placeholder="Masukan Password" required>
                </div>
                <div class="field">
                    <input type="password" id="ulangi" name="ulangi" placeholder="Ulangi password" required>
                    <span id="warning" style="color: red;"></span>
                </div>
                <div class="field btn">
                    <div class="btn-layer"></div>
                    <input type="submit" name="daftar">
                </div>
                <div class="signup-link">Sudah punya akun? <a href="">Login</a></div>
            </form>
        </div>
    </div>
</div>
<script src="script.js"></script>
</body>
</html>
