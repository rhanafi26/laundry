<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Laundry Express'; ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>

/* Reset dan Base Styles */
:root {
  --primary: #2A5CAA;
  --primary-light: #E6F2FF;
  --secondary: #4FD1C5;
  --dark: #2A2A2A;
  --gray: #555555;
  --light: #F8F9FA;
  --success: #28A745;
  --warning: #FFC107;
  --danger: #DC3545;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
  background-color: #f5f5f5;
  color: var(--dark);
  line-height: 1.6;
}

/* Layout */
.container {
  display: grid;
  grid-template-columns: 250px 1fr;
  min-height: 100vh;
}

.header {
  background-color: white;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  position: fixed;
  width: 250px;
  height: 100vh;
  padding: 20px;
}

.main-content {
  grid-column: 2;
  padding: 30px;
}

/* Logo */
.logo {
  display: flex;
  align-items: center;
  margin-bottom: 30px;
}

.logo img {
  width: 40px;
  margin-right: 10px;
}

.logo h1 {
  font-size: 1.2rem;
  color: var(--primary);
}

/* Navigation */
.navbar ul {
  list-style: none;
}

.navbar li {
  margin-bottom: 10px;
}

.navbar a {
  display: flex;
  align-items: center;
  padding: 10px 15px;
  color: var(--gray);
  text-decoration: none;
  border-radius: 5px;
  transition: all 0.3s;
}

.navbar a i {
  margin-right: 10px;
  width: 20px;
  text-align: center;
}

.navbar a:hover, .navbar .active a {
  background-color: var(--primary-light);
  color: var(--primary);
}

/* Form Styles */
.form-tambah, .form-transaksi {
  background: white;
  padding: 20px;
  border-radius: 8px;
  margin-bottom: 30px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

.form-group input,
.form-group select,
.form-group textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 4px;
}

.form-group textarea {
  min-height: 100px;
  resize: vertical;
}

/* Table Styles */
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  background: white;
  box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

th, td {
  padding: 12px 15px;
  text-align: left;
  border-bottom: 1px solid #eee;
}

th {
  background-color: var(--primary-light);
  color: var(--primary);
}

/* Button Styles */
.btn-primary {
  background-color: var(--primary);
  color: white;
  padding: 10px 15px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.btn-primary:hover {
  background-color: #1e4a8a;
}

.btn-edit {
  color: var(--primary);
  margin-right: 10px;
}

.btn-delete {
  color: var(--danger);
}

/* Alert Styles */
.alert {
  padding: 15px;
  margin-bottom: 20px;
  border-radius: 4px;
  font-weight: bold;
}

.alert-success {
  background-color: #d4edda;
  color: #155724;
  border: 1px solid #c3e6cb;
}

.alert-error {
  background-color: #f8d7da;
  color: #721c24;
  border: 1px solid #f5c6cb;
}

/* Status Badges */
.status {
  padding: 5px 10px;
  border-radius: 20px;
  font-size: 0.8rem;
  font-weight: bold;
  display: inline-block;
}

.status.proses {
  background-color: #FFF3CD;
  color: #856404;
}

.status.selesai {
  background-color: #D4EDDA;
  color: #155724;
}

.status.diambil {
  background-color: #D1ECF1;
  color: #0C5460;
}

/* Responsive Design */
@media (max-width: 768px) {
  .container {
    grid-template-columns: 1fr;
  }
  
  .header {
    width: 100%;
    height: auto;
    position: relative;
  }
  
  .main-content {
    grid-column: 1;
    padding: 20px;
  }
  
  table {
    display: block;
    overflow-x: auto;
  }
}

/* Layanan Checkbox Styles */
.layanan-list {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 10px;
  margin-top: 10px;
}

.layanan-item {
  display: flex;
  align-items: center;
  padding: 8px;
  border: 1px solid #ddd;
  border-radius: 4px;
  background: white;
}

.layanan-item input {
  margin-right: 10px;
}
</style>
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