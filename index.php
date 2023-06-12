<?php
require 'koneksi.php';

session_start();

$berita = tampil("SELECT b.no_pengaduan, b.user_id, b.judul, u.nama, b.status, b.keterangan_laporan, b.gambar, b.waktu, b.hasil_berita, b.no_berita
FROM berita b
JOIN user u ON b.user_id = u.user_id");

$data = array_reverse($berita);

$query = "SELECT COUNT(*) as total FROM berita";
$totalData = mysqli_fetch_assoc(mysqli_query($koneksi, $query))['total'];

$query1 = "SELECT COUNT(*) as total FROM berita WHERE status = 'Publikasi'";
$totalPublikaasi = mysqli_fetch_assoc(mysqli_query($koneksi, $query1))['total'];

$query2 = "SELECT COUNT(*) as total FROM berita WHERE status = 'Tindak Lanjut'";
$totalPenindakan = mysqli_fetch_assoc(mysqli_query($koneksi, $query2))['total'];

$query3 = "SELECT COUNT(*) as total FROM berita WHERE status = 'Selesai'";
$totalSelesai = mysqli_fetch_assoc(mysqli_query($koneksi, $query3))['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="asset/style.css">
    <title>PADUM</title>
</head>
<body>
<div class="header">
        <ul class="logo"> <h3><img src="asset/padum.svg"  height="65px"></h3></ul>
        <div class="ul">
            <ul> <a href="akun.php">Profil</a> </ul>
            <ul> <a href="laporan.php">Laporan Anda</a></ul>
        </div>
        </div>
    

    <div class="keyweb" align="center">
        <h2>Layanan Aspirasi Pengaduan Mahasiswa</h2>
        <p>UPN "Veteran" Jawa Timur</p>
        <p>"Salurkan Laporanmu Langsung Kepada Badan yang Berwenang"</p>
        <img src="asset/pictgelombang.svg" width="100%">
    </div>
    <div class="kontenindex">
        <div class="beranda">
            <div class="judul"> 
                <div class="tulisan">
                    <b>Beranda/Threads</b>
                </div>
            </div>
            <?php foreach ($data as $row) : ?>
            <div class="isi_konten">
                <div id="gambar1">
                <?php if (!empty($row["gambar"])) : ?>
                    <img src="gambar/<?= $row["gambar"] ?>" width="200px" />
                <?php endif; ?> 
                </div>
                <div id="isi"> 
                    <h3><?= $row["judul"] ?></h3>
                    <h4><?= $row["status"] ?></h4>
                    <textarea readonly><?= $row["keterangan_laporan"] ?></textarea>
                    <?php if (!empty($row["hasil_berita"])) : ?>
                        <p>Hasil Laporan : <?= $row["hasil_berita"] ?></p>
                    <?php endif; ?>
                    <p>Upload tanggal : <?= $row["waktu"] ?></p>
                    <div class="read_more">
                        <div class="pelapor" ><b><?= $row["nama"] ?></b></div>
                        <div class="next_info">
                            <link rel="stylesheet"> 
                        <a href="isilaporan.php?kode=<?= $row["no_berita"]; ?>"> Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
            <br> <?php endforeach; ?>
        </div>
        
        <div class="div2">
            <div class="tatacara">
                <div class="judul2">
                    <div class="tulisan"><b> Tata Cara Pengaduan</b></div>
                </div>
                <div class="detailTatacara">
                    <div class="center">
                        <img src="asset/tulisLaporan.svg"> <br>
                        <b>Tulis Laporan</b>
                        <p>Laporkan Keluhan atau Aspirasi anda dengan jelas dan lengkap.</p>
                    </div>
                    <div class="center">
                        <img src="asset/verif.svg"> <br>
                        <b>Verifikasi</b>
                        <p>Laporan anda akan masuk, lalu diverifikasi dan diteruskan ke badan yang berwenang</p>
                    </div>
                    <div class="center">
                        <img src="asset/penindakan.svg"> <br>
                        <b>Penindakan</b>
                        <p>Dalam beberapa hari, instansi akan menindak lanjuti dan membalas laporan anda</p>
                    </div>
                    <div class="center">
                        <img src="asset/tanggapan.svg"> <br>
                        <b>Beri Tanggapan</b>
                        <p>Laporkan anda akan dipublikasikan dengan dipilih konten yang layak sehingga khalayak dapat memberi tanggapan</p>
                    </div>
                    <div class="center">
                        <img src="asset/Selesai.svg"> <br>
                        <b>Selesai</b>
                        <p>Laporan selesai dibuat</p>
                    </div>
                </div>
            </div>
            <br><br>
            <div class="track">
                <h3>Jumlah Laporan Sekarang : </h3>
                <div class="jumlahlaporan">
                    <div class="nilai"><?= $totalData ?></div>
                </div>
                <div class="flexcolumn">
                    <div class="flex">
                        <b>Dipublikasikan</b>
                        <div class="minijumlah">
                            <div class="jumlahmini"><?= $totalPublikaasi ?></div>
                        </div>
                    </div>
                    <div class="flex">
                        <div><b>Penindakan</b></div>
                        <div class="minijumlah">
                            <div class="jumlahmini"><?= $totalPenindakan ?></div>
                        </div>
                    </div>
                    <div class="flex">
                        <div><b>Selesai</b></div>
                        <div class="minijumlah">
                            <div class="jumlahmini"><?= $totalSelesai ?></div>
                        </div>
                    </div>
                </div>
                <div><a href="pengaduan_fasilitas.php">Laporkan Sekarang </a></div>
            </div> 
            <br><br>
                <?php if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) : ?>
                <div class="daftar">
                    <h3 style="text-align: center">Ayo segera lapor ke PADUM</h3>
                    <div style="text-align: center">
                        <p>
                            Mari yok.... Laporkan segala keluhanmu di aplikasi PADUM, supaya segera diproses oleh badan yang berwenang
                        </p>
                    </div>
                    <div id="logout">
                        <div style="text-align: center"><a href="logout.php">LOG OUT </a></div>
                    </div>
                </div>
            <?php else : ?>
                <div class="daftar">
                    <h3 style="text-align: center">Ayo segera lapor ke PADUM</h3>
                    <div style="text-align: center">
                        <p>
                            Mari yok.... Laporkan segala keluhanmu di aplikasi PADUM, supaya segera diproses oleh badan yang berwenang
                        </p>
                    </div>
                    <div id="daftar1">
                        <div style="text-align: center"><a href="signup.php">Daftar Sekarang </a></div>
                    </div>
                    <div style="text-align: center">
                        <b>atau</b> <br> Bagi yang sudah memiliki akun, bisa login dibawah ini :
                    </div>
                    <div id="login2">
                        <div style="text-align: center"><a href="login.php">Login Disini </a></div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    
    
    </div>
        


    <footer>
        <div class="footer1">
            <div class="infobawah">
                <div> <img src="asset/padum.svg"  height="85px"> </div>
                <div class="edit"> 
                    <img src="asset/logo_UPN.svg">
                    <b>Universitas Pembangunan Nasional Veteran Jawa Timur</b>
                </div>
            </div>

            <div class="infobawah">
                <h4>Kanal Aduan</h4>
                <div> <a href="https://siadu.upnjatim.ac.id">Siadu (Sistem Informasi Aduan) UPN "Veteran" Jawa Timur</a></div>
                <div><a href="https://siamik.upnjatim.ac.id/">Siamik (Sistem Informasi Akademik) UPN "Veteran" Jawa Timur</a></div>
                <div><a href="https://fasilkom.upnjatim.ac.id/polam/">Polam (Portal Layanan Mahasiswa) UPN "Veteran" Jawa Timur</a></div>
            </div>
            <div class="infobawah">
                <h4>Temukan Kami di :</h4>  
                <div class="edit">
                    <img src="asset/Logo_IG.svg">
                    <a href="https://www.instagram.com/upnveteranjawatimur">@upnveteranjatim</a>
                </div>
                <div class="edit">
                    <img src="asset/Logo_Twt.svg">
                    <a href="https://twitter.com/upnvjt_official">@upnveteranjatim</a>
                </div>
                <div class="edit">
                    <img src="asset/Logo_FB.svg">
                    <a href="">@upnveteranjatim</a>
                </div>
                <div class="edit">
                    <img src="asset/Logo_GMAIL.svg">
                    <a href="mailto: upnveteranjatim@gmail.co.id">@upnveteranjatim@gmail.co.id</a>
                </div>
            </div>
        </div>
        
        
        <div class="footer2">

        </div>
    </footer>
</body>
</html>
