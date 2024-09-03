<?php
session_start();

// Periksa apakah admin sudah login
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

// Koneksi ke database
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "db_pariwisata";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mengambil semua gambar dari galeri
$sql = "SELECT * FROM gallery"; 
$result = $conn->query($sql);

// Proses penambahan gambar
if (isset($_POST['add_image'])) {
    $new_image_url = $_POST['image_url'];

    $insert_sql = "INSERT INTO gallery (image_url) VALUES (?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("s", $new_image_url);

    if ($stmt->execute()) {
        echo "Image added successfully";
    } else {
        echo "Error adding image: " . $conn->error;
    }
}

// Proses penghapusan gambar
if (isset($_POST['delete_image'])) {
    $image_id = $_POST['image_id'];

    $delete_sql = "DELETE FROM gallery WHERE id=?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $image_id);

    if ($stmt->execute()) {
        echo "Image deleted successfully";
    } else {
        echo "Error deleting image: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amazon Forest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/db.css">
</head>
<body>
    <div class="sidebar">
        <h3>Welcome, <?php echo htmlspecialchars($_SESSION['firstname']); ?>!</h3>
        <a href="dashboard.php">Home</a>
        <a href="admintiket.php">Tiket</a>
        <a href="galeri.php">Galeri</a>
        <a href="paket.php">Paket</a>
        <a href="?logout">Logout</a>
    </div>

    <div class="content">
        <h2 class="text-center mb-4">Edit Galeri</h2>
        <form method="post" class="mb-4">
            <div class="form-group">
                <label for="image_url">Add New Image URL</label>
                <input type="text" class="form-control" id="image_url" name="image_url" required>
            </div>
            <button type="submit" class="btn btn-primary" name="add_image">Add Image</button>
        </form>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row["id"] . '</td>';
                        echo '<td><img src="' . $row["image_url"] . '" alt="Gallery Image" class="img-thumbnail"></td>';
                        echo '<td>
                                <form method="post" class="d-inline-block">
                                    <input type="hidden" name="image_id" value="' . $row["id"] . '">
                                    <button type="submit" name="delete_image" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                              </td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="3" class="text-center">No images found</td>';
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
