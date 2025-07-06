<?php
session_start();
include 'config/koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$query = mysqli_query($koneksi, "SELECT * FROM surat_masuk WHERE id = $id");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "Data tidak ditemukan.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Surat Keluar - MAS YAPENSA</title>
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
            max-width: 700px;
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
    <h2>Edit Surat Keluar</h2>
    <form action="update_surat_keluar.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

        <label>Nomor Surat</label>
        <input type="text" name="nomor_surat" value="<?php echo htmlspecialchars($data['nomor_surat']); ?>" required>

        <label>Tanggal</label>
        <input type="date" name="tanggal" value="<?php echo $data['tanggal']; ?>" required>

        <label>Asal Surat</label>
        <input type="text" name="asal_surat" value="<?php echo htmlspecialchars($data['asal_surat']); ?>" required>

        <label>Perihal</label>
        <input type="text" name="perihal" value="<?php echo htmlspecialchars($data['perihal']); ?>" required>

        <label>File Surat (biarkan kosong jika tidak diubah)</label>
        <div>
            <input type="file" name="file_surat">
            <small>File saat ini: 
                <a href="uploads/<?php echo htmlspecialchars($data['file_surat']); ?>" target="_blank">
                    <?php echo htmlspecialchars($data['file_surat']); ?>
                </a>
            </small>
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn-kirim">Update</button>
            <a href="surat_masuk.php" class="btn-batal">Kembali</a>
        </div>
    </form>
</div>

</body>
</html>
