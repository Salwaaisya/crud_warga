<?php
session_start();
if (!isset($_SESSION['login'])) header("Location: index.php");
include "config.php";

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telepon'];
    $id = $_POST['id'];

    if ($id == "") {
        $conn->query("INSERT INTO warga (nama, alamat, telepon) VALUES ('$nama', '$alamat', '$telp')");
    } else {
        $conn->query("UPDATE warga SET nama='$nama', alamat='$alamat', telepon='$telp' WHERE id=$id");
    }
    header("Location: warga.php");
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM warga WHERE id=$id");
    header("Location: warga.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Warga</title>
    <link href="bootstrap.min.css" rel="stylesheet">
</head>
<body class="container p-4">
    <h2>Data Warga</h2>
    <form method="post" class="mb-3">
        <input type="hidden" name="id" value="<?= $_GET['edit'] ?? '' ?>">
        <?php
        $nama = $alamat = $telp = "";
        if (isset($_GET['edit'])) {
            $id = $_GET['edit'];
            $q = $conn->query("SELECT * FROM warga WHERE id=$id");
            $d = $q->fetch_assoc();
            $nama = $d['nama'];
            $alamat = $d['alamat'];
            $telp = $d['telepon'];
        }
        ?>
        <input type="text" name="nama" value="<?= $nama ?>" placeholder="Nama" class="form-control mb-2" required>
        <textarea name="alamat" class="form-control mb-2" placeholder="Alamat"><?= $alamat ?></textarea>
        <input type="text" name="telepon" value="<?= $telp ?>" placeholder="Telepon" class="form-control mb-2">
        <button name="simpan" class="btn btn-success">Simpan</button>
        <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
    </form>

    <table class="table table-bordered">
        <tr><th>No</th><th>Nama</th><th>Alamat</th><th>Telepon</th><th>Aksi</th></tr>
        <?php
        $no = 1;
        $q = $conn->query("SELECT * FROM warga");
        while ($d = $q->fetch_assoc()) {
            echo '<tr>
                <td>' . $no . '</td>
                <td>' . $d['nama'] . '</td>
                <td>' . $d['alamat'] . '</td>
                <td>' . $d['telepon'] . '</td>
                <td>
                    <a href="?edit=' . $d['id'] . '" class="btn btn-warning btn-sm">Edit</a>
                    <a href="?hapus=' . $d['id'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Hapus?\')">Hapus</a>
                </td>
            </tr>';
            $no++;
        }
        ?>
    </table>
</body>
</html>
