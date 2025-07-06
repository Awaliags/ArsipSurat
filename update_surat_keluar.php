<?php
session_start();
include 'config/koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $nomor_surat = mysqli_real_escape_string($koneksi, $_POST['nomor_surat']);
    $tanggal = $_POST['tanggal'];
    $tujuan = mysqli_real_escape_string($koneksi, $_POST['tujuan']);
    $perihal = mysqli_real_escape_string($koneksi, $_POST['perihal']);

    // Ambil data surat keluar lama
    $result = mysqli_query($koneksi, "SELECT file_surat FROM surat_keluar WHERE id = $id");
    $data = mysqli_fetch_assoc($result);
    $file_lama = $data['file_surat'];

    // Cek apakah ada file baru yang diupload
    if (!empty($_FILES['file_surat']['name'])) {
        $file = $_FILES['file_surat']['name'];
        $tmp = $_FILES['file_surat']['tmp_name'];
        $file_baru = time() . '_' . $file;
        $path = "uploads/" . $file_baru;

        if (move_uploaded_file($tmp, $path)) {
            // Hapus file lama jika ada
            if (file_exists("uploads/" . $file_lama)) {
                unlink("uploads/" . $file_lama);
            }

            // Update dengan file baru
            $query = "UPDATE surat_keluar SET 
                nomor_surat = '$nomor_surat',
                tanggal = '$tanggal',
                tujuan = '$tujuan',
                perihal = '$perihal',
                file_surat = '$file_baru'
                WHERE id = $id";
        } else {
            // Kalau upload gagal, update tanpa file baru
            $query = "UPDATE surat_keluar SET 
                nomor_surat = '$nomor_surat',
                tanggal = '$tanggal',
                tujuan = '$tujuan',
                perihal = '$perihal'
                WHERE id = $id";
        }
    } else {
        // Update tanpa ganti file
        $query = "UPDATE surat_keluar SET 
            nomor_surat = '$nomor_surat',
            tanggal = '$tanggal',
            tujuan = '$tujuan',
            perihal = '$perihal'
            WHERE id = $id";
    }

    mysqli_query($koneksi, $query);
    header("Location: surat_keluar.php");
    exit;
} else {
    // Jika bukan POST, redirect ke daftar
    header("Location: surat_keluar.php");
    exit;
}
