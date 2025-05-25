<?php
include 'includes/config.php';
include 'includes/functions.php';

// Tambah Layanan Baru
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['tambah_layanan'])) {
    $nama = $_POST['nama_layanan'];
    $harga = $_POST['harga'];
    
    $stmt = $conn->prepare("INSERT INTO layanan (nama_layanan, harga) VALUES (?, ?)");
    $stmt->bind_param("sd", $nama, $harga);
    
    if ($stmt->execute()) {
        header("Location: layanan.php?success=1");
        exit();
    }
}

// Hapus Layanan
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM layanan WHERE id_layanan = $id");
    header("Location: layanan.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Layanan - Laundry Express</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'header.php'; ?>
    
    <main class="main-content">
        <h1><i class="fas fa-concierge-bell"></i> Manajemen Layanan</h1>
        
        <!-- Form Tambah Layanan -->
        <form method="POST" class="form-tambah">
            <h2>Tambah Layanan Baru</h2>
            <div class="form-group">
                <label for="nama_layanan">Nama Layanan</label>
                <input type="text" name="nama_layanan" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga (Rp)</label>
                <input type="number" name="harga" min="0" step="500" required>
            </div>
            <button type="submit" name="tambah_layanan" class="btn-primary">
                <i class="fas fa-plus"></i> Tambah
            </button>
        </form>
        
        <!-- Daftar Layanan -->
        <div class="daftar-layanan">
            <h2>Daftar Layanan Tersedia</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Layanan</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM layanan ORDER BY id_layanan");
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>
                            <td>'.$row['id_layanan'].'</td>
                            <td>'.$row['nama_layanan'].'</td>
                            <td>Rp '.number_format($row['harga'], 0, ',', '.').'</td>
                            <td>
                                <a href="edit_layanan.php?id='.$row['id_layanan'].'" class="btn-edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="layanan.php?hapus='.$row['id_layanan'].'" class="btn-delete" onclick="return confirm(\'Hapus layanan ini?\')">
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