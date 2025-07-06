<?php
session_start();
include 'config/koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

$id = intval($_POST['id']);
$nomor_surat = mysqli_real_escape_string($koneksi, $_POST['nomor_surat']);
$tanggal = $_POST['tanggal'];
$asal_surat = mysqli_real_escape_string($koneksi, $_POST['asal_surat']);
$perihal = mysqli_real_escape_string($koneksi, $_POST['perihal']);

// Ambil data file lama
$get_old = mysqli_query($koneksi, "SELECT file_surat FROM surat_masuk WHERE id = $id");
$old_data = mysqli_fetch_assoc($get_old);
$old_file = $old_data['file_surat'];

// Cek apakah ada file baru diunggah
if ($_FILES['file_surat']['name'] != '') {
    $file_tmp = $_FILES['file_surat']['tmp_name'];
    $file_name = time() . '_' . basename($_FILES['file_surat']['name']);
    $target_dir = "uploads/" . $file_name;

    // Pindahkan file baru
    move_uploaded_file($file_tmp, $target_dir);

    // Hapus file lama jika ada
    if (file_exists("uploads/" . $old_file)) {
        unlink("uploads/" . $old_file);
    }

    // Update dengan file baru
    $query = "UPDATE surat_masuk SET 
        nomor_surat = '$nomor_surat',
        tanggal = '$tanggal',
        asal_surat = '$asal_surat',
        perihal = '$perihal',
        file_surat = '$file_name'
        WHERE id = $id";
} else {
    // Update tanpa ubah file
    $query = "UPDATE surat_masuk SET 
        nomor_surat = '$nomor_surat',
        tanggal = '$tanggal',
        asal_surat = '$asal_surat',
        perihal = '$perihal'
        WHERE id = $id";
}

if (mysqli_query($koneksi, $query)) {
    header("Location: surat_masuk.php?status=success");
} else {
    echo "Gagal mengupdate data.";
}
?>
