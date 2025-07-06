<?php
session_start();
include 'config/koneksi.php';

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = $_POST['password'];

$query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
$data = mysqli_fetch_assoc($query);

if ($data) {
    if (password_verify($password, $data['password'])) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        $_SESSION['error'] = [
            'title' => 'Kata sandi salah',
            'message' => 'Kata sandi yang anda masukkan salah. Silahkan coba lagi'
        ];
        header("Location: index.php");
        exit;
    }
} else {
    $_SESSION['error'] = [
        'title' => 'Username tidak ditemukan',
        'message' => 'Username yang anda masukkan tidak terdaftar. Silahkan coba lagi'
    ];
    header("Location: index.php");
    exit;
}
