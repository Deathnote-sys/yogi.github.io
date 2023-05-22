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

// Mengambil data dari permintaan POST
$nama = $_POST['nama'];
$tanggal = $_POST['tanggal'];
$jumlah = $_POST['jumlah'];
$keterangan = $_POST['keterangan'];

// Menyimpan data transaksi ke dalam tabel

$sql = "INSERT INTO transaksi (nama, tanggal, jumlah, keterangan) VALUES ('$nama', '$tanggal', '$jumlah', '$keterangan')";

if ($conn->query($sql) === TRUE) {
    $response = array('message' => 'Data transaksi berhasil disimpan.');
} else {
    $response = array('message' => 'Terjadi kesalahan saat menyimpan data transaksi: ' . $conn->error);
}

// Mengirimkan respon kembali ke JavaScript
header('Content-Type: application/json');
echo json_encode($response);

// Menutup koneksi database
$conn->close();
?>
