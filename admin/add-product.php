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

    header('location:add-product.php');

}

?>

  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
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
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New Product</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" enctype="multipart/form-data">
            
                  <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name/Title of Product</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Title of New Photo" name="name" maxlength="40" required>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Price</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" maxlength="50" placeholder="Enter Some Details of New Photo" name="price" maxlength="50" required>
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
                    <label>Tag (Posisi Tampil di Beranda)</label><br>
                    <input type="checkbox" name="tag[]" value="Best-seller"> Terlaris (Best Seller)<br>
                    <input type="checkbox" name="tag[]" value="Featured"> Rekomendasi (Featured)<br>
                    <input type="checkbox" name="tag[]" value="Sale"> Promo Spesial (Sale)<br>
                    <input type="checkbox" name="tag[]" value="Top-rate"> Rating Tertinggi (Top Rate)
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
                    <label>Ukuran Porsi (Size)</label><br>
                    <input type="checkbox" name="size[]" value="Mini"> Mini<br>
                    <input type="checkbox" name="size[]" value="Reguler"> Reguler<br>
                    <input type="checkbox" name="size[]" value="Besar"> Besar<br>
                    <input type="checkbox" name="size[]" value="Loyang/Box"> Loyang / Box
                  </div>

                  <div class="form-group">
                    <label>Varian Rasa Utama (Color)</label><br>
                    <input type="checkbox" name="color[]" value="Original"> Original<br>
                    <input type="checkbox" name="color[]" value="Coklat"> Coklat<br>
                    <input type="checkbox" name="color[]" value="Keju"> Keju<br>
                    <input type="checkbox" name="color[]" value="Daging/Abon"> Daging / Abon<br>
                    <input type="checkbox" name="color[]" value="Buah"> Buah-buahan
                  </div>

                  <div class="form-group">
                    <label>Judul Singkat Roti</label>
                    <textarea type="text" class="form-control" placeholder="Masukkan Judul Singkat Roti" name="one_line_title" maxlength="100" required></textarea>
                  </div>

                  <div class="form-group">
                    <label>Deskripsi Lengkap Roti</label>
                    <textarea rows="10" type="text" class="form-control" placeholder="Masukkan Deskripsi Roti" name="description" maxlength="500" required></textarea>
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
                    <label for="exampleInputFile">Image 1 (Main Image)</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image1" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose image</label>
                      </div>
                    </div> 
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword1">Stock</label>
                    <select class="form-control" name="stock" required>
                      <option selected disabled>-Select Avilability of Product-</option>
                      <option>In Stock</option>
                      <option>Out of Stock</option>
                    </select>
                  </div>

                <!-- /.card-body -->
           
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit_product">Submit</button>
                </div>


              </form>
            </div>
            <!-- /.card -->
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
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