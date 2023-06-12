<?php
require 'koneksi.php';

session_start();

if (!isset($_SESSION["logged_in"])) {
	echo "<script>alert('ANDA HARUS LOGIN TERLEBIH DAHULU');
	window.location = 'login.php';
	</script>";
 exit();
} 

$user_id = $_SESSION["user_id"];

$dataFasilitas = tampil("SELECT pf.no_pengaduan, pf.user_id, pf.judul, u.nama, pf.status, pf.keterangan_laporan, pf.gambar
FROM pengaduan_fasilitas pf
JOIN user u ON pf.user_id = u.user_id
WHERE pf.user_id = '$user_id';");

$dataSusila = tampil("SELECT ps.no_pengaduan, ps.user_id, ps.judul, u.nama, ps.status, ps.keterangan_laporan
FROM pengaduan_susila ps
JOIN user u ON ps.user_id = u.user_id
WHERE ps.user_id = '$user_id';");

$dataKekerasan = tampil("SELECT pk.no_pengaduan, pk.user_id, pk.judul, u.nama, pk.status, pk.keterangan_laporan
FROM pengaduan_kekerasan pk
JOIN user u ON pk.user_id = u.user_id
WHERE pk.user_id = '$user_id';");

$dataLain = tampil("SELECT pl.no_pengaduan, pl.user_id, pl.judul, u.nama, pl.status, pl.keterangan_laporan, pl.gambar
FROM pengaduan_lain pl
JOIN user u ON pl.user_id = u.user_id
WHERE pl.user_id = '$user_id';");

$data = array_merge($dataFasilitas, $dataSusila, $dataKekerasan, $dataLain);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

                .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px;
        background-color: #f2f2f2;
        }

        .header img {
        height: 40px;
        }

        .header .ul {
        display: flex;
        align-items: center;
        }

        .header .ul ul {
        margin-right: 10px;
        }

        .header .ul ul a {
        text-decoration: none;
        color: #333;
        padding: 5px;
        }

        .header .ul ul a:hover {
        color: #555;
        }

        .header .ul ul:last-child {
        margin-right: 0;
        }

        .header .ul form {
        margin-left: 10px;
        }

        .header .ul button {
        padding: 5px 10px;
        background-color: #333;
        color: #fff;
        border: none;
        cursor: pointer;
        }

        .header .ul button:hover {
        background-color: #555;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        img{
            width: 250px;
        }

        .kotak {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        .judul {
            margin-top: 0;
        }

        .status {
            margin-top: 0;
            color: #888;
        }

        .gambar {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        .berita {
            margin-top: 0;
            font-size: 15px;
            width: 500px; 
            height: 100px;
            resize: none;
        }

        .pengguna {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
<div class="header">
    <img src="asset/logo.svg" >
    <div class="ul">
            <ul> <a href="index.php">Homepage</a></ul>
    </div>
    </div>
    <div class="container">
        <h1>DAFTAR LAPORAN SAYA</h1>
        <?php foreach ($data as $row) : ?>
            <div class="kotak">
                <h4 class="judul"><?= $row["no_pengaduan"] ?></h4>
                <h2 class="judul">Judul : <?= $row["judul"] ?></h2>
                <h3 class="status">Status : <?= $row["status"] ?></h3>
                <?php if (!empty($row["gambar"])) : ?>
                    <img class="gambar" src="gambar/<?= $row["gambar"] ?>" alt="Gambar" />
                <?php endif; ?>
                <textarea class="berita" readonly><?= $row["keterangan_laporan"] ?></textarea>
                <p class="pengguna">Ditulis oleh: <?= $row["nama"] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
