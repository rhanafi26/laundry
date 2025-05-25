<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

// Tambah Pelanggan Baru
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_pelanggan'])) {
    $nama = sanitizeInput($_POST['nama'], $conn);
    $no_telf = sanitizeInput($_POST['no_telf'], $conn);
    $alamat = sanitizeInput($_POST['alamat'], $conn);
    
    $stmt = $conn->prepare("INSERT INTO pembeli (nama, no_telf, alamat) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nama, $no_telf, $alamat);
    
    if ($stmt->execute()) {
        redirectWithMessage('pelanggan.php', 'success', 'Pelanggan berhasil ditambahkan');
    } else {
        redirectWithMessage('pelanggan.php', 'error', 'Gagal menambahkan pelanggan');
    }
}

// Hapus Pelanggan
if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    if ($id > 0) {
        $conn->query("DELETE FROM pembeli WHERE id_pelanggan = $id");
        redirectWithMessage('pelanggan.php', 'success', 'Pelanggan berhasil dihapus');
    }
}

$pageTitle = "Manajemen Pelanggan";
include 'includes/header.php';
?>

<h1><i class="fas fa-users"></i> Manajemen Pelanggan</h1>

<!-- Form Tambah Pelanggan -->
<form method="POST" class="form-tambah">
    <h2>Tambah Pelanggan Baru</h2>
    <div class="form-group">
        <label for="nama">Nama Lengkap</label>
        <input type="text" name="nama" required>
    </div>
    <div class="form-group">
        <label for="no_telf">Nomor Telepon</label>
        <input type="text" name="no_telf" required>
    </div>
    <div class="form-group">
        <label for="alamat">Alamat</label>
        <textarea name="alamat" rows="3"></textarea>
    </div>
    <button type="submit" name="tambah_pelanggan" class="btn-primary">
        <i class="fas fa-plus"></i> Tambah
    </button>
</form>

<!-- Daftar Pelanggan -->
<div class="daftar-pelanggan">
    <h2>Daftar Pelanggan</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>No. Telepon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM pembeli ORDER BY id_pelanggan");
            while ($row = $result->fetch_assoc()) {
                echo '<tr>
                    <td>'.$row['id_pelanggan'].'</td>
                    <td>'.$row['nama'].'</td>
                    <td>'.$row['no_telf'].'</td>
                    <td>'.substr($row['alamat'], 0, 30).'...</td>
                    <td>
                        <a href="edit_pelanggan.php?id='.$row['id_pelanggan'].'" class="btn-edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="pelanggan.php?hapus='.$row['id_pelanggan'].'" class="btn-delete" onclick="return confirm(\'Hapus pelanggan ini?\')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php'; ?>