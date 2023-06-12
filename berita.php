<?php
require 'koneksi.php';

$dataFasilitas = tampil("SELECT pf.no_pengaduan, pf.user_id, pf.judul, u.nama, pf.status, pf.keterangan_laporan, pf.gambar
FROM pengaduan_fasilitas pf
JOIN user u ON pf.user_id = u.user_id
WHERE user_id = $user_id;");

$dataSusila = tampil("SELECT ps.no_pengaduan, ps.user_id, ps.judul, u.nama, ps.status, ps.keterangan_laporan
FROM pengaduan_susila ps
JOIN user u ON ps.user_id = u.user_id;");

$dataKekerasan = tampil("SELECT pk.no_pengaduan, pk.user_id, pk.judul, u.nama, pk.status, pk.keterangan_laporan
FROM pengaduan_kekerasan pk
JOIN user u ON pk.user_id = u.user_id;");

$dataLain = tampil("SELECT pl.no_pengaduan, pl.user_id, pl.judul, u.nama, pl.status, pl.keterangan_laporan, pl.gambar
FROM pengaduan_lain pl
JOIN user u ON pl.user_id = u.user_id;");

$data = array_merge($dataFasilitas, $dataSusila, $dataKekerasan, $dataLain);

if(isset($_POST['submit'])) {
    if(komentar($_POST) > 0) {
        echo "<script>alert('Berhasil Memberikan Komentar');
        window.location = 'berita.php';
        </script>";  
    } else {
        echo mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contoh Kotak Berita</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .judulhalaman {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f1f1f1;
            padding: 20px;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }

        .kotak {
            background-color: #f1f1f1;
            padding: 20px;
            margin-bottom: 20px;
        }

        .judul {
            font-size: 24px;
            font-weight: bold;
            margin: 0 0 10px;
        }

        .gambar {
            max-width: 150px;
            height: auto;
            margin-bottom: 10px;
        }

        .berita {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .pengguna {
            font-size: 14px;
            font-style: italic;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="judulhalaman">
        <h1>BERITA HARI INI</h1>
    </div>
    <?php foreach ($data as $row) : ?>
        <div class="kotak">
            <h2 class="judul"><?= $row["judul"] ?></h2>
            <h3><?= $row["status"] ?></h3>
            <?php if (!empty($row["gambar"])) : ?>
            <img class="gambar" src="gambar/<?= $row["gambar"] ?>" alt="Gambar" />
            <?php endif; ?>
            <p class="berita"><?= $row["keterangan_laporan"] ?></p>
            <p class="pengguna">Ditulis oleh: <?= $row["nama"] ?></p>
            
            <form action="" method="post">
                <input type="hidden" name="no_pengaduan" value="<?= $row["no_pengaduan"] ?>" />
                <input type="hidden" name="user_id" value="<?= $row["user_id"] ?>" />
                <textarea name="teks" placeholder="Tambahkan komentar..." rows="4" cols="50"></textarea>
                <button type="submit" name="submit">Kirim</button>
            </form>
            
            <h4>Komentar:</h4>
            <?php 
            $no_pengaduan = $row["no_pengaduan"];
            $komentar = tampil("SELECT k.no_pengaduan, k.user_id, k.teks, u.nama FROM komentar k JOIN user u ON k.user_id = u.user_id WHERE k.no_pengaduan = '$no_pengaduan'");
            foreach ($komentar as $komentar_row) : ?>
                <h4>nama : <?= $komentar_row["nama"] ?></h4>
                <p><?= $komentar_row["teks"] ?></p>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</body>
</html>
