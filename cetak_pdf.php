<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Rencana Studi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5>Kartu Rencana Studi</h5>
                <p>Lihat jadwal mata kuliah yang telah diinputkan disini!</p>
            </div>
            <div class="card-body">
                <p><strong>Mahasiswa:</strong> Bambang | <strong>NIM:</strong> A11.2022.13995 | <strong>IPK:</strong> 3</p>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mata Kuliah</th>
                            <th>SKS</th>
                            <th>Kelompok</th>
                            <th>Ruangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Dasar Pemrograman</td>
                            <td>3</td>
                            <td>A11.4201</td>
                            <td>H6.3</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Fisika</td>
                            <td>3</td>
                            <td>A11.4201</td>
                            <td>H6.3</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Kalkulus</td>
                            <td>3</td>
                            <td>A11.4201</td>
                            <td>H6.3</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="text-end">Total SKS</th>
                            <th colspan="3">9</th>
                        </tr>
                    </tbody>
                </table>
                <button class="btn btn-success" id="download-pdf">Cetak PDF</button>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('download-pdf').addEventListener('click', function () {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            
            // Ambil elemen HTML yang ingin dijadikan PDF
            const elementHTML = document.querySelector('.card');
            
            // Tambahkan ke PDF
            doc.html(elementHTML, {
                callback: function (doc) {
                    doc.save('Kartu_Rencana_Studi.pdf');
                },
                x: 10,
                y: 10
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
