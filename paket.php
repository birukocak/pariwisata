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

// Mengambil semua paket dari tabel
$sql = "SELECT * FROM packages"; 
$result = $conn->query($sql);

// Proses penambahan paket
if (isset($_POST['add_package'])) {
    $new_title = $_POST['title'];
    $new_description = $_POST['description'];
    $new_image_url = $_POST['image_url'];

    $insert_sql = "INSERT INTO packages (title, description, image_url) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("sss", $new_title, $new_description, $new_image_url);

    if ($stmt->execute()) {
        echo "Package added successfully";
    } else {
        echo "Error adding package: " . $conn->error;
    }
}

// Proses pengeditan paket
if (isset($_POST['update_package'])) {
    $package_id = $_POST['package_id'];
    $new_title = $_POST['title'];
    $new_description = $_POST['description'];
    $new_image_url = $_POST['image_url'];

    $update_sql = "UPDATE packages SET title=?, description=?, image_url=? WHERE id=?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("sssi", $new_title, $new_description, $new_image_url, $package_id);

    if ($stmt->execute()) {
        echo "Package updated successfully";
    } else {
        echo "Error updating package: " . $conn->error;
    }
}

// Proses penghapusan paket
if (isset($_POST['delete_package'])) {
    $package_id = $_POST['package_id'];

    $delete_sql = "DELETE FROM packages WHERE id=?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $package_id);

    if ($stmt->execute()) {
        echo "Package deleted successfully";
    } else {
        echo "Error deleting package: " . $conn->error;
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
        <h2 class="text-center mb-4">Edit Paket</h2>

        <!-- Form untuk menambah paket -->
        <form method="post" class="mb-4">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image_url" class="form-label">Image URL</label>
                <input type="text" class="form-control" id="image_url" name="image_url" required>
            </div>
            <button type="submit" class="btn btn-primary" name="add_package">Add Package</button>
        </form>

        <!-- Tabel paket -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
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
                        echo '<td>' . $row["title"] . '</td>';
                        echo '<td>' . $row["description"] . '</td>';
                        echo '<td><img src="' . $row["image_url"] . '" alt="Package Image" class="img-thumbnail"></td>';
                        echo '<td>
                                <button class="btn btn-primary btn-sm edit-btn" data-id="' . $row["id"] . '" data-title="' . $row["title"] . '" data-description="' . $row["description"] . '" data-image_url="' . $row["image_url"] . '">Edit</button>
                                <form method="post" class="d-inline-block">
                                    <input type="hidden" name="package_id" value="' . $row["id"] . '">
                                    <button type="submit" name="delete_package" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                              </td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="5" class="text-center">No packages found</td></tr>';
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal untuk mengedit paket -->
    <div class="modal fade" id="editPackageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Paket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="">
                    <div class="modal-body">
                        <input type="hidden" id="package_id" name="package_id">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image_url" class="form-label">Image URL</label>
                            <input type="text" class="form-control" id="image_url" name="image_url" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="update_package">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fungsi untuk mengisi modal edit paket
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', (event) => {
                const button = event.target;
                const id = button.getAttribute('data-id');
                const title = button.getAttribute('data-title');
                const description = button.getAttribute('data-description');
                const imageUrl = button.getAttribute('data-image_url');

                document.getElementById('package_id').value = id;
                document.getElementById('title').value = title;
                document.getElementById('description').value = description;
                document.getElementById('image_url').value = imageUrl;

                const editModal = new bootstrap.Modal(document.getElementById('editPackageModal'));
                editModal.show();
            });
        });
    </script>
</body
