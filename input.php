<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'krs');
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Fungsi hitung SKS Maksimal
function hitungSks($ipk) {
    return ($ipk < 3.0) ? 20 : 24;
}

// Tambah data mahasiswa
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $ipk = $_POST['ipk'];
    $sks = hitungSks($ipk);

    // Validasi NIM unik
    $check = $conn->query("SELECT * FROM inputmhs WHERE nim = '$nim'");
    if ($check->num_rows > 0) {
        echo "<script>alert('NIM sudah ada!'); window.location = 'index.php';</script>";
    } else {
        $conn->query("INSERT INTO inputmhs (nama, nim, ipk, sks) VALUES ('$nama', '$nim', '$ipk', '$sks')");
        echo "<script>alert('Data berhasil ditambahkan!'); window.location = 'input.php';</script>";
    }
}

// Hapus data mahasiswa
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM inputmhs WHERE id = $id");
    echo "<script>alert('Data berhasil dihapus!'); window.location = 'input.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Input KRS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Sistem Input Kartu Rencana Studi (KRS)</h1>
        <p class="text-center">Input data Mahasiswa disini!</p>
        <form method="POST" class="row g-3 mb-4">
            <div class="col-md-4">
                <label for="nama" class="form-label">Nama Mahasiswa</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Mahasiswa" required>
            </div>
            <div class="col-md-4">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM" required>
            </div>
            <div class="col-md-4">
                <label for="ipk" class="form-label">IPK</label>
                <input type="number" step="0.01" class="form-control" id="ipk" name="ipk" placeholder="Masukkan IPK" required>
            </div>
            <div class="col-12 text-center">
                <button type="submit" name="submit" class="btn btn-primary">Input Mahasiswa</button>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Mahasiswa</th>
                    <th>IPK</th>
                    <th>SKS Maksimal</th>
                    <th>Mata Kuliah yang Diambil</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
    <?php
    $result = $conn->query("SELECT * FROM inputmhs");
    $no = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$no}</td>
                <td>{$row['nama']}</td>
                <td>{$row['ipk']}</td>
                <td>{$row['sks']}</td>
                <td>" . ($row['matkul'] ?: '-') . "</td>
                <td>
                    <a href='?delete={$row['id']}' class='btn btn-danger btn-sm'>Hapus</a>
                    <a href='jwl_mhs.php?id={$row['id']}' class='btn btn-primary btn-sm'>Edit</a>
                    <a href='jwl_matakuliah.php?id={$row['id']}' class='btn btn-secondary btn-sm'>Lihat</a>
                </td>
              </tr>";
        $no++;
    }
    ?>
</tbody>

        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
