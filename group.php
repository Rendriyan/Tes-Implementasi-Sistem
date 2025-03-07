<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "komunitas_motor";

$conn = new mysqli($servername, $username, $password, $dbname);
$status = '';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if status is set and sanitize input
if (isset($_GET['status'])) {
    $status = $conn->real_escape_string($_GET['status']); // Sanitize input to prevent SQL injection
}

// Fetch members based on status
$result = $conn->query("SELECT * FROM anggota_view WHERE status = '$status'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota Berdasarkan Status</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            display: flex;
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
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
        .table th, .table td {
            vertical-align: middle;
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
    </div>

    <div class="main-content">
        <div class="container">
            <h2>Data Anggota - Status: <?php echo htmlspecialchars($status); ?></h2>
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>Nomor Handphone</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Masuk</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['nomor_handphone']); ?></td>
                        <td><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
                        <td><?php echo htmlspecialchars($row['tanggal_masuk']); ?></td>
                        <td><?php echo htmlspecialchars($row['status']); ?></ </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html> 

