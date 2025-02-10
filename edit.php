<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "komunitas_motor";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Memeriksa apakah ID disediakan
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Mengonversi ke integer untuk keamanan

    // Menyiapkan pernyataan SELECT
    $stmt = $conn->prepare("SELECT * FROM anggota WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $anggota = $result->fetch_assoc();
    $stmt->close();

    if (!$anggota) {
        die("Tidak ada catatan ditemukan untuk ID: $id");
    }
} else {
    header('Location: admin.php'); // Mengalihkan jika tidak ada ID yang disediakan
    exit;
}

// Menangani pengiriman formulir
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi dan sanitasi input
    $nama = trim($_POST['nama']);
    $alamat = trim($_POST['alamat']);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $nomor_handphone = trim($_POST['nomor_handphone']);
    $jenis_kelamin = $_POST['jenis_kelamin'];

    // Memeriksa apakah format email valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Format email tidak valid";
        exit;
    }

    // Menyiapkan pernyataan UPDATE
    $stmt = $conn->prepare("UPDATE anggota SET nama=?, alamat=?, email=?, nomor_handphone=?, jenis_kelamin=? WHERE id=?");
    $stmt->bind_param("sssssi", $nama, $alamat, $email, $nomor_handphone, $jenis_kelamin, $id);

    if ($stmt->execute()) {
        header('Location: admin.php?message=Catatan berhasil diperbarui'); // Mengalihkan ke halaman admin setelah pembaruan berhasil
        exit();
    } else {
        echo "Error: " . htmlspecialchars($stmt->error);
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Anggota</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .content {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 20px;
        }
        button {
            background-color: #007bff;
            color: white;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="content">
        <h2>Edit Anggota</h2>
        <form method="POST">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="nama" value="<?php echo htmlspecialchars($anggota['nama']); ?>" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" name="alamat" value="<?php echo htmlspecialchars($anggota['alamat']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($anggota['email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="nomor_handphone">Nomor Handphone</label>
                <input type="text" class="form-control" name="nomor_handphone" value="<?php echo htmlspecialchars($anggota['nomor_handphone']); ?>" required>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="L" <?php echo $anggota['jenis_kelamin'] == 'L' ? 'selected' : ''; ?>>Laki-laki</option>
                    <option value="P" <?php echo $anggota['jenis_kelamin'] == 'P' ? 'selected' : ''; ?>>Perempuan</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>