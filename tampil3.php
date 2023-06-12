<?php
require 'koneksi.php';
$data = tampil("SELECT * FROM pengaduan_susila");

//session_start();
// Periksa jika pengguna belum login, arahkan ke halaman login jika belum login
// if (!isset($_SESSION["logged_in"])) {
//     header("Location: admin.php");
//     exit();
// }
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LAPORAN SUSILA</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 25px;
            background-color: #333;
            color: #fff;
        }

        .header h1 {
            font-family: Courier;
            font-size: 28px;
        }

        .list {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .list li {
            list-style-type: none;
            margin-right: 15px;
        }

        .list li a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
        }

        .list li a:hover {
            opacity: 0.8;
        }

        .judul {
            text-align: center;
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        img {
            max-width: 150px;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <ul class="list">
            <li><a href="tampil.php">LAPORAN FASILITAS</a></li>
                <li><a href="tampil2.php">LAPORAN KEKERASAN</a></li>
                <li><a href="tampil3.php">LAPORAN SUSILA</a></li>
                <li><a href="tampil4.php">LAPORAN LAIN LAIN</a></li>
                <li><a href="tampil5.php">BERITA</a></li>
                <li>
                    <form action="logout.php" method="post">
                        <button type="submit" name="logout">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
        <div class="judul">
            <h1>LAPORAN SUSILA</h1>
        </div>

        <table>
            <tr>
                <th>NO PENGADUAN</th>
                <th>USER ID</th>
                <th>JUDUL</th>
                <th>KETERANGAN LAPORAN</th>
                <th>STATUS</th>
                <th>WAKTU</th>
                <th>TEMPAT</th>
                <th>SETING</th>
            </tr>

            <?php foreach ($data as $row) : ?>
            <tr>
                <td><?= $row["no_pengaduan"] ?></td>
                <td><?= $row["user_id"] ?></td>
                <td><?= $row["judul"] ?></td>
                <td><?= $row["keterangan_laporan"] ?></td>
                <td><?= $row["status"] ?></td>
                <td><?= $row["waktu"] ?></td>
                <td><?= $row["tempat"] ?></td>
                <td>
                <a href="kirim3.php?kode=<?= $row["no_pengaduan"]; ?>">Kirim</a>
                <a href="hapus3.php?kode=<?= $row["no_pengaduan"]; ?>">hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>
