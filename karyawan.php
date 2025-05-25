<?php
include 'includes/config.php';
include 'includes/functions.php';

// Tambah Karyawan Baru
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_karyawan'])) {
    $nama = $_POST['nama'];
    $no_telf = $_POST['no_telf'];
    $role = $_POST['role'];
    
    $stmt = $conn->prepare("INSERT INTO karyawan (nama, no_telf, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nama, $no_telf, $role);
    
    if ($stmt->execute()) {
        header("Location: karyawan.php?success=1");
        exit();
    }
}

// Hapus Karyawan
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM karyawan WHERE id_karyawan = $id");
    header("Location: karyawan.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Karyawan - Laundry Express</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'header.php'; ?>
    
    <main class="main-content">
        <h1><i class="fas fa-user-tie"></i> Manajemen Karyawan</h1>
        
        <!-- Form Tambah Karyawan -->
        <form method="POST" class="form-tambah">
            <h2>Tambah Karyawan Baru</h2>
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" name="nama" required>
            </div>
            <div class="form-group">
                <label for="no_telf">Nomor Telepon</label>
                <input type="text" name="no_telf" required>
            </div>
            <div class="form-group">
                <label for="role">Jabatan</label>
                <select name="role" required>
                    <option value="Admin">Admin</option>
                    <option value="Staff Laundry">Staff Laundry</option>
                </select>
            </div>
            <button type="submit" name="tambah_karyawan" class="btn-primary">
                <i class="fas fa-plus"></i> Tambah
            </button>
        </form>
        
        <!-- Daftar Karyawan -->
        <div class="daftar-karyawan">
            <h2>Daftar Karyawan</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>No. Telepon</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM karyawan ORDER BY id_karyawan");
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>
                            <td>'.$row['id_karyawan'].'</td>
                            <td>'.$row['nama'].'</td>
                            <td>'.$row['no_telf'].'</td>
                            <td>'.$row['role'].'</td>
                            <td>
                                <a href="edit_karyawan.php?id='.$row['id_karyawan'].'" class="btn-edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="karyawan.php?hapus='.$row['id_karyawan'].'" class="btn-delete" onclick="return confirm(\'Hapus karyawan ini?\')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>