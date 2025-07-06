<?php
session_start();
include 'config/koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

$no = 1;
$cari = isset($_GET['cari']) ? mysqli_real_escape_string($koneksi, $_GET['cari']) : '';
$query = mysqli_query($koneksi, "SELECT * FROM surat_masuk 
    WHERE nomor_surat LIKE '%$cari%' 
    OR asal_surat LIKE '%$cari%' 
    OR perihal LIKE '%$cari%' 
    ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Masuk - MAS YAPENSA</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
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

        .btn-edit, .btn-delete {
            padding: 6px 12px;
            margin: 2px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            color: white;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-edit {
            background-color: #32c0b5;
        }

        .btn-delete {
            background-color: #32c0b5;
        }

        .btn-edit:hover,
        .btn-delete:hover {
            opacity: 0.85;
        }

        a {
            text-decoration: none;
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
    <a href="buat_surat.php">Buat Surat</a> 
    <a href="logout.php">Keluar</a>
</div>

<div class="main">
    <div class="top-bar">
        <div class="left">Surat Masuk</div>
        <div class="right">
            <form method="get">
                <input type="text" name="cari" placeholder="Cari..." value="<?= htmlspecialchars($cari) ?>">
            </form>
            <button onclick="window.location.href='tambah_surat_masuk.php'">Tambah surat masuk</button>
        </div>
    </div>

    <table>
        <thead>
        <tr>
            <th>No</th>
            <th>Nomor Surat</th>
            <th>Tanggal</th>
            <th>Asal Surat</th>
            <th>Perihal</th>
            <th>File</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($data = mysqli_fetch_assoc($query)): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($data['nomor_surat']) ?></td>
                <td><?= htmlspecialchars($data['tanggal']) ?></td>
                <td><?= htmlspecialchars($data['asal_surat']) ?></td>
                <td><?= htmlspecialchars($data['perihal']) ?></td>
                <td><a href="uploads/<?= htmlspecialchars($data['file_surat']) ?>" target="_blank">Lihat File</a></td>
                <td>
                    <div style="display: flex;">
                        <a href="edit_surat_masuk.php?id=<?= $data['id'] ?>" class="btn-edit"><i class="fa-solid fa-pencil"></i></a>
                        <a href="hapus_surat_masuk.php?id=<?= $data['id'] ?>" class="btn-delete" onclick="return confirm('Yakin ingin menghapus?')"><i class="fa-solid fa-trash"></i></a>
                    </div>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
