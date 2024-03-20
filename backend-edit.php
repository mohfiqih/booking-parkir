<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        
        $nama = $_POST['nama'];
        $nomor_plat = $_POST['nomor_plat'];
        $jenis_kendaraan = $_POST['jenis_kendaraan'];
        $tanggal = $_POST['tanggal'];
        $jam = $_POST['jam'];
        $no_parkir = $_POST['no_parkir'];

        // Update the database
        $sql = "UPDATE parkir SET
                nama='$nama',
                nomor_plat='$nomor_plat',
                jenis_kendaraan='$jenis_kendaraan',
                tanggal='$tanggal',
                jam='$jam',
                no_parkir='$no_parkir'
                WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['success_message'] = "Data berhasil diedit.";
            header("Location: index.php");
            exit;
        } else {
            $_SESSION['error_message'] = "Error: " . $sql . "<br>" . $conn->error;
            // var_dump($conn->error);
        }
    }
}

$conn->close();
?>