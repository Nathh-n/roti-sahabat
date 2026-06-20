<?php include_once 'header.php';

$view_id = $_GET['v_id'];

$sql_select = "select * from `order` where `id`='$view_id'";
$data = mysqli_query($conn,$sql_select);
$row = mysqli_fetch_assoc($data);

?>
  
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Pesanan Pelanggan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Detail Pesanan</li>
            </ol>
          </div>
        </div>
      </div></section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-8">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Informasi Lengkap Pesanan</h3>
              </div>
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                  
                  <tr>
                    <th style="width: 35%;">Status Pesanan Saat Ini</th>
                    <td>
                        <?php 
                        if($row['status'] == 'Pending') {
                            echo '<span class="badge badge-warning" style="font-size: 14px;"><i class="fa fa-clock-o"></i> Menunggu / Diproses</span>';
                        } elseif($row['status'] == 'Delivered') {
                            echo '<span class="badge badge-success" style="font-size: 14px;"><i class="fa fa-check"></i> Selesai / Terkirim</span>';
                        } else {
                            echo '<span class="badge badge-danger" style="font-size: 14px;"><i class="fa fa-times"></i> Dibatalkan ('.$row['status'].')</span>';
                        }
                        ?>
                    </td>
                  </tr>
                  <tr>
                    <th>ID Produk / Roti</th>
                    <td><?php echo $row['product_id']; ?></td>
                  </tr>
                  <tr>
                    <th>Tanggal & Waktu Pemesanan</th>
                    <td><?php echo date('d/m/Y H:i', strtotime($row['date_time'])); ?></td>
                  </tr>
                  <tr>
                    <th>Nama Menu / Roti</th>
                    <td style="font-weight: bold; color: #2b003a;"><?php echo $row['name']; ?></td>
                  </tr>
                  <tr>
                    <th>Harga Satuan</th>
                    <td>Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></td>
                  </tr>
                  <tr>
                    <th>Jumlah (Qty)</th>
                    <td><?php echo $row['num_product']; ?></td>
                  </tr>
                  <tr>
                    <th>Total Harga Roti Ini</th>
                    <td style="font-weight: bold; color: #c2185b;">Rp <?php echo number_format($row['price'] * $row['num_product'], 0, ',', '.'); ?></td>
                  </tr>
                  <tr>
                    <th>Ukuran Porsi</th>
                    <td><?php echo $row['size']; ?></td>
                  </tr>
                  <tr>
                    <th>Varian Rasa</th>
                    <td><?php echo $row['color']; ?></td>
                  </tr>
                  <tr>
                    <th>Alamat Pengiriman</th>
                    <td><?php echo $row['address']; ?></td>
                  </tr>
                  <tr>
                    <th>Kota</th>
                    <td><?php echo $row['city']; ?></td>
                  </tr>
                  <tr>
                    <th>Kode Pos</th>
                    <td><?php echo $row['pincode']; ?></td>
                  </tr>
                  <tr>
                    <th>Nama Pelanggan</th>
                    <td><?php echo $row['cust_name']; ?></td>
                  </tr>
                  <tr>
                    <th>No. WhatsApp / HP</th>
                    <td><?php echo $row['mobile']; ?></td>
                  </tr>
                  <tr>
                    <th>Alamat Email</th>
                    <td><?php echo $row['email']; ?></td>
                  </tr>
                  <tr>
                    <th>Metode Pembayaran</th>
                    <td><?php echo $row['payment']; ?></td>
                  </tr>
                  <tr>
                    <th>Gambar Pesanan</th>
                    <td align="center">
                         <div style="width: 250px; height: 200px; border-radius: 10px; overflow: hidden; border: 1px solid #ddd;">
                            <img src="image/<?php echo $row['image']; ?>" style="height: 100%; width: 100%; object-fit: cover; object-position: center;">
                         </div>
                    </td>
                  </tr>

                </table>
              </div>
              <div class="card-footer">
                  <a href="edit-order-status.php?e_id=<?php echo $row['id']; ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Ubah Status Pesanan</a>
                  <a href="javascript:history.back()" class="btn btn-secondary float-right">Kembali</a>
              </div>
 
            </div>
            </div>
          </div>
        </div></section>
    </div>
  <?php include_once 'footer.php'; ?>

  <aside class="control-sidebar control-sidebar-dark">
    </aside>
  </div>
<?php include_once 'scripts.php'; ?>