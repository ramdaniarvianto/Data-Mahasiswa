<?php 
session_start();
require "functions.php";

if ( isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

$mahasiswa = query("SELECT * FROM mahasiswa");

if ( isset($_POST["logout"]) ) {
    header("Location: logout.php");
    exit;
}

if ( isset($_POST["register"]) ) {
    if ( register($_POST) > 0 ) {
        echo "
            <script>
                alert('Berhasil mendaftar');
                document.location.href = 'login.php';
            </script>
        ";
    } else {
        echo mysqli_error($dbconn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCKI | Register</title>
    <link rel="stylesheet" href="loregi.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bricolage+Grotesque">
    <script src="https://kit.fontawesome.com/98721b54aa.js" crossorigin="anonymous"></script>
</head>
<body>
    <main>
        <h1>Register</h1>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-wrap">
                <div class="form">
                    <p>Username</p>
                    <input type="text" name="username" id="username" placeholder="Masukkan Username" autocomplete="off" required>
                </div>
                <div class="form">
                    <p>Password</p>
                    <input type="password" name="password" id="password" placeholder="Masukkan Password" autocomplete="off" required>
                </div>
                <div class="form">
                    <p>Confirm Password</p>
                    <input type="password" name="password2" id="password2" placeholder="Masukkan Password Sekali Lagi" autocomplete="off" required>
                </div>
            </div>
            <div class="cta">
                <p>Sudah punya akun? <a href="login.php">Login</a></p>
            </div>
            <div class="button">
                <button type="submit" name="register">Register</button>
            </div>
        </form>
    </main>
</body>
</html>