<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data mahasiswa berdasarkan ID
    $query_inputmhs = mysqli_query($koneksi, "SELECT * FROM inputmhs WHERE id = '$id'");
    $data_inputmhs = mysqli_fetch_assoc($query_inputmhs);

    // Ambil data KRS mahasiswa
    $query_krs = mysqli_query($koneksi, "SELECT * FROM jwl_mhs WHERE mahasiswa_id = '$id'");
}

// Proses input KRS
if (isset($_POST['submit'])) {
    $matkul = mysqli_real_escape_string($koneksi, $_POST['matkul']);
    $sks = 3; // Default SKS
    $kelp = 'A11.4201'; // Default Kelas
    $ruangan = 'H6.3'; // Default Ruangan

    if (!empty($matkul)) {
        $query_insert = "INSERT INTO jwl_mhs (mahasiswa_id, matkul, sks, kelp, ruangan) VALUES ('$id', '$matkul', '$sks', '$kelp', '$ruangan')";
        mysqli_query($koneksi, $query_insert);
        header("Location: jwl_mhs.php?id=$id&success=1");
    } else {
        echo "<script>alert('Mata kuliah tidak boleh kosong!');</script>";
    }
}

// Hapus data KRS
if (isset($_GET['hapus'])) {
    $id_krs = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM jwl_mhs WHERE id = '$id_krs'");
    echo "<script>alert('Mata kuliah berhasil dihapus!'); window.location = 'jwl_mhs.php?id=$id';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input KRS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Sistem Input Kartu Rencana Studi (KRS)</h2>
        <p class="text-center">Input data KRS mahasiswa dengan mudah dan cepat!</p>

        <div class="alert alert-info">
            <strong>Mahasiswa:</strong> <?= $data_inputmhs['nama']; ?> |
            <strong>NIM:</strong> <?= $data_inputmhs['nim']; ?> |
            <strong>IPK:</strong> <?= $data_inputmhs['ipk']; ?>
            <a href="input.php" class="btn btn-warning btn-sm float-end">Kembali ke data mahasiswa</a>
        </div>

        <!-- Form input KRS -->
        <form action="" method="POST">
            <div class="mb-3">
                <input type="text" name="matkul" class="form-control" placeholder="Masukkan Mata Kuliah" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        </form>

        <!-- Tabel KRS -->
        <table id="krsTable" class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Matakuliah</th>
                    <th>SKS</th>
                    <th>Kelompok</th>
                    <th>Ruangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($query_krs)) {
                    echo "<tr>
                            <td>{$no}</td>
                            <td>{$row['matkul']}</td>
                            <td>{$row['sks']}</td>
                            <td>{$row['kelp']}</td>
                            <td>{$row['ruangan']}</td>
                            <td>
                                <a href='jwl_mhs.php?id=$id&hapus={$row['id']}' class='btn btn-danger btn-sm'>Hapus</a>
                            </td>
                          </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- JavaScript untuk Scroll -->
    <script>
        // Periksa apakah ada parameter "success" di URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('success')) {
            // Scroll ke tabel KRS
            const krsTable = document.getElementById('krsTable');
            if (krsTable) {
                krsTable.scrollIntoView({ behavior: 'smooth' });
            }
        }
    </script>
</body>
</html>
