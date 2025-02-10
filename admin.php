<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "komunitas_motor";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all members
$result = $conn->query("SELECT * FROM anggota_view");
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Data Anggota</title>
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
        .btn-custom {
            background-color: #28a745; /* Warna hijau */
            color: white;
        }
        .btn-custom:hover {
            background-color: #218838; /* Warna hijau gelap saat hover */
        }
    </style>
</head>
<body>
<div class="sidebar">
        <h2>ADMIN</h2>
        <ul>
            <li><a href="index_admin.php"><i class="fas fa-home"></i> Beranda</a></li>
            <li><a href="admin.php"><i class="fas fa-user-plus"></i> Data Anggota</a></li>
            </ul><a href="logout.php" class="btn btn-danger" style="margin: 20px; width: 90%;">Logout</a> <!-- Logout button -->
    </div>
    <div class="main-content">
        <h2>Data Anggota Komunitas Motor</h2>
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
                    <th>Aksi</th>
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
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fas fa-trash"></i> Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <div class="text-center mt-4">
            <a href="print.php" class="btn btn-custom">Cetak Data</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>