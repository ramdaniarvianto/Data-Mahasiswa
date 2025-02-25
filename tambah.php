<?php 
session_start();
require "functions.php";

if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

$mahasiswa = query("SELECT * FROM mahasiswa");

if ( isset($_POST["logout"]) ) {
    header("Location: logout.php");
    exit;
}

if ( isset($_POST["submit"]) ) {
    if ( tambah($_POST) > 0 ) {
        echo "
            <script>
                alert('Data berhasil ditambah!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data tidak ditambah!');
            </script>
        ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCKI | Tambah Mahasiswa</title>
    <link rel="stylesheet" href="tamubah.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bricolage+Grotesque">
    <script src="https://kit.fontawesome.com/98721b54aa.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav>
        <p><a href="index.php" class="logout">Kembali</a></p>
    </nav>
    
    <main>
        <h1><i class="fa-solid fa-user-plus p-tambah-h1"></i> Tambah Mahasiswa</h1>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-wrap">
                <div class="form">
                    <p>Nama</p>
                    <input type="text" name="nama" id="nama" placeholder="Masukan Nama" autocomplete="off" required>
                </div>
                <div class="form">
                    <p>NIM</p>
                    <input type="text" name="nim" id="nim" placeholder="Masukan NIM" autocomplete="off" required>
                </div>
                <div class="form">
                    <p>Prodi</p>
                    <input type="text" name="prodi" id="prodi" placeholder="Masukan Prodi" autocomplete="off" required>
                </div>
                <div class="form">
                    <p>Semester</p>
                    <input type="text" name="semester" id="semester" placeholder="Masukan Semester" autocomplete="off" required>
                </div>
                <div class="form">
                    <p>Email</p>
                    <input type="text" name="email" id="email" placeholder="Masukan Email" autocomplete="off" required>
                </div>
                <div class="form">
                    <p>Gambar</p>
                    <input type="file" name="gambar" id="gambar" placeholder="Gambar" autocomplete="off">
                </div>
            </div>
            <div class="button">
                <button type="submit" name="submit">Tambah Mahasiswa</button>
            </div>
        </form>
    </main>
</body>
</html>