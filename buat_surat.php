<!DOCTYPE html>
<html>
<head>
    <title>Buat Surat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <script src="https://cdn.ckeditor.com/4.20.2/full/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        h2 {
            text-align: center;
        }
        textarea {
            width: 100%;
            height: 1080px;
        }
        .btn-download {
            background-color: #4c5c5f;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-family: 'Segoe UI', sans-serif;
        }
        .btn-download:hover {
            background-color: #4c5c5f;
        }

        .cke_contents iframe {
            touch-action: pinch-zoom;
            pointer-events: auto;
        }

        #contentToPrint {
            background-color: #fff;
            padding: 20px;
        }
    </style>
</head>
<body>

    <h2>Buat Surat</h2>

    <div id="contentToPrint">
        <form id="letterForm">
            <textarea name="isi_surat" id="isi_surat">
<table style="width:100%; border:none;">
    <tr>
        <td style="width:15%; text-align:center;">
            <img src="logo_kiri.png" width="90">
        </td>
        <td style="text-align:center;">
            <div style="font-family:Cambria; font-size:18pt; font-weight:bold;">
                YAYASAN PENDIDIKAN SALAFIYAH
            </div>
            <div style="font-family:Arial; font-size:9pt;">
                SK. KEMENKUMHAM NOMOR AHU-0019223.AH.01.12.TAHUN 2018
            </div>
            <div style="font-family:Cambria; font-size:14pt; font-weight:bold;">
                MADRASAH ALIYAH SALAFIYAH YAPENSA
            </div>
            <div style="font-family:Cambria; font-size:14pt; font-weight:bold;">
                JENGGOT KOTA PEKALONGAN
            </div>
            
        </td>
        <td style="width:15%; text-align:center;">
            <img src="logo_kanan.png" width="90">
        </td>
                
    </tr>
</table>
<div style="border-top: 1px solid black;text-align: center; font-family:Calibri; font-size: 9px;">
    <strong>Alamat:</strong> Jl. Pelita IV RT 01 RW 10 Jenggot Gg. IV, Pekalongan Selatan, Kota Pekalongan 51133 HP:085729180814 / 085858066667
</div>

<div style="border-top: 3px double black; margin-top: 5px; margin-bottom: 5px;">
    <!--ruang kosong-->
    <div style="border-top: 1px solid black;text-align: center; font-family:Calibri; font: size 8px;">
    
    </div>

</div>

</div>
  <table style="width:100%; font-family: 'Times New Roman'; font-size:12pt; margin-top: 100px;">
    <tr>
        <td style="text-align:right;">
            <span style="display:inline-block;">Pekalongan, 11 Desember 2024</span>
            <p style="display:inline-block; margin-right: 35px;">Kepala Madrasah</p>
        </td>
    </tr>
    <tr>
        <td style="text-align:right; padding-top: 60px;">
            <strong><u>Muhamad Agus Salim, M.Pd.</u></strong>
        </td>
    </tr>
</table>

<p><strong>Telah datang kepada kami</strong></p>

<table style="font-family: Times New Roman; font-size:12pt;">
    <tr>
        <td style="width: 180px;">Pada Tanggal</td>
        <td>: .........................................</td>
    </tr>
    <tr>
        <td>Kembali Tanggal</td>
        <td>: .........................................</td>
    </tr>
</table>

<p>Mengetahui,</p>
<br><br>
<p>.........................................</p>
           
</textarea>
    <!---->
       
            <br>
            <button type="button" class="btn-download" onclick="generatePdfWithJsPDF()">Download PDF</button>
        </form>
    </div>

    <script>
        CKEDITOR.replace('isi_surat', {
            height: 1080,
            tabSpaces: 4,
            removePlugins: 'elementspath',
            resize_enabled: false,
            font_names: 'Cambria;Calibri;Arial;Times New Roman;Verdana',
            contentsCss: [
                'https://fonts.googleapis.com/css?family=Cambria|Calibri|Arial|Times+New+Roman|Verdana',
                CKEDITOR.basePath + 'contents.css'
            ],
            toolbarGroups: [
                { name: 'document', groups: ['mode', 'document', 'doctools'] },
                { name: 'clipboard', groups: ['clipboard', 'undo'] },
                { name: 'editing', groups: ['find', 'selection', 'spellchecker'] },
                { name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
                { name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align'] },
                { name: 'links' },
                { name: 'insert' },
                { name: 'styles' },
                { name: 'colors' },
                { name: 'tools' },
                { name: 'others' },
                { name: 'about' }
            ],
            removeButtons: ''
        });

        const { jsPDF } = window.jspdf;

        function generatePdfWithJsPDF() {
            const editorData = CKEDITOR.instances.isi_surat.getData();
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = editorData;

            // Dimensi F4 dalam mm (21.5 cm x 33 cm)
            const F4_WIDTH_MM = 210;
            const F4_HEIGHT_MM = 330;

            // Margin yang diinginkan dalam mm
            const MARGIN_TOP_MM = 1;
            const MARGIN_LEFT_MM = 20;
            const MARGIN_BOTTOM_MM = 20;
            const MARGIN_RIGHT_MM = 20;

            // Hitung lebar area konten yang bisa dicetak
            const contentPrintableWidthMM = F4_WIDTH_MM - MARGIN_LEFT_MM - MARGIN_RIGHT_MM;

            // Gaya dasar untuk tempDiv agar renderingnya mirip dengan halaman asli
            // Lebar tempDiv harus mencerminkan lebar *konten* di halaman PDF
            tempDiv.style.width = `${contentPrintableWidthMM}mm`; // Lebar area konten yang akan dicetak
            tempDiv.style.backgroundColor = '#fff';
            tempDiv.style.fontFamily = 'Arial, sans-serif';
            tempDiv.style.boxSizing = 'border-box'; // Penting agar padding/border tidak menambah lebar

            document.body.appendChild(tempDiv);

            const html2canvasOptions = {
                scale: 3, // Meningkatkan skala untuk kualitas gambar yang lebih baik (misal: 3 atau 4)
                useCORS: true,
                logging: true,
            };

            html2canvas(tempDiv, html2canvasOptions).then(canvas => {
                const imgData = canvas.toDataURL('image/jpeg', 1.0);

                const pdf = new jsPDF('p', 'mm', [F4_WIDTH_MM, F4_HEIGHT_MM]);

                const imgPdfWidth = pdf.internal.pageSize.getWidth() - MARGIN_LEFT_MM - MARGIN_RIGHT_MM;
                const imgPdfHeight = (canvas.height * imgPdfWidth) / canvas.width;
                let heightLeft = imgPdfHeight;

                let position = MARGIN_TOP_MM;

                pdf.addImage(imgData, 'JPEG', MARGIN_LEFT_MM, position, imgPdfWidth, imgPdfHeight);
                heightLeft -= (pdf.internal.pageSize.getHeight() - MARGIN_TOP_MM - MARGIN_BOTTOM_MM);

                let pageNum = 1;

                while (heightLeft > 0) {
                    pageNum++;
                    position = -(imgPdfHeight - (pdf.internal.pageSize.getHeight() * (pageNum - 1)) + (MARGIN_TOP_MM * (pageNum - 1)) + (MARGIN_BOTTOM_MM * (pageNum - 1)));

                    pdf.addPage();
                    pdf.addImage(imgData, 'JPEG', MARGIN_LEFT_MM, position, imgPdfWidth, imgPdfHeight);
                    heightLeft -= (pdf.internal.pageSize.getHeight() - MARGIN_TOP_MM - MARGIN_BOTTOM_MM);
                }

                document.body.removeChild(tempDiv);
                pdf.save('surat.pdf');
            }).catch(error => {
                console.error("Error generating PDF:", error);
                alert("Terjadi kesalahan saat membuat PDF. Silakan cek console browser (tekan F12) untuk detail.");
                if (document.body.contains(tempDiv)) {
                    document.body.removeChild(tempDiv);
                }
            });
        }
    </script>

</body>
</html>