<?php include_once 'header.php';

$sql_select_data = "select * from `order` where `status`='Pending'";
$data_data = mysqli_query($conn,$sql_select_data);
$data_count = mysqli_num_rows($data_data);

$limit = 5;
$page_count = ceil($data_count/$limit);

if (isset($_GET['p_id']))
{
  $page_no = $_GET['p_id'];
}
else
{
  $page_no=1;
}

$start = ($page_no-1)*$limit;

$sql_select = "select * from `order` where `status`='Pending' limit $start,$limit";
$data = mysqli_query($conn,$sql_select);

?>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pesanan Masuk (Menunggu Diproses)</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Pesanan Baru</li>
            </ol>
          </div>
        </div>
      </div></section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Daftar Pesanan Pelanggan</h3>
              </div>
              <div class="card-body table-responsive p-0">
                <table id="example2" class="table table-bordered table-striped table-hover display_order_admin_page_change text-nowrap">
                  <thead>
                  <tr>
                    <th>ID Roti</th>
                    <th>Tgl & Waktu Pesan</th>
                    <th>Nama Roti</th>
                    <th>Jumlah (Qty)</th>
                    <th>Gambar Pesanan</th>
                    <th>Alamat Pengiriman</th>
                    <th>Kota & Kode Pos</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  
                  <tbody>
                  <?php 
                  if(mysqli_num_rows($data) > 0) {
                      while ($row = mysqli_fetch_assoc($data)) { ?>

                       <tr>
                        <td><?php echo $row['product_id']; ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($row['date_time'])); ?></td>
                        <td style="font-weight: 600; color: #2b003a;"><?php echo $row['name']; ?></td>
                        <td align="center"><span class="badge badge-info" style="font-size: 14px;"><?php echo $row['num_product']; ?></span></td>
                        <td align="center">
                             <div style="width: 120px; height: 100px; border-radius: 8px; overflow: hidden; border: 1px solid #ddd;">
                                <img src="image/<?php echo $row['image']; ?>" style="height: 100%; width: 100%; object-fit: cover; object-position: center;">
                             </div>
                        </td>
                        <td style="white-space: normal; min-width: 200px;"><?php echo $row['address']; ?></td>
                        <td><?php echo $row['city']; ?>, <?php echo $row['pincode']; ?></td>                    
                        <td>
                            <a href="view-more-product-order.php?v_id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">
                                <i class="fa fa-eye"></i> Detail / Proses
                            </a>
                        </td>
                      </tr>

                      <?php } 
                  } else {
                      echo '<tr><td colspan="8" align="center" style="padding: 30px;">Belum ada pesanan baru yang masuk.</td></tr>';
                  }
                  ?>
                  </tbody>

                   <tr>
                    <td colspan="8" align="center">
                  <?php for ($i=1; $i<=$page_count; $i++) { ?>
                    <a href="javascript:void(0)" class="btn btn-sm <?php echo (isset($_GET['p_id']) && $_GET['p_id']==$i) || (!isset($_GET['p_id']) && $i==1) ? 'btn-primary' : 'btn-outline-primary'; ?> order_admin_page_change" attr_id="<?php echo $i; ?>">
                    <?php echo $i; ?>
                    </a>
                  <?php } ?>   
                    </td>
                  </tr>

                </table>
              </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  <?php include_once 'footer.php'; ?>

  <aside class="control-sidebar control-sidebar-dark">
    </aside>
  </div>
<?php include_once 'scripts.php'; ?>