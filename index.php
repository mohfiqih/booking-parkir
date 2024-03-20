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

     .form-group {
          padding: 10px;
     }
     </style>
</head>

<body>
     <?php
     session_start();
     
     if (isset($_SESSION['success_message'])) {
     echo '<script>alert("' . $_SESSION['success_message'] . '");</script>';
     unset($_SESSION['success_message']);
     }
     ?>

     <div class="container" style="padding-top: 50px;">
          <h2>CRUD Booking Parkir</h2>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                    class="fas fa-plus"></i> Booking
               Tiket
          </button>
          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#uploadModal"><i
                    class="fas fa-upload"></i> Upload
               Pembayaran</button>
          <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#dataPembayaranModal"><i
                    class="fas fa-table"></i> Data
               Pembayaran</button>
          <br><br>
          <table class="table">
               <thead>
                    <tr>
                         <th>No</th>
                         <th>Nama</th>
                         <th>Nomor Plat</th>
                         <th>Jenis Kendaraan</th>
                         <th>Tanggal</th>
                         <th>Jam</th>
                         <th>No Parkir</th>
                         <th>Action</th>
                    </tr>
               </thead>
               <tbody>
                    <?php
                              include 'koneksi.php';
                              $no = 0;
                              
                              $sql = "SELECT * FROM parkir WHERE id";
                              $result = $conn->query($sql);
                              
                              if ($result){
                                   $no++;
                              foreach ($result as $d){ 
                         ?>

                    <tr>
                         <td scope="col"><?php echo $no++; ?></td>
                         <td scope="col"><?php echo $d['nama']; ?></td>
                         <td scope="col"><?php echo $d['nomor_plat']; ?></td>
                         <td scope="col"><?php echo $d['jenis_kendaraan']; ?></td>
                         <td scope="col"><?php echo $d['tanggal']; ?></td>
                         <td scope="col"><?php echo $d['jam']; ?></td>
                         <td scope="col"><?php echo $d['no_parkir']; ?></td>
                         <td scope="col">
                              <a href="view-edit.php?id=<?php echo $d["id"]; ?>" style="text-decoration: none;">
                                   <button class="btn btn-warning" style="color: white; text-decoration: none;">
                                        <i class="fas fa-edit"></i>
                                   </button>
                              </a>

                              <a href="backend-delete.php?id=<?php echo $d['id']; ?>" style='text-decoration: none;'
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                   <button class='btn btn-danger'
                                        style='background-color: red; color: white;text-decoration: none;'>
                                        <i class='fas fa-trash'></i>
                                   </button>
                              </a>

                              <a href="print.php?id=<?php echo $d['id']; ?>" style='text-decoration: none;'>
                                   <button class='btn btn-success'
                                        style='background-color: green; color: white;text-decoration: none;'>
                                        <i class='fas fa-print'></i>
                                   </button>
                              </a>
                         </td>
                    </tr>

                    <?php }} else { ?>
                    <td class=" text-center" colspan="8">Tidak ada data
                    </td>
                    <?php } ?>
               </tbody>
          </table>
     </div>

     <!-- Input Data Parkir -->
     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
               <div class="modal-content">
                    <div class="modal-header">
                         <h1 class="modal-title fs-5" id="exampleModalLabel">Input Booking Parkir</h1>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="backend-input.php" method="POST">
                         <div class="modal-body">
                              <div class="form-group">
                                   <label for="nama">Nama:</label>
                                   <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Masukan Nama" required>
                              </div>
                              <div class="form-group">
                                   <label for="nomor_plat">Nomor Plat:</label>
                                   <input type="text" class="form-control" id="nomor_plat" name="nomor_plat"
                                        placeholder="Masukan Plat Nomor" required>
                              </div>
                              <div class="form-group">
                                   <label for="jenis_kendaraan">Jenis Kendaraan:</label>
                                   <input type="text" class="form-control" id="jenis_kendaraan" name="jenis_kendaraan"
                                        placeholder="Masukan Jenis Kendaraaan" required>
                              </div>
                              <div class="form-group">
                                   <label for="tanggal">Tanggal:</label>
                                   <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                              </div>
                              <div class="form-group">
                                   <label for="jam">Jam:</label>
                                   <input type="time" class="form-control" id="jam" name="jam" required>
                              </div>
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
                                   <input type="hidden" id="selected_parking_lot" name="no_parkir">
                              </div>
                         </div>
                         <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save</button>
                         </div>
                    </form>
               </div>
          </div>
     </div>

     <!-- Upload Bukti Pembayaran -->
     <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
          <div class="modal-dialog">
               <div class="modal-content">
                    <div class="modal-header">
                         <h1 class="modal-title fs-5" id="uploadModalLabel">Upload Pembayaran</h1>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="backend-upload.php" method="post" enctype="multipart/form-data">
                         <div class="modal-body">
                              <div class="form-group">
                                   <label for="nama">Nama</label>
                                   <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Masukan Nama" required>
                              </div>
                              <div class="form-group">
                                   <label for="gambar">gambar Bukti</label>
                                   <input type="file" class="form-control" id="gambar" name="gambar" required>
                              </div>
                         </div>
                         <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save</button>
                         </div>
                    </form>
               </div>
          </div>
     </div>

     <!-- Upload Bukti Pembayaran -->
     <div class="modal fade" id="dataPembayaranModal" tabindex="-1" aria-labelledby="dataPembayaranModalLabel"
          aria-hidden="true">
          <div class="modal-dialog">
               <div class="modal-content">
                    <div class="modal-header">
                         <h1 class="modal-title fs-5" id="uploadModalLabel">Upload Pembayaran</h1>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                         <table class="table">
                              <thead>
                                   <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Bukti</th>
                                        <th>Tanggal</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php
                                   include 'koneksi.php';

                                   $sql = "SELECT * FROM upload"; // Ubah query Anda agar memilih semua data dari tabel upload
                                   $result = $conn->query($sql);

                                   if ($result && $result->num_rows > 0) {
                                   $no = 0;
                                   while ($d = $result->fetch_assoc()) {
                                        $no++;
                                        ?>
                                   <tr>
                                        <td scope="col"><?php echo $no; ?></td>
                                        <td scope="col"><?php echo $d['nama']; ?></td>
                                        <td scope="col"><img src="<?= $d['gambar']; ?>" alt="Gambar" width="100px">
                                        </td>
                                        <td scope="col"><?php echo $d['date']; ?></td>
                                   </tr>
                                   <?php
                                        }
                                        } else {
                                        ?>
                                   <tr>
                                        <td class="text-center" colspan="4">Tidak ada data</td>
                                   </tr>
                                   <?php
                                        }
                                   ?>

                              </tbody>
                         </table>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
               </div>
          </div>
     </div>

     <script>
     const parkingLots = document.querySelectorAll('.parking-lot');
     const selectedParkingLotInput = document.getElementById('selected_parking_lot');

     parkingLots.forEach(parkingLot => {
          parkingLot.addEventListener('click', () => {
               if (parkingLot.hasAttribute('disabled')) {
                    return;
               }

               selectedParkingLotInput.value = parkingLot.value;
               parkingLots.forEach(pl => {
                    pl.classList.remove('selected');
               });
               parkingLot.classList.add('selected');
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