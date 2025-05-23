<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi - Laundry Express</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php 
    include 'includes/config.php';
    include 'includes/functions.php';
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_pelanggan = $_POST['id_pelanggan'];
        $harga = $_POST['harga'];
        $status = 'Proses';
        
        $query = "INSERT INTO transaksi (id_pelanggan, harga, status) 
                 VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ids", $id_pelanggan, $harga, $status);
        
        if ($stmt->execute()) {
            header("Location: transaksi.php?success=1");
            exit();
        } else {
            $error = "Gagal menambahkan transaksi: " . $conn->error;
        }
    }
    ?>
    
    <div class="container">
        <?php include 'header.php'; ?>
        
        <main class="main-content">
            <h1><i class="fas fa-exchange-alt"></i> Tambah Transaksi Baru</h1>
            
            <?php if (isset($error)): ?>
                <div class="alert error">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <?php if (isset($_GET['success'])): ?>
                <div class="alert success">
                    Transaksi berhasil ditambahkan!
                </div>
            <?php endif; ?>
            
            <form method="POST" class="form-transaksi">
                <div class="form-group">
                    <label for="id_pelanggan">Pilih Pelanggan</label>
                    <select name="id_pelanggan" id="id_pelanggan" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        <?php
                        $query = "SELECT * FROM pembeli ORDER BY nama";
                        $result = $conn->query($query);
                        
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['id_pelanggan'] . '">' 
                                . $row['nama'] . ' - ' . $row['no_telf'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Pilih Layanan</label>
                    <div class="layanan-list">
                        <?php
                        $query = "SELECT * FROM layanan ORDER BY nama_layanan";
                        $result = $conn->query($query);
                        
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="layanan-item">
                                <input type="checkbox" id="layanan-' . $row['id_layanan'] . '" 
                                    name="layanan[]" value="' . $row['id_layanan'] . '"
                                    data-harga="' . $row['harga'] . '">
                                <label for="layanan-' . $row['id_layanan'] . '">' 
                                    . $row['nama_layanan'] . ' - Rp ' 
                                    . number_format($row['harga'], 0, ',', '.') . '</label>
                            </div>';
                        }
                        ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="harga">Total Harga</label>
                    <input type="text" name="harga" id="harga" readonly>
                </div>
                
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save"></i> Simpan Transaksi
                </button>
            </form>
        </main>
    </div>

    <script>
        // Hitung total harga otomatis saat layanan dipilih
        document.querySelectorAll('input[name="layanan[]"]').forEach(checkbox => {
            checkbox.addEventListener('change', calculateTotal);
        });
        
        function calculateTotal() {
            let total = 0;
            document.querySelectorAll('input[name="layanan[]"]:checked').forEach(checkbox => {
                total += parseFloat(checkbox.dataset.harga);
            });
            document.getElementById('harga').value = 'Rp ' + total.toLocaleString('id-ID');
        }
    </script>
</body>
</html>