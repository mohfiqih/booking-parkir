<?php
include 'koneksi.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM parkir WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
          $_SESSION['success_message'] = "Data berhasil ditambahkan.";
          header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>