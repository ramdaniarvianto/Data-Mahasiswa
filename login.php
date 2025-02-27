<?php 
session_start();
require "functions.php";

if ( isset($_SESSION["login"]) ) {
    header("Location: index.php");
    exit;
}

if ( isset($_COOKIE["id"]) && isset($_COOKIE["key"]) ) {
    $id = $_COOKIE["id"];
    $key = $_COOKIE["key"];

    $checkcookie = mysqli_query($dbconn, "SELECT username FROM pengguna WHERE id = '$id'");
    $cookie = mysqli_fetch_assoc($checkcookie);
    
    if ( $key === hash("sha256", $cookie["username"]) ) {
        $_SESSION["login"] = true;
    }
}

$mahasiswa = query("SELECT * FROM mahasiswa");

if ( isset($_POST["logout"]) ) {
    header("Location: logout.php");
    exit;
}

if ( isset($_POST["login"]) ) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $checkuser = mysqli_query($dbconn, "SELECT * FROM pengguna WHERE username = '$username'");
    if ( mysqli_num_rows($checkuser) === 1 ) {
        $row = mysqli_fetch_assoc($checkuser);
        if ( password_verify($password, $row["password"]) ) {
            $_SESSION["login"] = true;

            setcookie("id", $row["id"], time()+3600);
            setcookie("key", hash("sha256", $row["username"]), time()+3600);

            header("Location: index.php");
            exit;
        }
    }
    $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCKI | Login</title>
    <link rel="stylesheet" href="loregi.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bricolage+Grotesque">
    <script src="https://kit.fontawesome.com/98721b54aa.js" crossorigin="anonymous"></script>
</head>
<body>
    <main>
        <h1>Login</h1>

        <?php if ( isset($error) ) : ?>
            <div class="error">
                <p>Username atau password salah!</p>
            </div>
        <?php endif; ?>

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
                <div class="check">
                    <input type="checkbox" name="remember" id="remember"> <label for="remember">Remember me</label>
                </div>
            </div>
            <div class="cta">
                <p>Belum punya akun? <a href="register.php">Register</a></p>
            </div>
            <div class="button">
                <button type="submit" name="login">Login</button>
            </div>
        </form>
    </main>
</body>
</html>