<?php
include 'config/koneksi.php';

$status = '';
$pesan = '';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $query = "SELECT * FROM users WHERE verify_token='$token' AND is_verified = 0";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) === 1) {
        $update = "UPDATE users SET is_verified = 1, verify_token = NULL WHERE verify_token = '$token'";
        if (mysqli_query($koneksi, $update)) {
            $status = 'success';
            $pesan = 'Email Anda berhasil diverifikasi. Silakan login.';
        } else {
            $status = 'danger';
            $pesan = 'Gagal memperbarui status verifikasi.';
        }
    } else {
        $status = 'warning';
        $pesan = 'Token tidak valid atau akun sudah diverifikasi.';
    }
} else {
    $status = 'danger';
    $pesan = 'Token tidak ditemukan.';
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Verifikasi Email</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
  <div class="card shadow p-4" style="max-width: 450px;">
    <h3 class="text-center mb-3">Verifikasi Email</h3>
    <div class="alert alert-<?= $status ?> text-center" role="alert">
      <?= $pesan ?>
    </div>
    <?php if ($status === 'success'): ?>
      <div class="text-center">
        <a href="login.php" class="btn btn-primary">Login Sekarang</a>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>
