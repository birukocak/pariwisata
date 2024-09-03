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

$packages_sql = "SELECT * FROM packages";
$packages_result = $conn->query($packages_sql);

$gallery_sql = "SELECT * FROM gallery";
$gallery_result = $conn->query($gallery_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amazon Forest</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- navbar -->
    <img class="utama" src="https://awsimages.detik.net.id/community/media/visual/2023/01/24/upaya-memerangi-penggundulan-hutan-amazon-brasil-4_169.jpeg?w=1200" alt="">
    <nav class="navbar sticky-top navbar-expand-lg navbar-light nav">
        <a class="navbar-brand" href="index.php">Wisata Hutan Amazon</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#Galeri">Galeri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#Paket">Paket</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tiket.php">Tiket</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Login.php">Login</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn bg-light" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <!-- home -->
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <img height="200" src="https://asset.kompas.com/crops/UN0JVVylf-4o9LyIicjKoQ2lt2Y=/0x159:900x759/1200x800/data/photo/2021/12/19/61bf16536e7fd.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Keindahan Flora</h5>
                        <a href="#" class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img height="200" src="https://asset-2.tstatic.net/medan/foto/bank/images/katak-panah-banteng_20170924_083835.jpg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Keindahan Fauna</h5>
                        <a href="#" class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <iframe width="538" height="310" src="https://www.youtube.com/embed/vydNn2MJW4w?si=mX0JwMQVEXTGEnn6" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    <div class="card-body">
                        <p class="card-text">Keindahan alam Flora dan Fauna hutan Amazon</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Galeri -->
    <div id="Galeri" class="container mt-5">
    <h1 class="text-center mb-4">Galeri Foto</h1>
    <div class="row">
        <?php
        if ($gallery_result->num_rows > 0) {
            while($row = $gallery_result->fetch_assoc()) {
                echo '<div class="col-md-2 mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="openModal(\'' . $row["image_url"] . '\')">';
                echo '<img src="' . $row["image_url"] . '" style="height: 200px; width: 100%; object-fit: cover;" class="rounded">';
                echo '</div>';
            }
        } else {
            echo "No images found";
        }
        ?>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="" id="modalImage" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <!-- paket -->
    <div id="Paket" class="container">
        <div class="container mt-5">
            <h1 class="text-center mb-4">Pilihan Paket Wisata</h1>
            <div class="row">
                <?php
                if ($packages_result->num_rows > 0) {
                    while($row = $packages_result->fetch_assoc()) {
                        echo '<div class="col-md-4">';
                        echo '<div class="card">';
                        echo '<img height="200" src="' . $row["image_url"] . '" class="card-img-top" alt="...">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . $row["title"] . '</h5>';
                        echo '<a href="tiket.php" class="card-text">' . $row["description"] . '</a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "No packages found";
                }
                $conn->close();
                ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
    <script>
        function openModal(imageUrl) {
            document.getElementById('modalImage').src = imageUrl;
        }
    </script>
</body>
</html>
