<?php
function getJumlahPelanggan($conn) {
    $query = "SELECT COUNT(*) as total FROM pembeli";
    $result = $conn->query($query);
    return $result->fetch_assoc()['total'];
}

function getPendapatanBulanIni($conn) {
    $query = "SELECT SUM(harga) as total FROM transaksi 
             WHERE MONTH(tanggal_masuk) = MONTH(CURRENT_DATE())
             AND YEAR(tanggal_masuk) = YEAR(CURRENT_DATE())";
    $result = $conn->query($query);
    return $result->fetch_assoc()['total'] ?? 0;
}

/**
 * Fungsi untuk membersihkan input dari user
 * @param string $data Data yang akan dibersihkan
 * @param mysqli $conn Koneksi database (opsional)
 * @return string Data yang sudah dibersihkan
 */
function sanitizeInput($data, $conn = null) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    
    if ($conn) {
        $data = $conn->real_escape_string($data);
    }
    
    return $data;
}

/**
 * Fungsi untuk redirect dengan flash message
 * @param string $url URL tujuan redirect
 * @param string $type Tipe pesan (success, error, warning, info)
 * @param string $message Pesan yang akan ditampilkan
 */
function redirectWithMessage($url, $type, $message) {
    if (!isset($_SESSION)) {
        session_start();
    }
    $_SESSION['flash_message'] = $message;
    $_SESSION['flash_type'] = $type;
    header("Location: $url");
    exit();
}
?>