<?php
session_start();

include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nomor_plat = $_POST['nomor_plat'];
    $jenis_kendaraan = $_POST['jenis_kendaraan'];
    $tanggal = $_POST['tanggal'];
    $jam = $_POST['jam'];
    $no_parkir = $_POST['no_parkir'];

     if (empty($id)) {
          $sql = "INSERT INTO parkir (nama, nomor_plat, jenis_kendaraan, tanggal, jam, no_parkir) VALUES ('$nama', '$nomor_plat', '$jenis_kendaraan', '$tanggal', '$jam', '$no_parkir')";

          if ($conn->query($sql) === TRUE) {

               $_SESSION['success_message'] = "Data berhasil ditambahkan.";
               $_SESSION['booking_parkir'] = [
                   'nama'               => $nama,
                   'nomor_plat'         => $nomor_plat,
                   'jenis_kendaraan'    => $jenis_kendaraan,
                   'tanggal'            => $tanggal,
                   'jam'                => $jam,
                   'no_parkir'          => $no_parkir
               ];
               header("Location: index.php");
          } else {
               echo "Error: " . $sql . "<br>" . $conn->error;
          }
     } else {
          header("Location: index.php");
          exit;
     }
}
?>