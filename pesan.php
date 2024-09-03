<?php
// Database connection
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "db_pariwisata";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $package = $_POST["package"];
    $quantity = $_POST["quantity"];
    $visitDate = $_POST["visitDate"];
    $total = floatval($_POST["total"]); 

    $sql = "INSERT INTO bookings (name, email, phone, package, quantity, visit_date, total) VALUES ('$name', '$email', '$phone', '$package', '$quantity', '$visitDate', '$total')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
