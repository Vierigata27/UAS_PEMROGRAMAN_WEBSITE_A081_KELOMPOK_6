<?php
// membuat koneksi ke database dengan mysqli_connect()

$dbServer = 'localhost'; // host
//$dbPort = 3306; // port
$dbUser = 'root'; // username
$dbPass = ''; // password
$dbName = "padu"; // database

// membuat koneksi ke database dengan mysqli_connect()
//$koneksi = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName, $dbPort);
$koneksi = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName);

function tampil($tampil)
{
   global $koneksi;
   $result = mysqli_query($koneksi, $tampil);
   $rows=[];
   while ($row = mysqli_fetch_assoc($result)){
      $rows[] = $row;
   }
   return $rows;
}

//fungsi regristasi
function signup($data){

    global $koneksi;

    $nama = $data["nama"];
    $npm = $data["npm"];
    $fakultas = $data["fakultas"];
    $prodi = $data["prodi"];
    $gender = $data["gender"];
    $tanggal_lahir = $data["tanggal_lahir"];
    $email = $data["email"];
    $no = $data["no"];
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);

    // Cek apakah email sudah pernah terdaftar
    $cek = mysqli_query($koneksi, "SELECT email FROM user WHERE email ='$email'");

    if (mysqli_fetch_assoc($cek)) {
        echo "<script>alert('EMAIL SUDAH PERNAH TERDAFTAR');</script>";
        return false;
    }

    // Cek konfirmasi password
    if ($password != $password2) {
        echo "<script>alert('Password tidak sesuai');</script>";
        return false;
    }

    $enkripsi = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($koneksi, "INSERT INTO user (`user_id`, `nama`, `email`,`npm`, `no`, `gender`,`tanggal_lahir`, `fakultas`, `prodi`, `password`) 
    VALUES ('', '$nama', '$email','$npm', '$no', '$gender','$tanggal_lahir', '$fakultas', '$prodi', '$enkripsi')");

    return mysqli_affected_rows($koneksi);
}


//fungsi login
function login(){
  
    global $koneksi;
  
    $email = $_POST["email"];
    $password = $_POST["password"];
  
    $result = mysqli_query($koneksi, "SELECT * FROM user WHERE email='$email' ");

    //cek username
    if(mysqli_num_rows($result) == 1){
  
      $row = mysqli_fetch_assoc($result);
      if( password_verify($password, $row["password"]) ) {
        $user_id_result = mysqli_query($koneksi, "SELECT user_id FROM user WHERE email='$email'");
        $user_id_row = mysqli_fetch_assoc($user_id_result);
        $_SESSION["user_id"] = $user_id_row["user_id"];
        $_SESSION["email"] = $email;
        $_SESSION["logged_in"] = true;
        header("location: index.php");
        exit;
      } else {
        echo "<script>alert('Password salah/Email Salah');
          window.location = 'login.php';
          </script>";
      }
    } 
  }

  function admin(){
  
    global $koneksi;
  
    $email = $_POST["email"];
    $password = $_POST["password"];
  
    $result = mysqli_query($koneksi, "SELECT * FROM admin WHERE email='$email' ");
  
    //cek username
    if(mysqli_num_rows($result) == 1){
  
      $row = mysqli_fetch_assoc($result);
      if( $password == $row["password"] ) {
        $_SESSION["email"] = $email;
        $_SESSION["logged_in"] = true;
        header("location: tampil.php");
        exit;
      } else {
        echo "<script>alert('Password salah/Email Salah');
          window.location = 'admin.php';
          </script>";
      }
    } 
  }
//form pengaduan_fasilitas
function pengaduan_fasilitas($data){
  global $koneksi;
  $user_id = $data["user_id"];
  $judul = $data["judul"];
  $keterangan_laporan = $data["keterangan_laporan"];
  $status = $data["status"];
  $waktu = $data["waktu"];
  $tempat = $data["tempat"];
  $gambar = upload();
  
  if(!$gambar) {
    return false;
  }

  $result = mysqli_query($koneksi, "SELECT MAX(CAST(SUBSTRING(no_pengaduan, 2) AS UNSIGNED)) AS max_pengaduan FROM pengaduan_fasilitas");
  $row = mysqli_fetch_assoc($result);
  $last_pengaduan = $row["max_pengaduan"];

  // Mendapatkan nomor pengaduan berikutnya
  $next_pengaduan = $last_pengaduan + 1;

  // Membuat token dengan format "F1", "F2", dst.
  $token = "F" . $next_pengaduan;

  // Query untuk memasukkan data ke dalam tabel
  mysqli_query($koneksi, "INSERT INTO pengaduan_fasilitas (no_pengaduan, user_id, judul, keterangan_laporan, status, gambar,waktu,tempat) 
  VALUES ('$token', '$user_id', '$judul', '$keterangan_laporan', '$status', '$gambar', '$waktu', '$tempat')");

  return mysqli_affected_rows($koneksi);
}


//form pengaduan_kekerasan
function pengaduan_kekerasan($data){
  global $koneksi;
  $user_id = $data["user_id"];
  $judul = $data["judul"];
  $keterangan_laporan = $data["keterangan_laporan"];
  $status = $data["status"];
  $waktu = $data["waktu"];
  $tempat = $data["tempat"];

  $result = mysqli_query($koneksi, "SELECT MAX(CAST(SUBSTRING(no_pengaduan, 2) AS UNSIGNED)) AS max_pengaduan FROM pengaduan_kekerasan");
  $row = mysqli_fetch_assoc($result);
  $last_pengaduan = $row["max_pengaduan"];

  // Mendapatkan nomor pengaduan berikutnya
  $next_pengaduan = $last_pengaduan + 1;

  // Membuat token dengan format "F1", "F2", dst.
  $token = "K" . $next_pengaduan;

  // Query untuk memasukkan data ke dalam tabel
  mysqli_query($koneksi, "INSERT INTO pengaduan_kekerasan (no_pengaduan, user_id, judul, keterangan_laporan, status, waktu, tempat) 
  VALUES ('$token', '$user_id', '$judul', '$keterangan_laporan', '$status', '$waktu', '$tempat')");

  return mysqli_affected_rows($koneksi);
}

//form pengaduan_susila
function pengaduan_susila($data){
  global $koneksi;
  $user_id = $data["user_id"];
  $judul = $data["judul"];
  $keterangan_laporan = $data["keterangan_laporan"];
  $status = $data["status"];
  $waktu = $data["waktu"];
  $tempat = $data["tempat"];

  $result = mysqli_query($koneksi, "SELECT MAX(CAST(SUBSTRING(no_pengaduan, 2) AS UNSIGNED)) AS max_pengaduan FROM pengaduan_susila");
  $row = mysqli_fetch_assoc($result);
  $last_pengaduan = $row["max_pengaduan"];

  // Mendapatkan nomor pengaduan berikutnya
  $next_pengaduan = $last_pengaduan + 1;

  // Membuat token dengan format "F1", "F2", dst.
  $token = "S" . $next_pengaduan;

  // Query untuk memasukkan data ke dalam tabel
  mysqli_query($koneksi, "INSERT INTO pengaduan_susila (no_pengaduan, user_id, judul, keterangan_laporan, status, waktu, tempat) 
  VALUES ('$token', '$user_id', '$judul', '$keterangan_laporan', '$status', '$waktu', '$tempat')");

  return mysqli_affected_rows($koneksi);
}
//form pengaduan_lain
function pengaduan_lain($data){
  global $koneksi;
  $user_id = $data["user_id"];
  $judul = $data["judul"];
  $keterangan_laporan = $data["keterangan_laporan"];
  $status = $data["status"];
  $waktu = $data["waktu"];
  $tempat = $data["tempat"];
  $gambar = upload();
  
  if(!$gambar) {
    return false;
  }

  $result = mysqli_query($koneksi, "SELECT MAX(CAST(SUBSTRING(no_pengaduan, 2) AS UNSIGNED)) AS max_pengaduan FROM pengaduan_lain");
  $row = mysqli_fetch_assoc($result);
  $last_pengaduan = $row["max_pengaduan"];

  // Mendapatkan nomor pengaduan berikutnya
  $next_pengaduan = $last_pengaduan + 1;

  // Membuat token dengan format "F1", "F2", dst.
  $token = "L" . $next_pengaduan;

  // Query untuk memasukkan data ke dalam tabel
  mysqli_query($koneksi, "INSERT INTO pengaduan_lain (no_pengaduan, user_id, judul, keterangan_laporan, status, gambar, waktu, tempat) 
  VALUES ('$token', '$user_id', '$judul', '$keterangan_laporan', '$status', '$gambar', '$waktu', '$tempat')");

  return mysqli_affected_rows($koneksi);
}

//fungsi upload
function upload(){

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];
  
    if($error === 4){
      echo "<script> 
      alert('Pilih Gambar Terlebih Dahulu');
      </script>";
      return false;
    }
  
    //cek apakah yang di upload gambar
    $tipeGambar = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $tipeGambar)){
      echo "<script> 
        alert('Data Yang Anda Upload Bukan Gambar');
        </script>";
        return false;
    }
  
    // $namaFileBaru = uniqid();
    // $namaFileBaru .= '.';
    // $namaFileBaru .= $ekstensiGambar;
  
    move_uploaded_file($tmpName, 'gambar/' . $namaFile);
  
    return $namaFile;
  }

  function upload1(){

    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];
  
    if($error === 4){
      echo "<script> 
      alert('Pilih foto Terlebih Dahulu');
      </script>";
      return false;
    }
  
    //cek apakah yang di upload foto
    $tipefoto = ['jpg', 'jpeg', 'png'];
    $ekstensifoto = explode('.', $namaFile);
    $ekstensifoto = strtolower(end($ekstensifoto));
    if( !in_array($ekstensifoto, $tipefoto)){
      echo "<script> 
        alert('Data Yang Anda Upload Bukan foto');
        </script>";
        return false;
    }
  
    // $namaFileBaru = uniqid();
    // $namaFileBaru .= '.';
    // $namaFileBaru .= $ekstensifoto;
  
    move_uploaded_file($tmpName, 'gambar/' . $namaFile);
  
    return $namaFile;
  }

  function komentar($data){
    global $koneksi;
    $user_id = $data["user_id"];
    $no_berita = $data["no_berita"];
    $teks = $data["teks"];
  
    // Query untuk memasukkan data ke dalam tabel
    mysqli_query($koneksi, "INSERT INTO komentar (no_komentar, no_berita, user_id, teks) 
    VALUES ('', '$no_berita', '$user_id', '$teks')");
  
    return mysqli_affected_rows($koneksi);
  }


  function kirim($data){ 
    global $koneksi;
    $no_pengaduan = $data["no_pengaduan"];
    $user_id = $data["user_id"];
    $judul = $data["judul"];
    $keterangan_laporan = $data["keterangan_laporan"];
    $gambar = $data["gambar"];
    $admin_id = $data["admin_id"];
    $status = $data["status"];
    $tempat = $data["tempat"];
    $hasil_berita = $data["hasil_berita"];

    $query = "UPDATE pengaduan_fasilitas SET 
              status = '$status'
              WHERE no_pengaduan = '$no_pengaduan'";

    mysqli_query($koneksi, "INSERT INTO berita 
    (no_pengaduan, user_id, judul, keterangan_laporan, status,tempat , gambar, admin_id, hasil_berita) 
    VALUES ('$no_pengaduan', '$user_id', '$judul', '$keterangan_laporan', '$status','$tempat', '$gambar', '$admin_id', '$hasil_berita')");

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function kirim2($data){ 
  global $koneksi;
  $no_pengaduan = $data["no_pengaduan"];
  $user_id = $data["user_id"];
  $judul = $data["judul"];
  $keterangan_laporan = $data["keterangan_laporan"];
  $admin_id = $data["admin_id"];
  $status = $data["status"];
  $tempat = $data["tempat"];
  $hasil_berita = $data["hasil_berita"];

  $query = "UPDATE pengaduan_kekerasan SET 
            status = '$status'
            WHERE no_pengaduan = '$no_pengaduan'";

  mysqli_query($koneksi, "INSERT INTO berita 
  (no_pengaduan, user_id, judul, keterangan_laporan, status, tempat, admin_id, hasil_berita) 
  VALUES ('$no_pengaduan', '$user_id', '$judul', '$keterangan_laporan', '$status','$tempat', '$admin_id', '$hasil_berita')");

  mysqli_query($koneksi, $query);

  return mysqli_affected_rows($koneksi);
}

function kirim3($data){ 
  global $koneksi;
  $no_pengaduan = $data["no_pengaduan"];
  $user_id = $data["user_id"];
  $judul = $data["judul"];
  $keterangan_laporan = $data["keterangan_laporan"];
  $admin_id = $data["admin_id"];
  $status = $data["status"];
  $tempat = $data["tempat"];
  $hasil_berita = $data["hasil_berita"];

  $query = "UPDATE pengaduan_susila SET 
            status = '$status'
            WHERE no_pengaduan = '$no_pengaduan'";

  mysqli_query($koneksi, "INSERT INTO berita 
  (no_pengaduan, user_id, judul, keterangan_laporan, status, tempat, admin_id, hasil_berita) 
  VALUES ('$no_pengaduan', '$user_id', '$judul', '$keterangan_laporan', '$status','$tempat', '$admin_id', '$hasil_berita')");

  mysqli_query($koneksi, $query);

  return mysqli_affected_rows($koneksi);
}

function kirim4($data){ 
  global $koneksi;
  $no_pengaduan = $data["no_pengaduan"];
  $user_id = $data["user_id"];
  $judul = $data["judul"];
  $keterangan_laporan = $data["keterangan_laporan"];
  $gambar = $data["gambar"];
  $admin_id = $data["admin_id"];
  $status = $data["status"];
  $tempat = $data["tempat"];
  $hasil_berita = $data["hasil_berita"];

  $query = "UPDATE pengaduan_lain SET 
            status = '$status'
            WHERE no_pengaduan = '$no_pengaduan'";

  mysqli_query($koneksi, "INSERT INTO berita 
  (no_pengaduan, user_id, judul, keterangan_laporan, status, tempat, gambar, admin_id, hasil_berita) 
  VALUES ('$no_pengaduan', '$user_id', '$judul', '$keterangan_laporan', '$status','$tempat', '$gambar', '$admin_id', '$hasil_berita')");

  mysqli_query($koneksi, $query);

  return mysqli_affected_rows($koneksi);
}

function ubah($data){ 
  
  global $koneksi;
  $user_id = $data["user_id"];
  $nama = $data["nama"];
  $npm = $data["npm"];
  $prodi = $data["prodi"];
  $fakultas = $data["fakultas"];
  $gender = $data["gender"];
  $tanggal_lahir = $data["tanggal_lahir"];
  $fotoLama = $data["fotoLama"];

  if($_FILES['foto']['error'] === 4){
      $foto = $fotoLama; 
  }else{
    $foto = upload1();
  }

  $query = "UPDATE user SET 
            nama = '$nama',
            npm = '$npm',
            prodi = '$prodi',
            fakultas = '$fakultas',
            gender = '$gender',
            tanggal_lahir = '$tanggal_lahir',
            foto = '$foto'
            where user_id = '$user_id'";

  mysqli_query($koneksi, $query);
  
  return mysqli_affected_rows($koneksi);
}

//fungsi hapus
function hapus($laporan){
  global $koneksi;
  mysqli_query($koneksi, "DELETE FROM pengaduan_fasilitas where no_pengaduan = '$laporan'");
  return mysqli_affected_rows($koneksi);
  }

  function hapus2($laporan){
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM pengaduan_kekerasan where no_pengaduan = '$laporan'");
    return mysqli_affected_rows($koneksi);
    }

    function hapus3($laporan){
      global $koneksi;
      mysqli_query($koneksi, "DELETE FROM pengaduan_susila where no_pengaduan = '$laporan'");
      return mysqli_affected_rows($koneksi);
      }

      function hapus4($laporan){
        global $koneksi;
        mysqli_query($koneksi, "DELETE FROM pengaduan_lain where no_pengaduan = '$laporan'");
        return mysqli_affected_rows($koneksi);
        }

        function hapus5($laporan){
          global $koneksi;
          mysqli_query($koneksi, "DELETE FROM berita where no_berita = '$laporan'");
          return mysqli_affected_rows($koneksi);
          }
?>


