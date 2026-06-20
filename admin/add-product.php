<?php include_once 'header.php';

if (isset($_POST['submit_product']))
{
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $tag = implode(', ',$_POST['tag']);
    $type = $_POST['type'];
    $size = implode(', ',$_POST['size']);
    $color = implode(', ',$_POST['color']);
    $one_line_title = $_POST['one_line_title'];
    $description = $_POST['description'];
    $weight = $_POST['weight'];
    $dimension = $_POST['dimension'];
    $material = $_POST['material'];
    $stock = $_POST['stock'];
    
    // Proses Upload Gambar
    $image1 = rand(1,1000000).$_FILES['image1']['name'];
    $image2 = rand(1,1000000).$_FILES['image2']['name'];
    $image3 = rand(1,1000000).$_FILES['image3']['name'];

    $path1 = 'image/'.$image1;
    $path2 = 'image/'.$image2;
    $path3 = 'image/'.$image3;

    move_uploaded_file($_FILES['image1']['tmp_name'],$path1);
    move_uploaded_file($_FILES['image2']['tmp_name'],$path2);
    move_uploaded_file($_FILES['image3']['tmp_name'],$path3);

    $sql_insert = "insert into `product`(`name`,`price`,`category`,`tag`,`type`,`one_line_title`,`size`,`color`, `description`,`weight`,`dimension`,`material`,`image1`,`image2`,`image3`,`stock`)values('$name','$price','$category','$tag','$type','$one_line_title','$size','$color','$description','$weight','$dimension','$material','$image1','$image2','$image3','$stock')";
    mysqli_query($conn,$sql_insert);

    // Popup notifikasi sukses dan redirect
    echo "<script>alert('Menu roti baru berhasil ditambahkan!'); window.location.href='add-product.php';</script>";
}

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Menu Roti Baru</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Manajemen Produk</li>
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
                <h3 class="card-title">Formulir Tambah Menu Roti</h3>
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
              <form method="post" enctype="multipart/form-data">
                  <div class="card-body">
                    
                  <div class="form-group">
                    <label for="name">Nama Menu / Roti</label>
                    <input type="text" class="form-control" id="name" placeholder="Misal: Roti Sisir Rasa Coklat" name="name" maxlength="40" required>
                  </div>

                  <div class="form-group">
                    <label for="price">Harga (Rp)</label>
                    <input type="text" class="form-control" id="price" maxlength="50" placeholder="Misal: 15000 (Hanya angka)" name="price" required>
                  </div>

                  <div class="form-group">
                    <label>Kategori Roti</label>
                    <select class="form-control" name="category" required>
                      <option selected disabled>- Pilih Kategori -</option>
                      <option value="roti-manis">Roti Manis</option>
                      <option value="roti-gurih">Roti Gurih</option>
                      <option value="kue-pastry">Kue & Pastry</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Tag (Posisi Tampil di Beranda)</label>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="tag[]" value="Best-seller" id="tag1">
                      <label class="form-check-label" for="tag1">Terlaris (Best Seller)</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="tag[]" value="Featured" id="tag2">
                      <label class="form-check-label" for="tag2">Rekomendasi (Featured)</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="tag[]" value="Sale" id="tag3">
                      <label class="form-check-label" for="tag3">Promo Spesial (Sale)</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="tag[]" value="Top-rate" id="tag4">
                      <label class="form-check-label" for="tag4">Rating Tertinggi (Top Rate)</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Tipe (Metode Masak)</label>
                    <select class="form-control" name="type" required>
                      <option selected disabled>- Pilih Tipe -</option>
                      <option value="Panggang">Panggang (Oven)</option>
                      <option value="Goreng">Goreng</option>
                      <option value="Kukus">Kukus</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Ukuran Porsi (Size)</label>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="size[]" value="Mini" id="sz1">
                      <label class="form-check-label" for="sz1">Mini</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="size[]" value="Reguler" id="sz2">
                      <label class="form-check-label" for="sz2">Reguler</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="size[]" value="Besar" id="sz3">
                      <label class="form-check-label" for="sz3">Besar</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="size[]" value="Loyang/Box" id="sz4">
                      <label class="form-check-label" for="sz4">Loyang / Box</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Varian Rasa Utama (Color)</label>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="color[]" value="Original" id="cl1">
                      <label class="form-check-label" for="cl1">Original</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="color[]" value="Coklat" id="cl2">
                      <label class="form-check-label" for="cl2">Coklat</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="color[]" value="Keju" id="cl3">
                      <label class="form-check-label" for="cl3">Keju</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="color[]" value="Daging/Abon" id="cl4">
                      <label class="form-check-label" for="cl4">Daging / Abon</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="color[]" value="Buah" id="cl5">
                      <label class="form-check-label" for="cl5">Buah-buahan</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Slogan / Info Singkat Roti</label>
                    <textarea type="text" class="form-control" placeholder="Misal: Roti lembut dengan isian coklat lumer" name="one_line_title" maxlength="100" required></textarea>
                  </div>

                  <div class="form-group">
                    <label>Deskripsi Lengkap Roti</label>
                    <textarea rows="5" type="text" class="form-control" placeholder="Jelaskan detail roti di sini..." name="description" maxlength="500" required></textarea>
                  </div>

                   <div class="form-group">
                    <label>Berat Roti (Gram/KG)</label>
                    <input type="text" class="form-control" placeholder="Misal: 500 gram" name="weight" maxlength="10" required>
                  </div>

                  <div class="form-group">
                    <label>Dimensi/Ukuran Roti (CM)</label>
                    <input type="text" class="form-control" placeholder="Misal: 20x10x5 cm" name="dimension" maxlength="20" required>
                  </div>

                  <div class="form-group">
                    <label>Komposisi Utama (Material)</label>
                    <input type="text" class="form-control" placeholder="Misal: Tepung Terigu, Mentega, Coklat" name="material" maxlength="50" required>
                  </div>

                  <div class="form-group">
                    <label for="image1">Gambar 1 (Gambar Utama)</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image1" name="image1" required>
                        <label class="custom-file-label" for="image1">Pilih gambar utama</label>
                      </div>
                    </div> 
                  </div>

                  <div class="form-group">
                    <label for="image2">Gambar 2 (Opsional / Biarkan kosong jika tidak ada)</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image2" name="image2">
                        <label class="custom-file-label" for="image2">Pilih gambar kedua</label>
                      </div>
                    </div> 
                  </div>

                  <div class="form-group">
                    <label for="image3">Gambar 3 (Opsional / Biarkan kosong jika tidak ada)</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image3" name="image3">
                        <label class="custom-file-label" for="image3">Pilih gambar ketiga</label>
                      </div>
                    </div> 
                  </div>

                  <div class="form-group">
                    <label>Ketersediaan Stok</label>
                    <select class="form-control" name="stock" required>
                      <option selected disabled>- Pilih Status Stok -</option>
                      <option value="In Stock">Tersedia (In Stock)</option>
                      <option value="Out of Stock">Habis (Out of Stock)</option>
                    </select>
                  </div>

                </div>
                <!-- /.card-body -->
           
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit_product">Simpan Menu Baru</button>
                </div>

              </form>
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