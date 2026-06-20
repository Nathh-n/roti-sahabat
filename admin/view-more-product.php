<?php include_once 'header.php';

$view_id = $_GET['v_id'];

$sql_select = "select * from `product` where `id`='$view_id'";
$data = mysqli_query($conn,$sql_select);
$row = mysqli_fetch_assoc($data);

if(isset($_GET['d_id']))
{
    $delete_id = $_GET['d_id'];
    $sql_delete = "delete from `product` where `id`='$delete_id'";
    mysqli_query($conn,$sql_delete);
    
    // Tambahkan pesan sukses dan arahkan kembali
    echo "<script>alert('Produk berhasil dihapus!'); window.location.href='view-product.php';</script>";
    exit; // Wajib ditambahkan agar script berhenti
}

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Menu Roti</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Detail Produk</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Informasi Lengkap Roti</h3>
              </div>
              <!-- /.card-header -->
              
              <div class="card-body">
                <table id="example2" class="table table-bordered table-striped">
                    
                    <tr>
                      <th style="width: 35%;">ID Roti</th>
                      <td><?php echo $row['id']; ?></td>
                    </tr>
                    <tr>
                      <th>Status Stok</th>
                      <td><?php echo $row['stock']; ?></td>
                    </tr>
                    <tr>
                      <th>Nama Menu / Roti</th>
                      <td><?php echo $row['name']; ?></td>
                    </tr>
                    <tr>
                      <th>Harga (Rp)</th>
                      <td>Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                      <th>Kategori</th>
                      <td><?php echo $row['category']; ?></td>
                    </tr>
                    <tr>
                      <th>Tag (Promo/Rekomendasi)</th>
                      <td><?php echo $row['tag']; ?></td>
                    </tr>
                    <tr>
                      <th>Tipe (Metode Masak)</th>
                      <td><?php echo $row['type']; ?></td>
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
                      <th>Berat (Gram)</th>
                      <td><?php echo $row['weight']; ?></td>
                    </tr>
                    <tr>
                      <th>Dimensi (CM)</th>
                      <td><?php echo $row['dimension']; ?></td>
                    </tr>
                    <tr>
                      <th>Komposisi Utama</th>
                      <td><?php echo $row['material']; ?></td>
                    </tr>
                    <tr>
                      <th>Slogan / Info Singkat</th>
                      <td><?php echo $row['one_line_title']; ?></td>
                    </tr>
                    <tr>
                      <th>Deskripsi Lengkap</th>
                      <td><?php echo $row['description']; ?></td>
                    </tr>
                    <tr>
                      <th>Gambar 1 (Utama)</th>
                      <td align="center">
                          <div style="width: 250px; height: 200px; border-radius: 10px; overflow: hidden;">
                              <img src="image/<?php echo $row['image1']; ?>" style="height: 100%; width: 100%; object-fit: cover; object-position: center;">
                          </div>
                      </td>
                    </tr>
                    <tr>
                      <th>Gambar 2</th>
                      <td align="center">
                          <div style="width: 250px; height: 200px; border-radius: 10px; overflow: hidden;">
                              <img src="image/<?php echo $row['image2']; ?>" style="height: 100%; width: 100%; object-fit: cover; object-position: center;">
                          </div>
                      </td>
                    </tr>
                    <tr>
                      <th>Gambar 3</th>
                      <td align="center">
                          <div style="width: 250px; height: 200px; border-radius: 10px; overflow: hidden;">
                              <img src="image/<?php echo $row['image3']; ?>" style="height: 100%; width: 100%; object-fit: cover; object-position: center;">
                          </div>
                      </td>
                    </tr>

                </table>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                  <a href="edit-product.php?e_id=<?php echo $row['id']; ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit Detail Roti</a>
                  <a href="view-more-product.php?v_id=<?php echo $row['id']; ?>&d_id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus roti ini?');"><i class="fa fa-trash"></i> Hapus Roti</a>
                  <a href="view-product.php" class="btn btn-secondary float-right">Kembali ke Daftar Menu</a>
              </div>
 
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include_once 'footer.php'; ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include_once 'scripts.php'; ?>