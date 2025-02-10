<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "komunitas_motor";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if an ID is provided for deletion
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Convert to integer for safety

    // Prepare the delete statement
    $stmt = $conn->prepare("DELETE FROM anggota WHERE id = ?");
    
    if ($stmt) {
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            // Redirect to admin page after successful deletion
            header('Location: admin.php?message=Record deleted successfully');
            exit();
        } else {
            echo "Error deleting record: " . htmlspecialchars($stmt->error);
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . htmlspecialchars($conn->error);
    }
} else {
    header('Location: admin.php?error=No ID provided'); // Redirect if no ID is provided
    exit;
}

$conn->close();
?>