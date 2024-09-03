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

// Mengambil semua tiket yang sudah dipesan
$sql = "SELECT * FROM bookings"; 
$result = $conn->query($sql);

// Proses pengeditan tiket
if (isset($_POST['update_ticket'])) {
    $ticket_id = intval($_POST['ticket_id']);
    $new_name = $conn->real_escape_string($_POST['name']);
    $new_email = $conn->real_escape_string($_POST['email']);
    $new_phone = $conn->real_escape_string($_POST['phone']);
    $new_package = $conn->real_escape_string($_POST['package']);
    $new_quantity = intval($_POST['quantity']);
    $new_visit_date = $conn->real_escape_string($_POST['visit_date']);
    $new_total = floatval($_POST['total']);

    $update_sql = "UPDATE bookings SET name='$new_name', email='$new_email', phone='$new_phone', package='$new_package', quantity=$new_quantity, visit_date='$new_visit_date', total=$new_total WHERE id=$ticket_id";

    if ($conn->query($update_sql) === TRUE) {
        echo "Ticket updated successfully";
    } else {
        echo "Error updating ticket: " . $conn->error;
    }
}

// Proses penghapusan tiket
if (isset($_POST['delete_ticket'])) {
    $ticket_id = intval($_POST['ticket_id']);

    $delete_sql = "DELETE FROM bookings WHERE id=$ticket_id";

    if ($conn->query($delete_sql) === TRUE) {
        echo "Ticket deleted successfully";
    } else {
        echo "Error deleting ticket: " . $conn->error;
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
        <h2 class="text-center mb-4">Edit Tiket</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Package</th>
                    <th>Quantity</th>
                    <th>Visit Date</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row["id"] . '</td>';
                        echo '<td>' . $row["name"] . '</td>';
                        echo '<td>' . $row["email"] . '</td>';
                        echo '<td>' . $row["phone"] . '</td>';
                        echo '<td>' . $row["package"] . '</td>';
                        echo '<td>' . $row["quantity"] . '</td>';
                        echo '<td>' . $row["visit_date"] . '</td>';
                        echo '<td>' . $row["total"] . '</td>';
                        echo '<td>
                                <button class="btn btn-primary btn-sm edit-btn" data-id="' . $row["id"] . '" data-name="' . $row["name"] . '" data-email="' . $row["email"] . '" data-phone="' . $row["phone"] . '" data-package="' . $row["package"] . '" data-quantity="' . $row["quantity"] . '" data-visit_date="' . $row["visit_date"] . '" data-total="' . $row["total"] . '">Edit</button>
                                <form method="post" class="d-inline-block">
                                    <input type="hidden" name="ticket_id" value="' . $row["id"] . '">
                                    <button type="submit" name="delete_ticket" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                              </td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="9" class="text-center">No tickets found</td></tr>';
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal untuk mengedit tiket -->
    <div class="modal fade" id="editTicketModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Tiket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="">
                    <div class="modal-body">
                        <input type="hidden" id="ticket_id" name="ticket_id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="package" class="form-label">Package</label>
                            <input type="text" class="form-control" id="package" name="package" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                        </div>
                        <div class="mb-3">
                            <label for="visit_date" class="form-label">Visit Date</label>
                            <input type="date" class="form-control" id="visit_date" name="visit_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="total" class="form-label">Total</label>
                            <input type="number" class="form-control" id="total" name="total" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="update_ticket">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fungsi untuk mengisi modal edit tiket
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const email = button.getAttribute('data-email');
                const phone = button.getAttribute('data-phone');
                const package = button.getAttribute('data-package');
                const quantity = button.getAttribute('data-quantity');
                const visit_date = button.getAttribute('data-visit_date');
                const total = button.getAttribute('data-total');

                document.getElementById('ticket_id').value = id;
                document.getElementById('name').value = name;
                document.getElementById('email').value = email;
                document.getElementById('phone').value = phone;
                document.getElementById('package').value = package;
                document.getElementById('quantity').value = quantity;
                document.getElementById('visit_date').value = visit_date;
                document.getElementById('total').value = total;

                const editModal = new bootstrap.Modal(document.getElementById('editTicketModal'));
                editModal.show();
            });
        });

        // Fungsi untuk menghitung total
        document.getElementById('quantity').addEventListener('input', updateTotal);
        function updateTotal() {
            const quantity = parseInt(document.getElementById('quantity').value) || 0;
            const packagePrice = parseFloat(document.getElementById('package').value) || 0;
            const total = quantity * packagePrice;
            document.getElementById('total').value = total.toFixed(2);
        }
    </script>
</body>
</html>
