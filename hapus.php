<?php
require "koneksi.php";

$laporan = $_GET["kode"];

if (hapus($laporan) > 0) {
    echo "<script>
        alert('data berhasil dihapus !');
        window.location.href = 'tampil.php';
        </script>";
} else {
    echo "<script>
        alert('data gagal dihapus !');
        window.location.href = 'tampil.php';
        </script>";
}
?>
