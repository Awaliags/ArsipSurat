<?php
session_start();
include 'config/koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomor_surat = mysqli_real_escape_string($koneksi, $_POST['nomor_surat']);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $tujuan = mysqli_real_escape_string($koneksi, $_POST['tujuan']);
    $perihal = mysqli_real_escape_string($koneksi, $_POST['perihal']);

    $nama_file = $_FILES['file_surat']['name'];
    $tmp_file = $_FILES['file_surat']['tmp_name'];
    $path = "uploads/" . basename($nama_file);

    if (!is_dir("uploads")) {
        mkdir("uploads", 0777, true);
    }

    if (move_uploaded_file($tmp_file, $path)) {
        $query = "INSERT INTO surat_keluar (nomor_surat, tanggal, tujuan, perihal, file_surat)
                  VALUES ('$nomor_surat', '$tanggal', '$tujuan', '$perihal', '$nama_file')";
        if (mysqli_query($koneksi, $query)) {
            header("Location: surat_keluar.php");
            exit;
        } else {
            echo "Gagal menyimpan data: " . mysqli_error($koneksi);
        }
    } else {
        echo "Gagal mengupload file.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Surat Keluar - MAS YAPENSA</title>
    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 220px;
            height: 100vh;
            background-color: #2e9eaa;
            padding-top: 20px;
            color: white;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        .brand {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 30px;
        }

        .brand img {
            width: 30px;
            height: 30px;
        }

        .brand span {
            font-size: 18px;
            font-weight: bold;
        }

        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #217983;
        }

        .main {
            margin-left: 220px;
            padding: 20px 40px;
        }

        h2 {
            margin-bottom: 20px;
        }

        form {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 15px 20px;
            max-width: 600px;
        }

        label {
            align-self: center;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            resize: vertical;
        }

        .form-buttons {
            grid-column: 2;
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .btn-batal {
            background-color: white;
            color: black;
            padding: 8px 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-kirim {
            background-color: #2f4f4f;
            color: white;
            padding: 8px 20px;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-kirim:hover,
        .btn-batal:hover {
            opacity: 0.85;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand">
        <img src="/Arsipsurat/logo.png" alt="Logo" />
        <span>MAS YAPENSA</span>
    </div>    
    <a href="dashboard.php">Dashboard</a>
    <a href="surat_masuk.php">Surat Masuk</a>
    <a href="surat_keluar.php" class="active">Surat Keluar</a>
    <a href="buat_surat.php"></i>Buat Surat</a> 
    <a href="logout.php">Keluar</a>
</div>

<div class="main">
    <h2>Tambah Surat Keluar</h2>

    <form method="POST" action="" enctype="multipart/form-data">
        <label for="nomor">Nomor surat</label>
        <input type="text" name="nomor_surat" id="nomor" required>

        <label for="tanggal">Tanggal surat</label>
        <input type="date" name="tanggal" id="tanggal" required>

        <label for="tujuan">Tujuan surat</label>
        <input type="text" name="tujuan" id="tujuan" required>

        <label for="perihal">Perihal</label>
        <textarea name="perihal" id="perihal" rows="3" required></textarea>

        <label for="file">File surat</label>
        <input type="file" name="file_surat" id="file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required>

        <div class="form-buttons">
            <button type="button" class="btn-batal" onclick="window.location.href='surat_keluar.php'">Batal</button>
            <button type="submit" class="btn-kirim">Kirim</button>
        </div>
    </form>
</div>

</body>
</html>
