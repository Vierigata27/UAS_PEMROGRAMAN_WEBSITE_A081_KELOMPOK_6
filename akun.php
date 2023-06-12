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

$profil = mysqli_query($koneksi, "SELECT * FROM `user` WHERE `user_id` LIKE '$user_id'")->fetch_assoc();

if (isset($_POST["submit"])) {
    if (ubah($_POST) > 0) {
        echo "<script>
            alert('Profile berhasil diupdate!');
            document.location.href = 'akun.php';
        </script>";
    } else {
        
    }
}


?>


<!DOCTYPE html>
<html>
<head>
	<title>my account</title>
	<link rel="stylesheet" type="text/css" href="asset/akun.css">
</head>
<style>


	
</style>
<body>
	<div class="judul" style="background-color: #344d67;">
		<div><h2>MY ACCOUNT</h2></div>
	</div>
		<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="user_id" value="<?= $profil["user_id"]; ?>">
	<div class="isi">
		<div id="header">
			<div id="user_image">
				<img src="gambar/<?= $profil["foto"]; ?>">
			</div>	
			<div ><input type="file" name="foto" accept="image/*" style="float: left;"></div>
		</div>

		<div class="isian">
			<div id="user">
				<label>Nama Lengkap</label>
				
				<input type="text" name="nama" value="<?= $profil["nama"]; ?>">
				<br>
				<label>NPM</label>
				<input type="text" name="npm" value="<?= $profil["npm"]; ?>">
			</div>

			<div class="wrapper">
				<div class="wrapper2">
					<div class="progdi">
						<label for="" class="studi">Program Studi</label>
						<input class="input" type="text" placeholder="Tulis Jurusanmu Disini" name="prodi" required value="<?= $profil["prodi"]; ?>">
					</div>
					<div class="fakultas">
						<label for="" class="faculty">Fakultas</label>
						<input class="input" type="text" placeholder="Tulis Fakultasmu Disini" name="fakultas" required value="<?= $profil["fakultas"]; ?>">
					</div>
				</div>
				<div class="wrapper3">
					<div class="gender">
						<label for="" class="jenis_kelamin">Jenis Kelamin</label>
						<select class="opsiKelamin" name="gender" >
							<option value="<?= $profil["gender"]; ?>"><?= $profil["gender"]; ?></option>
							<option value="Laki-Laki">Laki-Laki</option>
							<option value="Perempuan">Perempuan</option>
						</select>
					</div>
					<div class="tgl">
						<label for="" class="tanggal">Tanggal Lahir</label>
						<input class="input_tanggal" type="date" placeholder="Tulis Tanggalmu Disini" name="tanggal_lahir" required value="<?= $profil["tanggal_lahir"]; ?>">
					</div>
				</div>
			</div>
			<div id="user_controls">
			<button type="submit" name="submit">Edit info Profil</button>
			<a href="index.php">Homepage</a>
			</div>
		</div>
		</form>
	</div>
</body>
</html>