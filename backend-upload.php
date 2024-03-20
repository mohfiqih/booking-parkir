<?php

session_start();
include 'koneksi.php';

$uploadError = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["gambar"]) && $_FILES["gambar"]["error"] == 0) { 
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["gambar"]["name"]); 
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["gambar"]["tmp_name"]); 
        if ($check !== false) {
            if ($_FILES["gambar"]["size"] > 500000) { 
                $uploadError = "Maaf, file terlalu besar. Max 500 KB.";
            } else {
                if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile)) { 
                    $nama = $_POST['nama'];
                    $gambar = $targetFile;

                    $sql = "INSERT INTO upload (nama, gambar) VALUES ('$nama', '$gambar')";
                    if ($conn->query($sql) === TRUE) {
                        $_SESSION['success_message'] = "Berhasil upload bukti pembayaran!";
                        header("Location: index.php");
                        exit();
                    } else {
                        $uploadError = "Error: " . $sql . "<br>" . $conn->error;
                        var_dump($conn->error);
                    }
                } else {
                    echo 'Maaf, terjadi kesalahan saat mengupload file.';
                }
            }
        } else {
            echo 'Maaf, file yang diupload bukan merupakan gambar.';
        }
    } else {
        echo 'Silakan pilih file untuk diupload.';
    }
}

$conn->close();
?>