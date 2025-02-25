<?php 
session_start();
require "functions.php";

if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

$id = $_GET["id"];

$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];

if ( isset($_POST["submit"]) ) {
    if ( ubah($_POST) > 0 ) {
        echo "
            <script>
                alert('Data berhasil diubah!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data tidak diubah!');
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
    <title>SCKI | Ubah Data Mahasiswa</title>
    <link rel="stylesheet" href="tamubah.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bricolage+Grotesque">
    <script src="https://kit.fontawesome.com/98721b54aa.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav>
        <p><a href="index.php" class="logout">Kembali</a></p>
    </nav>
    
    <main>
        <h1><i class="fa-regular fa-pen-to-square p-tambah-h1"></i> Ubah Data Mahasiswa</h1>

        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" id="id" value="<?= $mhs["id"]; ?>">
            <input type="hidden" name="gambarLama" id="gambarLama" value="<?= $mhs["gambar"]; ?>">
            <div class="form-wrap">
                <div class="form">
                    <p>Nama</p>
                    <input type="text" name="nama" id="nama" value="<?= $mhs["nama"]; ?>" placeholder="Masukan Nama Baru" autocomplete="off" required>
                </div>
                <div class="form">
                    <p>NIM</p>
                    <input type="text" name="nim" id="nim" value="<?= $mhs["nim"]; ?>" placeholder="Masukan NIM Baru" autocomplete="off" required>
                </div>
                <div class="form">
                    <p>Prodi</p>
                    <input type="text" name="prodi" id="prodi" value="<?= $mhs["prodi"]; ?>" placeholder="Masukan Prodi Baru" autocomplete="off" required>
                </div>
                <div class="form">
                    <p>Semester</p>
                    <input type="text" name="semester" id="semester" value="<?= $mhs["semester"]; ?>" placeholder="Masukan Semester Baru" autocomplete="off" required>
                </div>
                <div class="form">
                    <p>Email</p>
                    <input type="text" name="email" id="email" value="<?= $mhs["email"]; ?>" placeholder="Masukan Email Baru" autocomplete="off" required>
                </div>
                <div class="form">
                    <p>Gambar</p>
                    <img src=".image/<?= $mhs["gambar"]; ?>">
                    <input type="file" name="gambar" id="gambar" placeholder="Gambar" autocomplete="off">
                    <b></b>
                </div>
            </div>
            <div class="button">
                <button type="submit" name="submit">Ubah Data Mahasiswa</button>
            </div>
        </form>
    </main>
</body>
</html>