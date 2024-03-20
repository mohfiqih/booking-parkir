<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $result = $conn->query("SELECT * FROM parkir WHERE id=$id");

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Website CRUD Booking Parkir</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

     <style>
     .parking-lot {
          padding: 10px 25px;
          margin: 5px;
          border: 1px solid #ccc;
          cursor: pointer;
          background-color: #fff;
     }

     .parking-lot.selected {
          background-color: #007bff;
          color: #fff;
     }
     </style>
</head>

<body>
     <div class="container" style="padding-top: 50px;">
          <h2>Edit Data Booking</h2>
          <form action="backend-edit.php?id=<?php echo $id; ?>" method="POST">
               <div class="card">
                    <div class="card-body">
                         <div class="form-row">
                              <div class="form-group">
                                   <label for="nama">Nama:</label>
                                   <input type="text" class="form-control" id="nama" name="nama"
                                        value="<?php echo $row['nama']; ?>" placeholder="Masukan Nama" required>
                              </div>
                              <br />
                              <div class="form-group">
                                   <label for="nomor_plat">Nomor Plat:</label>
                                   <input type="text" class="form-control" id="nomor_plat" name="nomor_plat"
                                        placeholder="Masukan Plat Nomor" value="<?php echo $row['nomor_plat']; ?>"
                                        required>
                              </div>
                              <br />
                              <div class="form-group">
                                   <label for="jenis_kendaraan">Jenis Kendaraan:</label>
                                   <input type="text" class="form-control" id="jenis_kendaraan"
                                        value="<?php echo $row['jenis_kendaraan']; ?>" name="jenis_kendaraan"
                                        placeholder="Masukan Jenis Kendaraaan" required>
                              </div>
                              <br />
                              <div class="form-group">
                                   <label for="tanggal">Tanggal:</label>
                                   <input type="date" class="form-control" id="tanggal"
                                        value="<?php echo $row['tanggal']; ?>" name="tanggal" required>
                              </div>
                              <br />
                              <div class="form-group">
                                   <label for="jam">Jam:</label>
                                   <input type="time" class="form-control" id="jam" value="<?php echo $row['jam']; ?>"
                                        name="jam" required>
                              </div>
                              <br />
                              <div class="form-group">
                                   <label for="nomor_parkir">Nomor Parkir:</label>
                                   <div class="parking-lots">
                                        <?php
                                        $sql = "SELECT no_parkir FROM parkir";
                                        $result = $conn->query($sql);
                                        $existingParkingLots = array();
                                        if ($result->num_rows > 0) {
                                             while ($row = $result->fetch_assoc()) {
                                                  $existingParkingLots[] = $row['no_parkir'];
                                             }
                                        }

                                        $parkingLots = array("A1", "A2", "A3", "A4", "A5", "A6", "A7", "A8", "A9", "A10", "B1", "B2", "B3", "B4", "B5", "B6", "B7", "B8", "B9", "B10");
                                        foreach ($parkingLots as $parkingLot) {
                                             $disabledAttribute = (in_array($parkingLot, $existingParkingLots)) ? 'disabled' : '';
                                             echo "<button type='button' class='parking-lot' value='$parkingLot' $disabledAttribute>$parkingLot</button>";
                                        }
                                        ?>
                                   </div>
                                   <input type="hidden" id="selected_parking_lot" name="no_parkir"
                                        value="<?php echo $row['no_parkir']; ?>">
                              </div>
                         </div>
                         <div class="modal-footer" style="padding-top: 20px;">
                              <a href="#" onclick="window.history.back();" style="margin-right: 10px;">
                                   <button type="button" class="btn btn-secondary">Kembali</button>
                              </a>
                              <button type="submit" class="btn btn-primary">Save</button>
                         </div>
                    </div>
               </div>
               <br />
          </form>
     </div>

     <script>
     const parkingLots = document.querySelectorAll('.parking-lot');
     const selectedParkingLotInput = document.getElementById('selected_parking_lot');

     parkingLots.forEach(parkingLot => {
          parkingLot.addEventListener('click', () => {
               // Jika kotak parkir sudah dinonaktifkan, jangan lakukan apa-apa
               if (parkingLot.hasAttribute('disabled')) {
                    return;
               }

               // Set nilai yang dipilih ke input tersembunyi
               selectedParkingLotInput.value = parkingLot.value;
               // Tambahkan gaya visual untuk menandai parkir yang dipilih
               parkingLots.forEach(pl => {
                    pl.classList.remove('selected');
               });
               parkingLot.classList.add('selected');

               // Set tombol yang dipilih menjadi non-interaktif
               parkingLot.disabled = true;
          });
     });
     </script>

     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
          integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
     </script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
          integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
     </script>
</body>

</html>
<?php
        } else {
            echo "Data tidak ditemukan.";
        }
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "ID tidak diterima.";
}

$conn->close();
?>