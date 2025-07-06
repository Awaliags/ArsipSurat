<?php
require_once 'vendor/autoload.php';

// --- BARIS PENTING YANG HILANG ATAU SALAH ---
use Dompdf\Dompdf;
use Dompdf\Options;
// --- AKHIR BARIS PENTING ---

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['isi_surat'])) {
    $htmlContent = $_POST['isi_surat'];

    // Inisialisasi Dompdf dengan opsi
    $options = new Options(); // Ini adalah baris 21 yang error
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);
    $options->set('defaultFont', 'Times New Roman');

    $dompdf = new Dompdf($options);

    // Muat konten HTML
    $dompdf->loadHtml($htmlContent);

    // Set paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF
    $filename = 'Surat_Keterangan_' . date('Ymd_His') . '.pdf';

    $dompdf->stream($filename, array("Attachment" => true));

    exit();
} else {
    echo "Tidak ada data surat yang diterima untuk pembuatan PDF. Pastikan form dikirim dengan benar.";
    error_log("Kesalahan: Tidak ada data 'isi_surat' yang diterima di generate_pdf.php");
}
?>