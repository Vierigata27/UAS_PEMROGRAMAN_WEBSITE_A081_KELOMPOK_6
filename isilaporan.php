<?php
require 'koneksi.php';

session_start();

if (!isset($_SESSION["logged_in"])) {
    echo "<script>alert('ANDA HARUS LOGIN TERLEBIH DAHULU');
    window.location = 'login.php';
    </script>";
 exit();
}


$no_berita = $_GET["kode"];
$user = $_SESSION["user_id"];


$data = mysqli_query($koneksi, "SELECT b.no_pengaduan, b.user_id, b.judul, u.nama, b.status, b.keterangan_laporan, 
b.gambar, b.waktu, b.hasil_berita, b.no_berita, u.foto
FROM berita b
JOIN user u ON b.user_id = u.user_id
WHERE no_berita = '$no_berita'")->fetch_assoc();

$komentar = tampil("SELECT k.no_berita, k.user_id, k.teks, u.nama, u.foto FROM komentar k JOIN user u ON k.user_id = u.user_id WHERE no_berita = '$no_berita'");

if(isset($_POST['submit'])) {
    if(komentar($_POST) > 0) {
        echo "<script>alert('Berhasil Memberikan Komentar');</script>";
        header("Refresh:1");
    } else {
        echo mysqli_error($koneksi);
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <link rel="stylesheet" href="asset/stylesheet_laporan_saya.css">
</head>
<body>
    <header class="head-container">
        <div class="head-wrapper1">
            <div class="logo_wrapper">
                <img src="asset/Logo_Padum.svg">
            </div>
            <div class="text_wrapper">
                <h3>Postingan Laporan</h3>
            </div>
        </div>
        <div class="head-wrapper2">
            <div class="head_name_wrapper1">
                <div class="head-name1">
                    <a href="index.php" class="beranda_name">Beranda</a>
                </div>
                <div class="head-name2">
                    <!-- <a href="" class="news_name">News <img src="asset/Arrow.svg"></a> -->
                </div>
            </div>
            <!-- <a href="" class="img_logo_wrap2"><img src="asset/Logo Akun.svg"></a> -->
        </div>
    </header>
    <div class="prim-container">
        <div class="body-container">
            <div class="top-container">
                <div class="top-label">
                    <div class="top_label_name">
                        <img src="gambar/<?= $data["foto"]; ?>">
                        <div class="label_name">
                            <h4><?= $data["judul"]; ?></h4>
                            <div class="label_item">
                                <p class="label_nomor">Nomor Laporan : </p>
                                <p class="db_nomor"><?= $data["no_pengaduan"]; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="top_label_opt">
                        <div class="label_kemajuan">
                            <p><?= $data["status"]; ?></p>
                        </div>
                        <a href="" class="elips-small"><img src="asset/Lingkaran Kecil.svg"></a>
                    </div>
                </div>
                <p class="desc_report"><?= $data["keterangan_laporan"]; ?></p>
                <div class="img-proof">
                    <p>Lampiran</p>
                    <div class="img-bukti">
                    <?php if (!empty($data["gambar"])) : ?>
                        <img src="gambar/<?= $data["gambar"]; ?>">
                        <?php endif; ?>
                    </div>
                </div>
                <div class="time_desc">
                    <p>upload : <?= $data["waktu"]; ?></p>
                </div>
            </div>
            <div class="bot-container">
                <p class="label_comment">Komentar Pengguna Lain :</p>
                <!-- Untuk komentar pengguna ini nanti sistemnya memakai foreach di php ya -->
                <?php foreach ($komentar as $komentar_row) : ?>
                <div class="comment-wrapper">
                    <div class="comment_wrap_label">
                        <div class="right_label">
                            <img src="gambar/<?= $komentar_row["foto"] ?>" alt="">
                            <div class="right_label_desc">
                                <div class="type_account">
                                    <p>USER</p>
                                </div>
                                <p class="user_name"><?= $komentar_row["nama"] ?></p>
                            </div>
                        </div>
                        <!-- ini nanti pakai date yang tersimpan di DB ya -->
                        <p class="time_post">15 mnt yang lalu</p>
                    </div>
                    <!-- bagian komen nanti disambungkan ke DB juga -->
                    <p class="comment"><?= $komentar_row["teks"] ?>
                    </p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <footer class="footer_container">
        <form action="" method="post">
            <div class="component">
                <img src="asset/Logo Akun.svg" alt="">
                <div class="foot_comment">
                    <input type="hidden" class="input_komen" name="user_id" value="<?= $user ?>">
                    <input type="hidden" class="input_komen" name="no_berita" value="<?= $no_berita?>">
                    <input type="text" class="input_komen" placeholder="Tambahkan Komentar " name="teks">
                    <button type="submit" name="submit" class="send_comment" src="Send Comment.svg" alt="Submit Button"><img src="asset/Send Comment.svg"></button>
                </div>
            </div>
        </form>
    </footer>
</body>
</html>