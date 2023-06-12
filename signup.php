<?php
  require 'koneksi.php'; // panggil file koneksi.php yang berisi fungsi singup()

  if(isset($_POST['submit'])){

    if(signup($_POST) > 0){
      echo "<script>alert('Signup Berhasil');
      window.location = 'login.php';
      </script>";  
  }else{
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
    <title>Buat Akun</title>
    <link rel="stylesheet" type="text/css" href="asset/stylesheet_sign_up.css">
</head>
<body>
    <header>
        <div class="logo_wrapper">
            <img src="asset/Logo_Padum.svg">
        </div>
        <div class="text_wrapper">
            <h3>Buat Akun</h3>
        </div>
    </header>
    <div class="container">
        <main role="main">
            <form action="" method="post">
                <div class="head_wrapper">
                    <h4 class="name_header">SIGN UP</h4>
                </div>
                <div class="wrapper">
                    <div class="wrapper1">
                        <div class="full_name">
                            <Label class="nama_lengkap" for="">Nama Lengkap</Label>
                            <input class="input" type="text" placeholder="Tulis Nama Lengkapmu Disini" name="nama" required>
                        </div>
                        <div class="npm">
                            <label for="npm" class="nomor">NPM</label>
                            <input class="input" type="number" placeholder="Tulis NPM Disini" name="npm" required>
                        </div>
                    </div>
                    <div class="wrapper2">
                        <div class="progdi">
                            <label for="prodi" class="studi">Program Studi</label>
                            <input class="input" type="text" placeholder="Tulis Jurusanmu Disini" name="prodi" required>
                        </div>
                        <div class="fakultas">
                            <label for="fakultas" class="faculty">Fakultas</label>
                            <input class="input" type="text" placeholder="Tulis Fakultasmu Disini" name="fakultas" required>
                        </div>
                    </div>
                    <div class="wrapper3">
                        <div class="gender">
                            <label for="gender" class="jenis_kelamin">Jenis Kelamin</label>
                            <select class="opsiKelamin" name="gender">
                                <option value="">Pilih Salah Satu</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="tgl">
                            <label for="tanggal_lahir" class="tanggal">Tanggal Lahir</label>
                            <input class="input_tanggal" type="date" placeholder="Tulis Tanggalmu Disini" name="tanggal_lahir" required>
                        </div>
                    </div>
                    <div class="wrapper4">
                        <div class="mail">
                            <label for="" class="email">Email</label>
                            <input class="input" type="email" placeholder="example@student.upnjatim.ac.id" name="email" required>
                        </div>
                        <div class="nomor_hp">
                            <label for="" class="no_hp">Nomor Handphone</label>
                            <input class="input" type="number" placeholder="08**********" name="no" required>
                        </div>
                    </div>
                    <div class="wrapper5">
                        <div class="pass">
                            <label for="password" class="password">Password</label>
                            <input class="input" type="password" placeholder="Min. 8 Karakter" name="password" required>
                        </div>
                        <div class="pass_rep">
                            <label for="password2" class="pass_repeat">Confirm Password</label>
                            <input class="input" type="password" placeholder="Min. 8 Karakter" name="password2" required>
                        </div>
                    </div>
                    <div class="wrapper6">
                        <div class="checkbox">
                            <p class="syarat"><input type="checkbox" name="" required>Saya Telah Membaca dan Menyetujui Syarat dan Ketentuan yang Berlaku</p>
                        </div>
                        <div class="button">
                            <button type="submit" name="submit" class="button-wrapper">Daftar</button>
                        </div>
                        <div class="pre-login">
                            <p class="akun">Sudah Mempunyai Akun?</p>
                            <a class="login" href="login.php">Silahkan Login Disini</a>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    </div>
    <footer>
        <div class="footer-wrapper">
            <button class="main-menu">
            <a href="index.php" class="button_menu">Kembali ke Menu Utama</a>
            </button>
        </div>
    </footer>
</body>
</html>