<?php
session_start();
include 'config/koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil nama file surat yang mau dihapus
$get = mysqli_query($koneksi, "SELECT file_surat FROM surat_keluar WHERE id = $id");
$data = mysqli_fetch_assoc($get);

if ($data) {
    $file = $data['file_surat'];
    
    // Hapus file dari folder uploads jika ada
    if (file_exists("uploads/" . $file)) {
        unlink("uploads/" . $file);
    }

    // Hapus data surat keluar dari database
    mysqli_query($koneksi, "DELETE FROM surat_keluar WHERE id = $id");
}

header("Location: surat_keluar.php");
exit;
?>
