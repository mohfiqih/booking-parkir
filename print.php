<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <title>Cetak Tiket</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
     <style>
     .struk {
          width: 100%;
          border-collapse: collapse;
          font-family: Arial, sans-serif;
          font-size: 12px;
          text-align: left;
     }

     .struk h2 {
          margin-bottom: 20px;
     }

     .struk p {
          margin: 5px 0;
     }

     .print-button {
          margin-top: 20px;
     }
     </style>
</head>

<body>
     <div class="container" style="width: 500px;padding-top: 20px;">
          <div class="card">
               <div class="card-body">
                    <div class="struk">
                         <h3 style="text-align: center;">Tiket Parkir</h3>
                         <p style="text-align: center;font-size: 12px;">Mohon simpan tiket ini dengan baik, tunjukan
                              bukti tiket ini
                              saat masuk <br />dan
                              keluar dari parkiran! Terimakasih. </p>
                         <hr>
                         <?php
                          include 'koneksi.php';
                          $no = 0;
                          $id = $_GET['id'];
                          $sql = "SELECT * FROM parkir WHERE id = $id";
                          $result = $conn->query($sql);

                          if ($result && $result->num_rows > 0) {
                              $data = $result->fetch_assoc(); ?>

                         <table class="struk">
                              <tr>
                                   <th width="120">Nama</th>
                                   <th>:</th>
                                   <td><?php echo $data['nama']; ?></td>
                              </tr>
                              <tr>
                                   <th>Nomor Plat</th>
                                   <th>:</th>
                                   <td><?php echo $data['nomor_plat']; ?></td>
                              </tr>
                              <tr>
                                   <th>Jenis Kendaraan</th>
                                   <th>:</th>
                                   <td><?php echo $data['jenis_kendaraan']; ?></td>
                              </tr>
                              <tr>
                                   <th>Tanggal</th>
                                   <th>:</th>
                                   <td><?php echo $data['tanggal']; ?></td>
                              </tr>
                              <tr>
                                   <th>Jam</th>
                                   <th>:</th>
                                   <td><?php echo $data['jam']; ?></td>
                              </tr>
                              <tr>
                                   <th>Nomor Parkir</th>
                                   <th>:</th>
                                   <td><?php echo $data['no_parkir']; ?></td>
                              </tr>
                         </table>

                         <?php } else {
                              echo "Data tidak ditemukan.";
                          }
                          ?>

                    </div>
                    <button class="btn btn-primary print-button" style="width: 100%;">
                         Simpan Tiket Parkir</button>
               </div>
          </div>
     </div>

     <script>
     // Print automatically when the page is loaded
     window.onload = function() {
          window.print();
     };
     </script>
</body>

</html>