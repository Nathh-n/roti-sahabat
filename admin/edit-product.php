<?php include_once 'header.php';

if (isset($_GET['e_id']))
{
    $edit_id = $_GET['e_id'];
}

$sql_select = "select * from `product` where `id`='$edit_id'";
$data = mysqli_query($conn,$sql_select);
$row = mysqli_fetch_assoc($data);

$tag = explode(', ',$row['tag']);
$tag_length = count($tag);

$size = explode(', ',$row['size']);
$size_length = count($size);

$color = explode(', ',$row['color']);
$color_length = count($color);


if (isset($_POST['edited_product']))
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

    $image1_e = $_FILES['image1']['name'];
    if ($image1_e=="")
    {
        $image1=$row['image1'];
    }
    else
    {
        unlink('image/'.$row['image1']);

        $image1 = rand(1,1000000).$_FILES['image1']['name'];
        $path1 = 'image/'.$image1;
        move_uploaded_file($_FILES['image1']['tmp_name'],$path1);
    }

    $image2_e = $_FILES['image2']['name'];
    if ($image2_e=="")
    {
        $image2=$row['image2'];
    }
    else
    {
        unlink('image/'.$row['image2']);

        $image2 = rand(1,1000000).$_FILES['image2']['name'];
        $path2 = 'image/'.$image2;
        move_uploaded_file($_FILES['image2']['tmp_name'],$path2);
    }

    $image3_e = $_FILES['image3']['name'];
    if ($image3_e=="")
    {
        $image3=$row['image3'];
    }
    else
    {
        unlink('image/'.$row['image3']);

        $image3 = rand(1,1000000).$_FILES['image3']['name'];
        $path3 = 'image/'.$image3;
        move_uploaded_file($_FILES['image3']['tmp_name'],$path3);
    }


    $sql_update = "update `product` set `name`='$name',`price`='$price',`category`='$category',`tag`='$tag',`type`='$type',`one_line_title`='$one_line_title',`size`='$size',`color`='$color',`description`='$description',`weight`='$weight',`dimension`='$dimension',`material`='$material',`image1`='$image1',`image2`='$image2',`image3`='$image3',`stock`='$stock' where `id`='$edit_id'";
    mysqli_query($conn,$sql_update);

    $sql_update_cart = "update `cart` set `name`='$name',`price`='$price',`image`='$image1' where `product_id`='$edit_id'";
    mysqli_query($conn,$sql_update_cart);

    echo "<script>alert('Data Roti berhasil diperbarui!'); window.location.href='view-more-product.php?v_id=".$row['id']."';</script>";
} 

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Menu Roti</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Edit Produk</li>
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
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Formulir Edit Menu Roti</h3>
              </div>
              <!-- /.card-header -->
              
              <!-- form start -->
              <form method="post" enctype="multipart/form-data">
                <div class="card-body">
                    
                  <div class="form-group">
                    <label>Nama Menu / Roti</label>
                    <input type="text" class="form-control" placeholder="Misal: Roti Sisir Rasa Coklat" name="name" maxlength="40" required value="<?php echo @$row['name']; ?>">
                  </div>

                  <div class="form-group">
                    <label>Harga (Rp)</label>
                    <input type="text" class="form-control" maxlength="50" placeholder="Misal: 15000 (Hanya angka)" name="price" required value="<?php echo @$row['price']; ?>">
                  </div>

                  <div class="form-group">
                    <label>Kategori Roti</label>
                    <select class="form-control" name="category" required>
                      <option disabled>- Pilih Kategori -</option>
                      <option value="roti-manis" <?php if($row['category']=="roti-manis"){echo "selected";} ?>>Roti Manis</option>
                      <option value="roti-gurih" <?php if($row['category']=="roti-gurih"){echo "selected";} ?>>Roti Gurih</option>
                      <option value="kue-pastry" <?php if($row['category']=="kue-pastry"){echo "selected";} ?>>Kue & Pastry</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Tag (Posisi Tampil di Beranda)</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tag[]" value="Best-seller" id="tag1" <?php for($i=0; $i<$tag_length; $i++) { if($tag[$i]=="Best-seller") {echo "checked";} } ?>>
                        <label class="form-check-label" for="tag1">Terlaris (Best Seller)</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tag[]" value="Featured" id="tag2" <?php for($i=0; $i<$tag_length; $i++) { if($tag[$i]=="Featured") {echo "checked";} } ?>>
                        <label class="form-check-label" for="tag2">Rekomendasi (Featured)</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tag[]" value="Sale" id="tag3" <?php for($i=0; $i<$tag_length; $i++) { if($tag[$i]=="Sale") {echo "checked";} } ?>>
                        <label class="form-check-label" for="tag3">Promo Spesial (Sale)</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="tag[]" value="Top-rate" id="tag4" <?php for($i=0; $i<$tag_length; $i++) { if($tag[$i]=="Top-rate") {echo "checked";} } ?>>
                        <label class="form-check-label" for="tag4">Rating Tertinggi (Top Rate)</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Tipe (Metode Masak)</label>
                    <select class="form-control" name="type" required>
                      <option disabled>- Pilih Tipe -</option>
                      <option value="Panggang" <?php if($row['type']=="Panggang"){echo "selected";} ?>>Panggang (Oven)</option>
                      <option value="Goreng" <?php if($row['type']=="Goreng"){echo "selected";} ?>>Goreng</option>
                      <option value="Kukus" <?php if($row['type']=="Kukus"){echo "selected";} ?>>Kukus</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Ukuran Porsi (Size)</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="size[]" value="Mini" id="sz1" <?php for($i=0; $i<$size_length; $i++) { if($size[$i]=="Mini") {echo "checked";} } ?>>
                        <label class="form-check-label" for="sz1">Mini</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="size[]" value="Reguler" id="sz2" <?php for($i=0; $i<$size_length; $i++) { if($size[$i]=="Reguler") {echo "checked";} } ?>>
                        <label class="form-check-label" for="sz2">Reguler</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="size[]" value="Besar" id="sz3" <?php for($i=0; $i<$size_length; $i++) { if($size[$i]=="Besar") {echo "checked";} } ?>>
                        <label class="form-check-label" for="sz3">Besar</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="size[]" value="Loyang/Box" id="sz4" <?php for($i=0; $i<$size_length; $i++) { if($size[$i]=="Loyang/Box") {echo "checked";} } ?>>
                        <label class="form-check-label" for="sz4">Loyang / Box</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Varian Rasa Utama (Color)</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="color[]" value="Original" id="cl1" <?php for($i=0; $i<$color_length; $i++) { if($color[$i]=="Original") {echo "checked";} } ?>>
                        <label class="form-check-label" for="cl1">Original</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="color[]" value="Coklat" id="cl2" <?php for($i=0; $i<$color_length; $i++) { if($color[$i]=="Coklat") {echo "checked";} } ?>>
                        <label class="form-check-label" for="cl2">Coklat</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="color[]" value="Keju" id="cl3" <?php for($i=0; $i<$color_length; $i++) { if($color[$i]=="Keju") {echo "checked";} } ?>>
                        <label class="form-check-label" for="cl3">Keju</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="color[]" value="Daging/Abon" id="cl4" <?php for($i=0; $i<$color_length; $i++) { if($color[$i]=="Daging/Abon") {echo "checked";} } ?>>
                        <label class="form-check-label" for="cl4">Daging / Abon</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="color[]" value="Buah" id="cl5" <?php for($i=0; $i<$color_length; $i++) { if($color[$i]=="Buah") {echo "checked";} } ?>>
                        <label class="form-check-label" for="cl5">Buah-buahan</label>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Slogan / Info Singkat Roti</label>
                    <textarea type="text" class="form-control" placeholder="Masukkan Judul Singkat" name="one_line_title" maxlength="100" required><?php echo $row['one_line_title']; ?></textarea>
                  </div>

                  <div class="form-group">
                    <label>Deskripsi Lengkap Roti</label>
                    <textarea rows="5" type="text" class="form-control" placeholder="Masukkan Deskripsi Lengkap" name="description" maxlength="500" required><?php echo $row['description']; ?></textarea>
                  </div>

                   <div class="form-group">
                    <label>Berat Roti (Gram/KG)</label>
                    <input type="text" class="form-control" placeholder="Misal: 500 gram" name="weight" maxlength="10" required value="<?php echo $row['weight']; ?>">
                  </div>

                  <div class="form-group">
                    <label>Dimensi/Ukuran Roti (CM)</label>
                    <input type="text" class="form-control" placeholder="Misal: 20x10x5 cm" name="dimension" maxlength="20" required value="<?php echo $row['dimension']; ?>">
                  </div>

                  <div class="form-group">
                    <label>Komposisi Utama (Material)</label>
                    <input type="text" class="form-control" placeholder="Misal: Tepung Terigu, Mentega" name="material" maxlength="50" required value="<?php echo $row['material']; ?>">
                  </div>

                  <!-- Pengaturan Gambar -->
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Gambar 1 (Utama)</label>
                            <div class="input-group mb-2">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image1" name="image1">
                                    <label class="custom-file-label" for="image1">Ganti gambar utama</label>
                                </div>
                            </div>
                            <small class="text-muted d-block mb-2">Gambar Saat Ini:</small>
                            <div style="width: 150px; height: 150px; border-radius: 10px; overflow: hidden; border: 1px solid #ddd;">
                                <img src="image/<?php echo $row['image1']; ?>" style="height: 100%; width: 100%; object-fit: cover;">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ketersediaan Stok</label>
                            <select class="form-control" name="stock" required>
                                <option disabled>- Pilih Status Stok -</option>
                                <option value="In Stock" <?php if($row['stock']=="In Stock"){echo "selected";} ?>>Tersedia (In Stock)</option>
                                <option value="Out of Stock" <?php if($row['stock']=="Out of Stock"){echo "selected";} ?>>Habis (Out of Stock)</option>
                            </select>
                        </div>
                    </div>
                  </div>

                  <hr>

                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Gambar 2 (Opsional)</label>
                            <div class="input-group mb-2">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image2" name="image2">
                                    <label class="custom-file-label" for="image2">Ganti gambar 2</label>
                                </div>
                            </div>
                            <small class="text-muted d-block mb-2">Gambar Saat Ini:</small>
                            <div style="width: 150px; height: 150px; border-radius: 10px; overflow: hidden; border: 1px solid #ddd;">
                                <img src="image/<?php echo $row['image2']; ?>" style="height: 100%; width: 100%; object-fit: cover;">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Gambar 3 (Opsional)</label>
                            <div class="input-group mb-2">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image3" name="image3">
                                    <label class="custom-file-label" for="image3">Ganti gambar 3</label>
                                </div>
                            </div>
                            <small class="text-muted d-block mb-2">Gambar Saat Ini:</small>
                            <div style="width: 150px; height: 150px; border-radius: 10px; overflow: hidden; border: 1px solid #ddd;">
                                <img src="image/<?php echo $row['image3']; ?>" style="height: 100%; width: 100%; object-fit: cover;">
                            </div>
                        </div>
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->
           
                <div class="card-footer">
                  <button type="submit" class="btn btn-warning" name="edited_product"><i class="fa fa-save"></i> Perbarui Data Roti</button>
                  <a href="view-more-product.php?v_id=<?php echo $row['id']; ?>" class="btn btn-secondary float-right">Batal</a>
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