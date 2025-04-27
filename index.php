<?php
include 'config.php';

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

// Tambah Data
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $conn->query("INSERT INTO warga (nama, alamat, no_hp) VALUES ('$nama', '$alamat', '$no_hp')");
    header('Location: index.php');
}

// Hapus Data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM warga WHERE id=$id");
    header('Location: index.php');
}

// Update Data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $conn->query("UPDATE warga SET nama='$nama', alamat='$alamat', no_hp='$no_hp' WHERE id=$id");
    header('Location: index.php');
}

// Ambil data jika mau edit
$edit = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit = $conn->query("SELECT * FROM warga WHERE id=$id")->fetch_assoc();
}

$warga = $conn->query("SELECT * FROM warga");
?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD Warga</title>
</head>
<body>
<h2>Data Warga</h2>
<a href="logout.php">Logout</a>
<br><br>
<form method="POST">
    <?php if ($edit): ?>
        <input type="hidden" name="id" value="<?= $edit['id'] ?>">
    <?php endif; ?>
    Nama: <input type="text" name="nama" required value="<?= $edit['nama'] ?? '' ?>"><br><br>
    Alamat: <input type="text" name="alamat" required value="<?= $edit['alamat'] ?? '' ?>"><br><br>
    No HP: <input type="text" name="no_hp" required value="<?= $edit['no_hp'] ?? '' ?>"><br><br>
    <button type="submit" name="<?= $edit ? 'update' : 'tambah' ?>"><?= $edit ? 'Update' : 'Tambah' ?></button>
</form>

<br><br>
<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>No HP</th>
        <th>Aksi</th>
    </tr>
    <?php $no = 1; while ($row = $warga->fetch_assoc()): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['alamat'] ?></td>
        <td><?= $row['no_hp'] ?></td>
        <td>
            <a href="?edit=<?= $row['id'] ?>">Edit</a> | 
            <a href="?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>
