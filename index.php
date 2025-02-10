<?php
session_start();
require 'db.php'; // Menggunakan koneksi database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Komunitas Motor</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            display: flex;
            font-family: 'Arial', sans-serif;
            background-color: #e9ecef;
        }
        .sidebar {
            min-width: 250px;
            background-color: #007bff; /* Warna biru cerah */
            color: white;
            height: 100vh;
            position: fixed;
            transition: all 0.3s;
        }
        .sidebar h2 {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #0056b3; /* Warna biru gelap */
            font-weight: bold;
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }
        .sidebar ul li {
            padding: 15px;
            text-align: left;
        }
        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: all 0.3s;
        }
        .sidebar ul li a i {
            margin-right: 10px;
        }
        .sidebar ul li a:hover {
            background-color: #0056b3; /* Warna biru gelap saat hover */
            border-radius: 5px;
            padding-left: 20px; /* Efek padding saat hover */
        }
        .main-content {
            margin-left: 250px; /* Menyesuaikan margin untuk konten utama */
            padding: 20px;
            flex-grow: 1;
        }
        .main-content h1 {
            color: #343a40;
            margin-bottom: 20px;
        }
        .card {
            margin-top: 20px;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            background-color: #ffffff; /* Warna latar belakang kartu */
            border-radius: 10px;
        }
        .footer {
            text-align: center;
            padding: 10px;
            background-color: #007bff;
            color: white;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Menu</h2>
        <ul>
            <li><a href="index.php"><i class="fas fa-home"></i> Beranda</a></li>
            <li><a href="register.php"><i class="fas fa-user-plus"></i> Pendaftaran Anggota</a></li>
            <li><a href="search.php"><i class="fas fa-search"></i> Pencarian Anggota</a></li>
            <li><a href="group.php?status=aktif"><i class="fas fa-users"></i> Anggota Aktif</a></li>
            <li><a href="group.php?status=tidak aktif"><i class="fas fa-user-times"></i> Anggota Tidak Aktif</a></li>
            <li><a href="login.php"><i class="fas fa-user-lock"></i> Login Admin</a></li>
        </ul>
    </div>
    <div class="main-content">
        <h1>Selamat Datang di Komunitas Motor</h1>
        <div class="card">
            <div class="card-body">
                <p>Ini adalah sistem informasi pendaftaran anggota komunitas motor. Silakan pilih menu di samping untuk melanjutkan.</p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1 .slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>