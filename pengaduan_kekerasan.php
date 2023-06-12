<?php
require 'koneksi.php'; // panggil file koneksi.php yang berisi fungsi signup()

session_start();

if (!isset($_SESSION["logged_in"])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION["email"];

$user = mysqli_query($koneksi, "SELECT user_id FROM user WHERE email = '$email'")->fetch_assoc();

if(isset($_POST['submit'])) {
    if(pengaduan_kekerasan($_POST) > 0) {
        echo "<script>alert('Pengaduan Berhasil');
        window.location = 'succes.php';
        </script>";  
    } else {
        echo mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Aspirasi</title>
    <link rel="stylesheet" href="asset/layout_pengaduan.css">
</head>
<body>
    <header class="prim-header">
        <div class="head-container">
            <div class="head-wrapper1">
                <div class="logo_wrapper">
                    <img src="asset/logo_padum2.svg">
                </div>
            </div>
            <div class="head-wrapper2">
                <div class="head_name_wrapper1">
                    <div class="head-name1">
                        <a href="index.php" class="beranda_name">Beranda</a>
                    </div>
                </div>
                <a href="akun.php" class="img_logo_wrap2"><img src="asset/Logo Akun.svg"></a>
            </div>
        </div>
    </header>
        <div class="top-container">
            <div class="text-title">
                <h2>Sampaikan Laporan Anda</h2>
            </div>
            <div class="img-bg">
                <img src="asset/pictgelombang.svg" width="100%">
            </div>
        </div>
    <div class="prim-container">
        <form action="" method="post">
        <input type="hidden"  value="Vertifikasi" name="status">
            <input type="hidden" name="user_id" value="<?=$user["user_id"];?>">
            <div class="main-container">
                <div class="sec_main">
                    <div class="opt_title">
                        <p class="title_opt">Pilih Keluhan Anda!</p>
                        <div class="option_val">
                        <div class="opt1">
                                <a href="pengaduan_fasilitas.php"><p>Tindak Fasilitas</p></a>
                            </div>
                            <div class="opt2">
                                <a href="pengaduan_asusila.php"><p>Tindak Asusila</p></a>
                            </div>
                            <div class="opt3">
                                <a href="pengaduan_kekerasan.php"><p>Tindak kekerasan</p></a>
                            </div>
                            <div class="opt4">
                                <a href="pengaduan_lain.php"><p>Tindak Lain Lain</p></a>
                            </div>
                        </div>
                    </div>
                    <div class="report_title">
                        <h2>Tindak kekerasan</h2>
                        <label>Masukkan Judul Laporan Anda</label>
                        <div class="input_title">
                            <input type="text" placeholder="Tuliskan Judulmu Disini" name="judul" required>
                        </div>
                    </div>
                    <div class="desc_report">
                        <label>Jelaskan Detail Laporanmu Disini</label>
                        <textarea class="textArea" name="keterangan_laporan"  placeholder="Jelaskan Detail Laporanmu Disini"></textarea>
                    </div>
                    <div class="date_report">
                        <label>Pilih Tanggal Pelaporan</label>
                        <input type="date" placeholder="Pilih Tanggal" name="waktu" required>
                    </div>
                    <div class="address_report">
                        <label>Gedung/Tempat</label>
                        <select class="opt_address" name="tempat">
                            <option value="">Pilih Salah Satu</option>
                            <option value="Gedung FIK 1">Gedung FIK 1</option>
                            <option value="Gedung FIK 2">Gedung FIK 2</option>
                        </select>
                    </div>
                </div>
                <div class="btn-next">
                    <button type="submit" name="submit">KIRIM</button>
                </div>
            </div>
        </form>
    </div>
</div>
    <footer class="footer">
        <div class="logo-kiri">
            <div>
                <img src="asset/logo.svg" alt="padum" width="170" height="70">
            </div>
            <div class="footer-upn">
                <img src="asset/upn.svg" alt="upn" width="91" height="90">
                <p>Universitas Pembangunan Nasional Veteran Jawa Timur</p>
            </div>
        </div>
        <div class="aduan">
            <h3>Kanal Aduan</h3>
            <a href="">
                <p>Siadu (Sistem Informasi Aduan)UPN “Veteran” Jawa Timur</p>
            </a>
            <a href="">
                <p>Siamik (Sistem Informasi Akademik)
                    UPN “Veteran” Jawa Timur</p>
            </a>
            <a href="">
                <p>Polam (Portal Layanan Mahasiswa)UPN “Veteran” Jawa Timur</p>
            </a>
        </div>
        <div class="temukan-kami">
            <h3>Temukan Kami di :</h3>
            <div class="social"><img src="asset/instagram.svg" alt="" width="36" height="36">
                <a href=""><b>@upnveteranjatim</b></a>
            </div>
            <div class="social"><img src="asset/twitter.svg" alt="" width="36" height="36">
                <a href=""><b>@upnveteranjatim</b></a>
            </div>
            <div class="social"><img src="asset/facebook.svg" alt="" width="36" height="36">
                <a href=""><b>@upnveteranjatim</b></a>
            </div>
            <div class="social"><img src="asset/email.svg" alt="" width="36" height="28">
                <a href=""><b>@upnveteranjatim</b></a>
            </div>
        </div>
    </footer>
    <div class="copyright">
        <p>Copyright 2023. Aliansi Kelompok Pemweb A081</p>
    </div>
</body>
</html>