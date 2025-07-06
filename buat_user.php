<?php
require 'libs/PHPMailer/PHPMailer.php';
require 'libs/PHPMailer/SMTP.php';
require 'libs/PHPMailer/Exception.php';
include 'config/koneksi.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Data user
$username = 'admin';
$password = 'admin123';
$email    = 'awalia.agst8@gmail.com';

$hash = password_hash($password, PASSWORD_DEFAULT);
$verify_token = bin2hex(random_bytes(16));

// Cek user lama
mysqli_query($koneksi, "DELETE FROM users WHERE username='$username'");

// Insert user baru
$query = "INSERT INTO users (username, password, email, verify_token, is_verified)
          VALUES ('$username', '$hash', '$email', '$verify_token', 0)";

if (mysqli_query($koneksi, $query)) {
    $verify_link = "http://localhost/verify.php?token=$verify_token";

    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 0; // set ke 2 kalau mau debug
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'awalia.agst8@gmail.com';
        $mail->Password   = 'fhdrynhclwcfgccu'; // App password Gmail
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('awalia.agst8@gmail.com', 'ArsipSurat');
        $mail->addAddress($email, $username);

        $mail->isHTML(true);
        $mail->Subject = 'Verifikasi Email Anda';
        $mail->Body    = "Klik link berikut untuk verifikasi akun Anda:<br><a href='$verify_link'>$verify_link</a>";

        $mail->send();
        echo "✅ Email verifikasi dikirim ke <strong>$email</strong>.";
    } catch (Exception $e) {
        echo "❌ Gagal mengirim email: {$mail->ErrorInfo}";
    }
} else {
    echo "❌ Gagal menyimpan user ke database.";
}
?>
