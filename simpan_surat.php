
<?php
if (isset($_POST['isi_surat_hidden'])) {
    $isi = $_POST['isi_surat_hidden'];
    $folder = 'surat/';

    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
    }

    $filename = $folder . 'surat_keterangan_' . time() . '.html';
    file_put_contents($filename, $isi);

    echo "✅ Surat berhasil disimpan: <a href='$filename' target='_blank'>$filename</a>";
} else {
    echo "❌ Tidak ada data yang dikirim.";
}
?>
