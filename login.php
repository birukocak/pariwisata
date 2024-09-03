<?php
// Mulai sesi
session_start();

// Database connection setup
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "db_pariwisata";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Inisialisasi status login
$loginError = '';
$loginSuccess = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['lastname'] = $user['lastname'];
            $_SESSION['email'] = $user['email'];

            $loginSuccess = "Login successful! Redirecting to dashboard...";
            header("refresh:2;url=dashboard.php"); 
            exit();
        } else {
            $loginError = "Invalid password.";
        }
    } else {
        $loginError = "No user found with this email.";
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
        .login-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .login-image {
            max-width: 100%;
            height: auto;
            display: block;
        }
        .login-form {
            max-width: 400px;
            margin: auto;
        }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="row">
            <div class="col-md-6 d-none d-md-block">
                <img src="https://cdn-icons-png.flaticon.com/512/2942/2942813.png" alt="Administrator" class="login-image">
            </div>
            <div class="col-md-6">
                <div class="login-form">
                    <h2 class="text-center mb-4">Login Khusus Admin</h2>
                    <?php if ($loginSuccess): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $loginSuccess; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($loginError): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $loginError; ?>
                        </div>
                    <?php endif; ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                        <p class="mt-3 text-center">Bukan Admin? <a href="index.php">Kembali Ke Home</a></p>
                        <p class="mt-3 text-center">Belum Punya Akun Admin? <a href="register.php">Register here</a></p>
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
