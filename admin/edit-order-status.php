<?php include_once 'header.php';

$view_id = $_GET['e_id'];

$sql_select = "select * from `order` where `id`='$view_id'";
$data = mysqli_query($conn,$sql_select);
$row = mysqli_fetch_assoc($data);

if (isset($_POST['edited_order']))
{
    $status = $_POST['status'];

    $sql_update = "update `order` set `status`='$status' where `id`='$view_id'";
    mysqli_query($conn,$sql_update);

    echo "<script>alert('Status pesanan berhasil diperbarui!'); window.location.href='view-more-product-order.php?v_id=".$row['id']."';</script>";
}

?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ubah Status Pesanan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Ubah Status</li>
            </ol>
          </div>
        </div>
      </div></section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-8">
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Formulir Perubahan Status Pengiriman</h3>
              </div>
              <form method="post" enctype="multipart/form-data">
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped">
                  
                  <tr>
                    <th style="width: 35%;">Status Pesanan Saat Ini</th>
                    <td>
                      <select class="form-control" name="status" required>
                        <option value="Pending" <?php if($row['status']=="Pending"){ echo "selected"; } ?>>Diproses (Pending)</option>
                        <option value="Delivered" <?php if($row['status']=="Delivered"){ echo "selected"; } ?>>Selesai / Terkirim (Delivered)</option>
                        <option value="Cancelled-By-Supplier" <?php if($row['status']=="Cancelled-By-Supplier"){ echo "selected"; } ?>>Batalkan Pesanan (Toko)</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <th>ID Produk / Roti</th>
                    <td><?php echo $row['product_id']; ?></td>
                  </tr>
                  <tr>
                    <th>Tgl & Waktu Pemesanan</th>
                    <td><?php echo date('d/m/Y H:i', strtotime($row['date_time'])); ?></td>
                  </tr>
                  <tr>
                    <th>Nama Menu / Roti</th>
                    <td style="font-weight: 700; color: #2b003a;"><?php echo $row['name']; ?></td>
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
                <button type="submit" class="btn btn-warning" name="edited_order"><i class="fa fa-save"></i> Simpan Perubahan Status</button>
                <a href="javascript:history.back()" class="btn btn-secondary float-right">Batal</a>
            </div>
          </form>
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