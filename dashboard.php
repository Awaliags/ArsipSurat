<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

include 'config/koneksi.php';

// Ambil total surat masuk
$result_masuk = mysqli_query($koneksi, "SELECT COUNT(*) AS total_masuk FROM surat_masuk");
$data_masuk = mysqli_fetch_assoc($result_masuk);
$total_masuk = $data_masuk['total_masuk'];

// Ambil total surat keluar
$result_keluar = mysqli_query($koneksi, "SELECT COUNT(*) AS total_keluar FROM surat_keluar");
$data_keluar = mysqli_fetch_assoc($result_keluar);
$total_keluar = $data_keluar['total_keluar'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard - MAS YAPENSA</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9fafb;
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

        .main-content {
            margin-left: 220px;
            padding: 40px 30px;
            background-color: #fff;
            min-height: 100vh;
        }
        h1 {
            margin-top: 0;
            color: #1f2937;
        }
        .info-container {
            display: flex;
            gap: 40px;
            margin-top: 40px;
        }
        .info-box {
            flex: 1;
            max-width: 250px;
            background-color: #fefefe;
            border: 1px solid #ccc;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-radius: 8px;
            transition: box-shadow 0.3s ease;
        }
        .info-box:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .info-box h2 {
            font-size: 36px;
            margin: 0;
            color: #111827;
        }
        .info-box p {
            margin-top: 10px;
            font-size: 16px;
            color: #555;
            font-weight: 600;
        }
        .info-box i {
            margin-top: 15px;
            font-size: 40px;
            color: #2e9eaa;
        }

        /* Grafik canvas container */
        #chartContainer {
            margin-top: 50px;
            max-width: 700px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="brand">
        <img src="/Arsipsurat/logo.png" alt="Logo" />
        <span>MAS YAPENSA</span>
    </div>
   <a href="dashboard.php" class="active">Dashboard</a>
    <a href="surat_masuk.php">Surat Masuk</a>
    <a href="surat_keluar.php">Surat Keluar</a>
    <a href="buat_surat.php"></i>Buat Surat</a> 
    <a href="logout.php">Keluar</a>
</div>

<div class="main-content">
    <h1>Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>

    <div class="info-container">
        <div class="info-box">
            <h2><?php echo $total_masuk; ?></h2>
            <p>Surat Masuk</p>
            <i class="fas fa-inbox"></i>
        </div>
        <div class="info-box">
            <h2><?php echo $total_keluar; ?></h2>
            <p>Surat Keluar</p>
            <i class="fas fa-paper-plane"></i>
        </div>
    </div>

    <div id="chartContainer">
        <canvas id="suratChart"></canvas>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('suratChart').getContext('2d');
    const suratChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Surat Masuk', 'Surat Keluar'],
            datasets: [{
                label: 'Jumlah Surat',
                data: [<?php echo $total_masuk; ?>, <?php echo $total_keluar; ?>],
                backgroundColor: [
                    'rgb(77, 168, 218)',
                    'rgb(255, 214, 107)'
                ],
                borderColor: [
                     'rgb(77, 168, 218)',
                    'rgb(255, 214, 107)'
                ],
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        color: '#1f2937',
                        font: {
                            size: 14
                        }
                    }
                }
            },
            responsive: true,
            maintainAspectRatio: false,
            aspectRatio: 1.5
        }
    });
</script>
</body>
</html>
