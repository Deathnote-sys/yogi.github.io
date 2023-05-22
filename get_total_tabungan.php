<?php
$servername = "localhost"; // Ganti dengan nama server Anda
$username = "root"; // Ganti dengan username MySQL Anda
$password = ""; // Ganti dengan password MySQL Anda
$dbname = "tabungan_mingguan"; // Ganti dengan nama database Anda

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Mengambil jumlah total tabungan dari tabel transaksi
$sql = "SELECT SUM(jumlah) AS total_tabungan FROM transaksi";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalTabungan = $row["total_tabungan"];
} else {
    $totalTabungan = 0;
}

// Membuat array respons
$response = array('total' => $totalTabungan);

// Mengirimkan respons dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);

// Menutup koneksi database
$conn->close();
?>
