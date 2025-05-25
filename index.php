<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundry Express - Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'includes/config.php'; ?>
    
    <div class="container">
        <header class="header">
            <div class="logo">                
                <img src="assets/images/logo-laundry.png" alt="Laundry Express">
                <h1>Laundry Express</h1>
            </div>
            <nav class="navbar">
                <ul>
                    <li class="active"><a href="index.php"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li><a href="transaksi.php"><i class="fas fa-exchange-alt"></i> Transaksi</a></li>
                    <li><a href="pelanggan.php"><i class="fas fa-users"></i> Pelanggan</a></li>
                    <li><a href="layanan.php"><i class="fas fa-concierge-bell"></i> Layanan</a></li>
                    <li><a href="karyawan.php"><i class="fas fa-user-tie"></i> Karyawan</a></li>
                </ul>
            </nav>
        </header>

        <main class="main-content">
            <div class="stats-cards">
                <div class="card">
                    <div class="card-icon blue">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                    <div class="card-info">
                        <h3>Transaksi Hari Ini</h3>
                        <p>
                            <?php
                            $query = "SELECT COUNT(*) as total FROM transaksi 
                                     WHERE DATE(tanggal_masuk) = CURDATE()";
                            $result = $conn->query($query);
                            echo $result->fetch_assoc()['total'];
                            ?>
                        </p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-icon green">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="card-info">
                        <h3>Pendapatan Hari Ini</h3>
                        <p>
                            <?php
                            $query = "SELECT SUM(harga) as total FROM transaksi 
                                     WHERE DATE(tanggal_masuk) = CURDATE()";
                            $result = $conn->query($query);
                            echo 'Rp ' . number_format($result->fetch_assoc()['total'], 0, ',', '.');
                            ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="recent-transactions">
                <h2><i class="fas fa-history"></i> Transaksi Terakhir</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pelanggan</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT t.id_transaksi, p.nama, t.tanggal_masuk, t.harga, t.status 
                                  FROM transaksi t
                                  JOIN pembeli p ON t.id_pelanggan = p.id_pelanggan
                                  ORDER BY t.tanggal_masuk DESC LIMIT 5";
                        $result = $conn->query($query);
                        
                        while($row = $result->fetch_assoc()) {
                            echo '<tr>
                                <td>LA-' . str_pad($row['id_transaksi'], 4, '0', STR_PAD_LEFT) . '</td>
                                <td>' . $row['nama'] . '</td>
                                <td>' . date('d M Y', strtotime($row['tanggal_masuk'])) . '</td>
                                <td>Rp ' . number_format($row['harga'], 0, ',', '.') . '</td>
                                <td><span class="status ' . strtolower($row['status']) . '">' . $row['status'] . '</span></td>
                            </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>