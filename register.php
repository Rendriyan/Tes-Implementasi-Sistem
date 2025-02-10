<?php
session_start();
require 'db.php'; // Menggunakan koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = trim($_POST['nama']);
    $alamat = trim($_POST['alamat']);
    $email = trim($_POST['email']);
    $nomor_handphone = trim($_POST['nomor_handphone']);
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tanggal_masuk = date('Y-m-d');

    // Validasi input
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Email tidak valid!";
    } elseif (!preg_match('/^[0-9]{10,15}$/', $nomor_handphone)) {
        $error = "Nomor handphone tidak valid!";
    } else {
        // Pastikan koneksi berhasil sebelum melakukan query
        if ($conn) {
            $sql = "INSERT INTO anggota (nama, alamat, email, nomor_handphone, jenis_kelamin, tanggal_masuk) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssss", $nama, $alamat, $email, $nomor_handphone, $jenis_kelamin, $tanggal_masuk);

            if ($stmt->execute()) {
                $success = "Pendaftaran berhasil!";
            } else {
                $error = "Pendaftaran gagal: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $error = "Koneksi database gagal.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Anggota - Komunitas Motor</title>
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
        .error {
            color: red;
            text-align: center;
        }
        .success {
            color: green;
            text-align: center;
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
        <h1>Registrasi Anggota</h1>
        <div class="card">
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <p class="error"><?php echo $error; ?></p>
                <?php elseif (isset($success)): ?>
                    <p class="success"><?php echo $success; ?></p>
                <?php endif; ?>
                <form method="POST">
                    <div class="form-group">
                        <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="alamat" class="form-control" placeholder="Alamat" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="nomor_handphone" class="form-control" placeholder="Nomor Handphone" required>
                    </div>
                    <div class="form-group">
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>