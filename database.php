<?php
include 'koneksi.php';

// Membuat tabel parkir
$sql_parkir = "CREATE TABLE parkir (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    nomor_plat VARCHAR(20) NOT NULL,
    jenis_kendaraan VARCHAR(50) NOT NULL,
    tanggal DATE,
    jam TIME
)";

if ($conn->query($sql_parkir) === TRUE) {
    echo "Tabel parkir berhasil dibuat";
} else {
    echo "Error creating table: " . $conn->error;
}

// Membuat tabel upload
$sql_upload = "CREATE TABLE upload (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama_file VARCHAR(255) NOT NULL
)";

if ($conn->query($sql_upload) === TRUE) {
    echo "Tabel upload berhasil dibuat";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>