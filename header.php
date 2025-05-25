<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Laundry Express'; ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="logo">
                <img src="../assets/images/logo-laundry.png" alt="Laundry Express">
                <h1>Laundry Express</h1>
            </div>
            <nav class="navbar">
                <ul>
                    <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                        <a href="index.php"><i class="fas fa-home"></i> Dashboard</a>
                    </li>
                    <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'transaksi.php' ? 'active' : ''; ?>">
                        <a href="transaksi.php"><i class="fas fa-exchange-alt"></i> Transaksi</a>
                    </li>
                    <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'pelanggan.php' ? 'active' : ''; ?>">
                        <a href="pelanggan.php"><i class="fas fa-users"></i> Pelanggan</a>
                    </li>
                    <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'layanan.php' ? 'active' : ''; ?>">
                        <a href="layanan.php"><i class="fas fa-concierge-bell"></i> Layanan</a>
                    </li>
                    <li class="<?php echo basename($_SERVER['PHP_SELF']) == 'karyawan.php' ? 'active' : ''; ?>">
                        <a href="karyawan.php"><i class="fas fa-user-tie"></i> Karyawan</a>
                    </li>
                </ul>
            </nav>
        </header>

        <main class="main-content">
            <?php if (isset($_SESSION['flash_message'])): ?>
                <div class="alert alert-<?php echo $_SESSION['flash_type']; ?>">
                    <?php echo $_SESSION['flash_message']; ?>
                    <?php unset($_SESSION['flash_message']); unset($_SESSION['flash_type']); ?>
                </div>
            <?php endif; ?>