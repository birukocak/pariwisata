<?php
// Mulai sesi
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
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
  <style>
  </style>
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

  <div class="content" style="margin-left:400px; padding:200px;">
    <img src="https://cdn-icons-png.flaticon.com/512/2942/2942813.png" alt="Administrator" class="login-image">
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['firstname']); ?>!</h1>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
