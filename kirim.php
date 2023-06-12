<?php
require 'koneksi.php';

$no_pengaduan = $_GET["kode"];

$data = mysqli_query($koneksi, "SELECT * FROM `pengaduan_fasilitas` WHERE `no_pengaduan` LIKE '$no_pengaduan'")->fetch_assoc();

if (isset($_POST["submit"])) {
    if (kirim($_POST) > 0) {
        echo "<script>
            alert('Data berhasil dikirim!');
            document.location.href = 'tampil.php';
        </script>";
    } else {
        echo "<script>
            alert('Terjadi kesalahan!');
            document.location.href = 'tampil.php';
        </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Pengaduan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 25px;
            background-color: #333;
        }

        .header img {
            max-width: 150px;
            height: auto;
        }

        .kotak {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        textarea {
            resize: vertical;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="asset/logo.svg">
    </div>
    <div class="kotak">
        <h2>Kirim Pengaduan</h2>

        <h3>Judul: <?= $data["judul"]; ?></h3>
        <h4>User Id: <?= $data["user_id"]; ?></h4>
        <p>Keterangan: <?= $data["keterangan_laporan"]; ?></p>
        <img src="gambar/<?= $data["gambar"]; ?>" style="width: 100px;">

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="no_pengaduan" value="<?= $data["no_pengaduan"]; ?>">    
            <input type="hidden" name="user_id" value="<?= $data["user_id"]; ?>">
            <input type="hidden" name="judul" value="<?= $data["judul"]; ?>">
            <input type="hidden" name="keterangan_laporan" value="<?= $data["keterangan_laporan"]; ?>">
            <input type="hidden" name="tempat" value="<?= $data["tempat"]; ?>">
            <input type="hidden" name="gambar" value="<?= $data["gambar"]; ?>">
            <input type="hidden" name="admin_id" value="1">
            
            <div class="layer1">
                <label for="Status">Status</label>
            </div>

            <div class="layer1">
                <select name="status">
                    <option value="">STATUS LANJUTAN</option>
                    <option value="Publikasi">Publikasi</option>
                    <option value="Tindak Lanjut">Tindak Lanjut</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>

            <div class="layer1">
                <label for="hasil_berita">Hasil Tindakan</label>
            </div>

            <div class="layer1">
                <textarea name="hasil_berita" rows="5" cols="40"></textarea>
            </div>

            <button type="submit" name="submit">KIRIM</button>
        </form>
    </div>
</body>
</html>