<?php 
session_start();
require "functions.php";

if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

$jumlahDataPerHalaman = 5;
$jumlahData = count(query("SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
$awalData = ( $jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;

$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awalData, $jumlahDataPerHalaman");

if ( isset($_POST["cari"]) ) {
    $mahasiswa = cari($_POST["keyword"]);
}

if ( isset($_POST["logout"]) ) {
    header("Location: logout.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCKI | Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bricolage+Grotesque">
    <script src="https://kit.fontawesome.com/98721b54aa.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav>
        <form action="" method="POST">
            <p><i class="fa-regular fa-calendar"></i> <?= $today; ?> - <?= $time; ?></p>
            <p><button type="submit" name="logout" class="logout">Logout</button></p>
        </form>
    </nav>

    <main>
        <p class="welcome"><i class="fa-regular fa-user"></i> Halo, selamat <?= greet(); ?></p>

        <h1>Data Mahasiswa</h1>

        <div class="search">
            <form action="" method="POST">
                <input type="text" name="keyword" id="keyword" placeholder="Cari data mahasiswa..." autocomplete="off" size="50">
                <button type="submit" name="cari">Cari</button>
            </form>
        </div>

        <div class="tambah">
            <p><a href="tambah.php" class="tambah"><i class="fa-solid fa-user-plus"></i> Tambah Mahasiswa</a></p>
        </div>

        <div class="pagination">
            <?php if ( $halamanAktif > 1 ) : ?>
                <a href="?halaman=<?= $halamanAktif - 1; ?>" class="move"><i class="fa-solid fa-caret-left"></i></a>
            <?php else : ?>
                <a class="move"><i class="fa-solid fa-caret-left"></i></a>
            <?php endif; ?>

            <?php for ( $i = 1; $i <= $jumlahHalaman; $i++ ) : ?>
                <?php if ( $i == $halamanAktif ) : ?>
                    <a href="?halaman=<?= $i; ?>" class="pagination-aktif"><?= $i; ?></a>
                <?php else : ?>
                    <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ( $halamanAktif < $jumlahHalaman ) : ?>
                <a href="?halaman=<?= $halamanAktif + 1; ?>" class="move"><i class="fa-solid fa-caret-right"></i></a>
            <?php else : ?>
                <a class="move"><i class="fa-solid fa-caret-right"></i></a>
            <?php endif; ?>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Prodi</th>
                    <th>Semester</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = $awalData + 1; ?>
                <?php foreach ( $mahasiswa as $mhs ) : ?>
                <tr>
                    <td data-cell="No" class="td-center"><?= $no; ?></td>
                    <td data-cell="Gambar" class="td-center"><img src=".image/<?= $mhs["gambar"]; ?>"></td>
                    <td data-cell="Nama"><?= $mhs["nama"]; ?></td>
                    <td data-cell="NIM" class="td-center"><?= $mhs["nim"]; ?></td>
                    <td data-cell="Prodi" class="td-center"><?= $mhs["prodi"]; ?></td>
                    <td data-cell="Semester" class="td-center"><?= $mhs["semester"]; ?></td>
                    <td data-cell="Email"><?= $mhs["email"]; ?></td>
                    <td data-cell="Aksi" class="td-center btn-aksi">
                        <a href="ubah.php?id=<?= $mhs["id"]; ?>" class="ubah"><i class="fa-regular fa-pen-to-square"></i>Edit</a>&nbsp;
                        <a href="hapus.php?id=<?= $mhs["id"]; ?>" class="hapus" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fa-regular fa-trash-can"></i>Delete</a>
                    </td>
                </tr>
                <?php $no++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>