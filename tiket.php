<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amazon Forest</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Pesan Tiket Sekarang</h1>
        <form id="bookingForm" action="pesan.php" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama lengkap" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Nomor Telepon</label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Masukkan nomor telepon" required>
            </div>
            <div class="mb-3">
                <label for="package" class="form-label">Pilih Paket Pariwisata</label>
                <select class="form-control" id="package" name="package" onchange="calculateTotal()" required>
                    <option>-- Pilih Paket --</option>
                    <option value="500000">Paket A - Rp 500.000</option>
                    <option value="750000">Paket B - Rp 750.000</option>
                    <option value="1000000">Paket C - Rp 1.000.000</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Jumlah Tiket</label>
                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Masukkan jumlah tiket" oninput="calculateTotal()" required>
            </div>
            <div class="mb-3">
                <label for="visitDate" class="form-label">Tanggal Kunjungan</label>
                <input type="date" class="form-control" id="visitDate" name="visitDate" required>
            </div>
            <div class="mb-3">
                <label for="total" class="form-label">Jumlah Tagihan</label>
                <input type="text" class="form-control" id="total" name="total" readonly>
            </div>
            <button type="button" class="btn btn-primary" onclick="confirmBooking()">Pesan Sekarang</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
