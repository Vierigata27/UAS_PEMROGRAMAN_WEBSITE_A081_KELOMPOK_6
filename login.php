<?php
require 'koneksi.php'; // panggil file koneksi.php yang berisi fungsi login()

session_start();

if( isset($_POST["submit"])){
  login(); // panggil fungsi login() jika method HTTP adalah POST
  
}

if (isset($_SESSION["logged_in"])) {
    header("Location: index.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <style>
        body {
            background-color: #ffffff;
        }

        .kotakluar {
            margin: 50px auto;
            max-width: 400px;
            background-color: white;
            padding: 20px;
            border: 2px solid #5bc7a7;
            border-radius: 4px;
        }

        .header img {
            display: block;
            margin: 0 auto;
            width: 150px;
        }

        .kotak {
            margin: 50px auto;
            max-width: 400px;
            background-color: #f1faf7;
            padding: 20px;
            border: 2px solid #5bc7a7;
            border-radius: 4px;
        }

        .kotakluar h2 {
            text-align: center;
        }

        .kotak input[type="text"],
        .kotak input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #d9d9d9;
        }

        .kotak .layer1 {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .kotak .layer1 label {
            flex-basis: 48%;
            text-align: left;
        }

        .kotak .layer1 input[type="text"],
        .kotak .layer1 input[type="password"] {
            margin-right: 10px;
        }

        .kotak button[type="submit"] {
            display: block;
            margin: 0 auto;
            padding: 10px 100px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .kotak h5 {
            text-align: center;
        }

        .kotak a {
            color: red;
            text-decoration: none;
        }

        .kotak a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="kotakluar">
    <h2>LOG IN</h2>
    <div class="kotak">
        <form action="" method="POST">
            <div class="layer1">
                <label for="email">Email</label>
            </div>
            <div class="layer1">
                <input type="text" name="email">
            </div>

            <div class="layer1">
                <label for="password">Password</label>
            </div>
            <div class="layer1">
                <input type="password" name="password">
            </div>
            <button type="submit" name="submit">LOGIN</button>
            <h5>Belum Terdaftar? <a href="signup.php">Daftarkan Akun</a></h5>
        </form>
    </div>
    </div>
</body>
</html>
