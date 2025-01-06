<?php
include 'koneksi.php';

// ID mahasiswa diambil dari URL (misalnya: krs.php?id=1)
$id = $_GET['id'] ?? 1;

// Query untuk mengambil data mahasiswa
$query_mahasiswa = mysqli_query($koneksi, "SELECT * FROM inputmhs WHERE id = '$id'");
$data_mahasiswa = mysqli_fetch_assoc($query_mahasiswa);

// Query untuk mengambil data KRS
$query_krs = mysqli_query($koneksi, "SELECT * FROM jwl_mhs WHERE mahasiswa_id = '$id'");

// Hitung total SKS
$total_sks = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Rencana Studi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Kartu Rencana Studi</h2>
        <p class="text-center">Lihat jadwal mata kuliah yang telah diinputkan di sini!</p>

        <!-- Informasi Mahasiswa -->
        <div class="alert alert-info">
            <strong>Mahasiswa:</strong> <?= $data_mahasiswa['nama']; ?> |
            <strong>NIM:</strong> <?= $data_mahasiswa['nim']; ?> |
            <strong>IPK:</strong> <?= $data_mahasiswa['ipk']; ?>
            <a href="input.php" class="btn btn-warning btn-sm float-end">Kembali ke data mahasiswa</a>
        </div>

        <!-- Tabel Mata Kuliah -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Matakuliah</th>
                    <th>SKS</th>
                    <th>Kelompok</th>
                    <th>Ruangan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($query_krs)) {
                    $total_sks += $row['sks'];
                    echo "<tr>
                            <td>{$no}</td>
                            <td>{$row['matkul']}</td>
                            <td>{$row['sks']}</td>
                            <td>{$row['kelp']}</td>
                            <td>{$row['ruangan']}</td>
                          </tr>";
                    $no++;
                }
                ?>
                <tr>
                    <td colspan="2" class="text-center"><strong>Total SKS</strong></td>
                    <td><strong><?= $total_sks; ?></strong></td>
                    <td colspan="2"></td>
                </tr>
            </tbody>
        </table>

        <!-- Tombol Cetak -->
        <button class="btn btn-success" onclick="window.print()">Cetak PDF</button>
    </div>
</body>
</html>
