<?php
session_start();
include 'config/koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nomor = mysqli_real_escape_string($koneksi, $_POST['nomor_surat']);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $asal = mysqli_real_escape_string($koneksi, $_POST['asal_surat']);
    $perihal = mysqli_real_escape_string($koneksi, $_POST['perihal']);

   
    $nama_file = $_FILES['file_surat']['name'];
    $tmp_file = $_FILES['file_surat']['tmp_name'];
    $path = "uploads/" . basename($nama_file);

    // Buat folder uploads jika belum ada
    if (!is_dir("uploads")) {
        mkdir("uploads", 0777, true);
    }

    if (move_uploaded_file($tmp_file, $path)) {
        $sql = "INSERT INTO surat_masuk (nomor_surat, tanggal, asal_surat, perihal, file_surat)
                VALUES ('$nomor', '$tanggal', '$asal', '$perihal', '$nama_file')";
        if (mysqli_query($koneksi, $sql)) {
            header("Location: surat_masuk.php");
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
    <title>Tambah Surat Masuk-MAS YAPENSA</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
              font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
            margin-left: 200px;
            padding: 20px 40px;
        }
        

        h2 {
            margin-bottom: 20px;
        }
         h2 {
            margin-bottom: 20px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .top-bar .left {
            font-size: 20px;
            font-weight: bold;
        }

        .top-bar .right {
            display: flex;
            gap: 10px;
        }

        .top-bar input[type="text"] {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 200px;
        }

        .top-bar button {
            background-color: #4c5c5f;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .top-bar button:hover {
            background-color: #3a494c;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border: 1px solid #ccc;
        }

        th {
            background-color: #009cb0;
            color: white;
            padding: 10px;
            text-align: center;
        }

        td {
            padding: 10px;
            border: 1px solid #eee;
            text-align: center;
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
    <a href="surat_masuk.php" class="active">Surat Masuk</a>
    <a href="surat_keluar.php">Surat Keluar</a>
    <a href="buat_surat.php"></i>Buat Surat</a> 
    <a href="logout.php">Keluar</a>
</div>


<div class="main">
    <h2>Tambah Surat masuk</h2>

    <form method="POST" action="" enctype="multipart/form-data">
        <label for="nomor">Nomor surat</label>
        <input type="text" name="nomor_surat" id="nomor" required>

        <label for="tanggal">Tanggal surat</label>
        <input type="date" name="tanggal" id="tanggal" required>

        <label for="asal">Asal surat</label>
        <input type="text" name="asal_surat" id="asal" required>

        <label for="perihal">Perihal</label>
        <textarea name="perihal" id="perihal" rows="3" required></textarea>

        <label for="file">File surat</label>
        <input type="file" name="file_surat" id="file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required>

        <div class="form-buttons">
            <button type="button" class="btn-batal" onclick="window.location.href='surat_masuk.php'">Batal</button>
            <button type="submit" class="btn-kirim">Kirim</button>
        </div>
    </form>
</div>

</body>
</html>
