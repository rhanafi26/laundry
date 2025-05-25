<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_karyawan'])) {
    $nama = sanitizeInput($_POST['nama'], $conn);
    $no_telf = sanitizeInput($_POST['no_telf'], $conn);
    $role = sanitizeInput($_POST['role'], $conn);
    
    $stmt = $conn->prepare("UPDATE karyawan SET nama=?, no_telf=?, role=? WHERE id_karyawan=?");
    $stmt->bind_param("sssi", $nama, $no_telf, $role, $id);
    
    if ($stmt->execute()) {
        redirectWithMessage('karyawan.php', 'success', 'Data karyawan berhasil diperbarui');
    } else {
        redirectWithMessage('karyawan.php', 'error', 'Gagal memperbarui data karyawan');
    }
}

// Ambil data karyawan
$karyawan = [];
if ($id > 0) {
    $result = $conn->query("SELECT * FROM karyawan WHERE id_karyawan = $id");
    $karyawan = $result->fetch_assoc();
}

if (!$karyawan) {
    redirectWithMessage('karyawan.php', 'error', 'Karyawan tidak ditemukan');
}

$pageTitle = "Edit Karyawan";
include 'includes/header.php';
?>

<h1><i class="fas fa-user-tie"></i> Edit Data Karyawan</h1>

<form method="POST" class="form-tambah">
    <div class="form-group">
        <label for="nama">Nama Lengkap</label>
        <input type="text" name="nama" value="<?php echo $karyawan['nama']; ?>" required>
    </div>
    <div class="form-group">
        <label for="no_telf">Nomor Telepon</label>
        <input type="text" name="no_telf" value="<?php echo $karyawan['no_telf']; ?>" required>
    </div>
    <div class="form-group">
        <label for="role">Jabatan</label>
        <select name="role" required>
            <option value="Admin" <?php echo $karyawan['role'] == 'Admin' ? 'selected' : ''; ?>>Admin</option>
            <option value="Staff Laundry" <?php echo $karyawan['role'] == 'Staff Laundry' ? 'selected' : ''; ?>>Staff Laundry</option>
        </select>
    </div>
    <button type="submit" name="update_karyawan" class="btn-primary">
        <i class="fas fa-save"></i> Simpan Perubahan
    </button>
    <a href="karyawan.php" class="btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</form>

<?php include 'includes/footer.php'; ?>