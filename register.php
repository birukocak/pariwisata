<?php
// Mulai sesi
session_start();

// koneksi ke database
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "db_pariwisata";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Inisialisasi status register
$registrationError = '';
$registrationSuccess = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Hash the password

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $registrationError = "Email already exists";
    } else {
        $sql = "INSERT INTO users (firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$hashedPassword')";

        if ($conn->query($sql) === TRUE) {
            $registrationSuccess = "Registration successful!";
        } else {
            $registrationError = "Error: " . $conn->error;
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amazon Forest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .register-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .register-form {
            max-width: 500px;
            margin: auto;
        }
        .register-image {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container register-container">
        <div class="row">
            <div class="col-md-6 d-none d-md-block">
                <img src="https://cdn-icons-png.flaticon.com/512/2942/2942813.png" alt="Register" class="register-image">
            </div>
            <div class="col-md-6">
                <div class="register-form">
                    <h2 class="text-center mb-4">Register</h2>
                    <?php if ($registrationSuccess): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $registrationSuccess; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($registrationError): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $registrationError; ?>
                        </div>
                    <?php endif; ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="mb-3">
                            <label for="firstname" class="form-label">First name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" required>
                        </div>
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="newsletter" name="newsletter">
                            <label for="newsletter" class="form-check-label">Subscribe to our newsletter</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                        <p class="mt-3 text-center">Already have an account? <a href="login.php">Login here</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
