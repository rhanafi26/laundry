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
?>