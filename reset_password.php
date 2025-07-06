<?php
include 'config/koneksi.php';

$notif = ''; // untuk menyimpan notifikasi

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $new_password = mysqli_real_escape_string($koneksi, $_POST['new_password']);

    $hashed = password_hash($new_password, PASSWORD_BCRYPT);

    $query = "UPDATE users SET password='$hashed' WHERE username='$username'";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_affected_rows($koneksi) > 0) {
        $notif = '
        <div class="notif success">
            <strong>✅ Password berhasil direset</strong><br>
            Anda dapat login kembali dengan password baru.<br>
            <a href="index.php">Login sekarang</a>
        </div>';
    } else {
        $notif = '
        <div class="notif error">
            <strong>❌ Username tidak ditemukan</strong><br>
            Username yang anda masukkan tidak terdaftar.<br>
            <a href="reset_password.php">Coba lagi</a>
        </div>';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #d1d1d1;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            margin: 0;
        }

        .notif {
            width: 350px;
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 20px;
            font-family: Arial, sans-serif;
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.15);
            color: white;
        }

        .notif.success {
            background-color: #2f6f61;
        }

        .notif.error {
            background-color: #c0392b;
        }

        .notif a {
            display: inline-block;
            margin-top: 10px;
            color: #fff;
            font-weight: bold;
            text-decoration: underline;
        }

        .reset-box {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 350px;
        }

        .reset-box h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .reset-box input[type="text"],
        .reset-box input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .reset-box input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #4a6b65;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }

        .reset-box input[type="submit"]:hover {
            background-color: #3c5a53;
        }
    </style>
</head>
<body>

    <?= $notif ?>

    <form class="reset-box" method="POST" action="">
        <h2>Reset Password</h2>
        <input type="text" name="username" placeholder="Masukkan Username" required>
        <input type="password" name="new_password" placeholder="Password Baru" required>
        <input type="submit" value="Reset Password">
    </form>

</body>
</html>
