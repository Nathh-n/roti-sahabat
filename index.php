<?php include_once 'site_connection.php'; include_once 'header.php'; 

$sql_select_slider = "select * from `slider`";
$data_slider = mysqli_query($conn,$sql_select_slider);

$sql_select_product_bs = "select * from `product` where `tag` like '%Best-seller%' AND `stock`='In Stock'";
$data_product_bs = mysqli_query($conn,$sql_select_product_bs);

$sql_select_product_f = "select * from `product` where `tag` like '%Featured%' AND `stock`='In Stock'";
$data_product_f = mysqli_query($conn,$sql_select_product_f);

$sql_select_product_s = "select * from `product` where `tag` like '%Sale%' AND `stock`='In Stock'";
$data_product_s = mysqli_query($conn,$sql_select_product_s);

$sql_select_product_tr = "select * from `product` where `tag` like '%Top-rate%' AND `stock`='In Stock'";
$data_product_tr = mysqli_query($conn,$sql_select_product_tr);

if (isset($_POST['cart_submit'])) {
    if(isset($_SESSION['login'])) {
        $user_id = $_SESSION['login'];
        $cart_id = $_POST['cart_id'];
        $product = $_POST['num_product'];
        $size_p = $_POST['size_select'];
        $color_p = $_POST['color_select'];

        if($product > 0) {
            $sql_select = "select * from `product` where `id`='$cart_id'";
            $data_p = mysqli_query($conn, $sql_select);
            $row_p = mysqli_fetch_assoc($data_p);

            $sql_select_c = "select * from `cart` where `product_id`='$cart_id' AND `user_id`='$user_id'";
            $data_c = mysqli_query($conn, $sql_select_c);
            $row_count = mysqli_num_rows($data_c);
            $row_data = mysqli_fetch_assoc($data_c);

            $product_id = $cart_id;
            $name = $row_p['name'];
            $price = $row_p['price'];
            $num_product = $product;
            $image = $row_p['image1'];
            $size = $size_p;
            $color = $color_p;

            if($row_count > 0) {
                $new_price = $price;
                $new_num_product = $num_product + $row_data['num_product'];
                $sql_update = "update `cart` set `price`='$new_price',`num_product`='$new_num_product' where `product_id`='$product_id' AND `user_id`='$user_id'";
                mysqli_query($conn, $sql_update);
            } else {
                $sql_insert = "insert into `cart`(`user_id`,`product_id`,`name`,`price`,`num_product`,`image`,`size`,`color`)values('$user_id','$product_id','$name','$price','$num_product','$image','$size','$color')";
                mysqli_query($conn, $sql_insert);
            }
            
            echo "<script>alert('Berhasil! Roti telah dimasukkan ke keranjang.'); window.location.href='index.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Silakan login terlebih dahulu untuk memesan roti!'); window.location.href='login.php';</script>";
        exit();
    }
}
?>

<?php
	if (isset($_POST['submit_msg'])) {
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$msg = mysqli_real_escape_string($conn, $_POST['msg']);
		date_default_timezone_set('Asia/Jakarta');
		$time = date('Y-m-d H:i:s');

		$sql_insert = "insert into `contact_us`(`name`,`email`,`msg`,`time`)values('$name','$email','$msg','$time')";
		mysqli_query($conn, $sql_insert);
		
		// Munculkan notifikasi popup jika pesan berhasil dikirim
		echo "<script>alert('Terima kasih! Pesan Sahabat telah berhasil dikirim.');</script>";
	}
	?>

	<!-- Slider -->
	<style>
		/* --- KODE LAMA UNTUK SLIDER BAWAAN (Bisa dibiarkan) --- */
		.bg-pink-ungu {
			background: linear-gradient(135deg, #ffd6f0, #f3c4ff, #d9b3ff) !important;
			min-height:700px;
		}
		.bulat-besar {
			width: 350px; height: 350px; border-radius: 50%;
			border: 8px solid white; overflow: hidden;
			box-shadow: 0 10px 20px rgba(0,0,0,0.3); margin: 0 auto 20px auto;
		}
		.bulat-besar img, .bulat-kecil img { width: 100%; height: 100%; object-fit: cover; }
		.bulat-kecil {
			width: 150px; height: 150px; border-radius: 50%;
			border: 6px solid white; overflow: hidden;
			box-shadow: 0 5px 15px rgba(0,0,0,0.2); margin: 15px auto;
		}

		/* --- KODE BARU UNTUK HERO SECTION ROTI SAHABAT --- */
		.hero-roti {
			/* Gradasi putih pekat di kiri, transparan di kanan untuk menonjolkan teks */
			background: linear-gradient(to right, rgba(255,255,255,0.95) 0%, rgba(255,255,255,0.7) 45%, rgba(255,255,255,0) 100%), url('images/hero-section.png');
			background-size: cover;
			background-position: center;
			background-repeat: no-repeat;
			min-height: 750px; /* Sedikit dipertinggi agar lebih lega */
			display: flex;
			align-items: center;
		}

		.hero-badge {
			display: inline-block;
			background: #ffe3e3;
			color: #c2185b;
			padding: 8px 20px;
			border-radius: 50px;
			font-family: 'Poppins', sans-serif;
			font-weight: 600;
			font-size: 13px;
			letter-spacing: 1.5px;
			text-transform: uppercase;
			margin-bottom: 25px;
		}

		.hero-title {
			font-family: 'Playfair Display', serif; /* Font elegan bawaan tema */
			font-size: 70px;
			font-weight: 900;
			color: #2b003a; /* Ungu sangat gelap hampir hitam agar kontras */
			line-height: 1.1;
			margin-bottom: 15px;
			text-transform: uppercase;
		}

		.hero-subtitle {
			font-family: 'Poppins', sans-serif;
			color: #c2185b;
			font-size: 22px;
			font-weight: 500;
			letter-spacing: 1px;
		}

		.hero-desc {
			font-family: 'Poppins', sans-serif;
			font-size: 16px;
			color: #555;
			line-height: 1.8;
			max-width: 450px;
			margin-top: 15px;
			margin-bottom: 40px;
		}

		.hero-btn-group {
			display: flex;
			gap: 15px;
			flex-wrap: wrap;
		}

		.hero-btn-primary {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			background: #c2185b;
			color: white !important;
			padding: 0 35px;
			height: 50px;
			border-radius: 50px;
			font-family: 'Poppins', sans-serif;
			font-weight: 600;
			text-transform: uppercase;
			font-size: 14px;
			letter-spacing: 1px;
			box-shadow: 0 8px 20px rgba(194, 24, 91, 0.3);
			transition: all 0.3s ease;
		}

		.hero-btn-primary:hover {
			background: #ad1457;
			transform: translateY(-3px);
			box-shadow: 0 12px 25px rgba(194, 24, 91, 0.4);
		}

		.hero-btn-secondary {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			background: transparent;
			color: #2b003a !important;
			border: 2px solid #2b003a;
			padding: 0 35px;
			height: 50px;
			border-radius: 50px;
			font-family: 'Poppins', sans-serif;
			font-weight: 600;
			text-transform: uppercase;
			font-size: 14px;
			letter-spacing: 1px;
			transition: all 0.3s ease;
		}

		.hero-btn-secondary:hover {
			background: #2b003a;
			color: white !important;
			transform: translateY(-3px);
		}

		.roti-tabs {
			border-bottom: none;
			justify-content: center;
			gap: 15px;
			margin-bottom: 20px;
		}
		.roti-tabs .nav-link {
			border: none !important;
			background-color: #f0f0f0;
			color: #555;
			border-radius: 50px;
			padding: 10px 30px;
			font-family: 'Poppins', sans-serif;
			font-weight: 600;
			transition: all 0.3s ease;
		}
		.roti-tabs .nav-link.active {
			background: linear-gradient(135deg, #c2185b, #800080);
			color: white !important;
			box-shadow: 0 5px 15px rgba(194, 24, 91, 0.4);
		}
		.card-roti {
			border-radius: 20px;
			overflow: hidden;
			box-shadow: 0 8px 25px rgba(0,0,0,0.06);
			transition: transform 0.3s ease, box-shadow 0.3s ease;
			background: #fff;
			padding-bottom: 20px;
			margin: 10px;
			border: 1px solid #f9f9f9;
		}
		.card-roti:hover {
			transform: translateY(-8px);
			box-shadow: 0 15px 35px rgba(128, 0, 128, 0.15);
		}
		.card-roti .block2-pic img {
			height: 250px;
			object-fit: cover;
			width: 100%;
		}
		.roti-title {
			font-family: 'Playfair Display', serif;
			font-weight: 800;
			font-size: 20px;
			color: #2b003a;
			text-align: center;
			margin-top: 15px;
			display: block;
		}
		.roti-price {
			font-family: 'Poppins', sans-serif;
			color: #c2185b;
			font-weight: 700;
			font-size: 18px;
			text-align: center;
			display: block;
			margin-top: 5px;
		}
		.btn-detail-roti {
			display: block;
			width: 70%;
			margin: 15px auto 0;
			text-align: center;
			border: 2px solid #800080;
			color: #800080;
			border-radius: 30px;
			padding: 8px 0;
			font-family: 'Poppins', sans-serif;
			font-weight: 600;
			font-size: 14px;
			transition: all 0.3s ease;
		}
		.btn-detail-roti:hover {
			background: #800080;
			color: white;
		}

		.sec-contact-home {
			background-color: #fffafb; /* Latar pink sangat memudar agar lembut */
			padding: 80px 0;
			border-top: 2px dashed #fce4ec;
		}
		.contact-box {
			background: #fff;
			border-radius: 20px;
			box-shadow: 0 15px 40px rgba(128, 0, 128, 0.08);
			overflow: hidden;
		}
		.contact-info-bg {
			background: linear-gradient(135deg, #c2185b, #800080);
			padding: 60px 40px;
			color: white;
			height: 100%;
			display: flex;
			flex-direction: column;
			justify-content: center;
		}
		.contact-info-bg h4 {
			font-family: 'Playfair Display', serif;
			font-size: 32px;
			font-weight: 700;
			margin-bottom: 20px;
			color: white;
		}
		.contact-info-bg p {
			font-family: 'Poppins', sans-serif;
			font-size: 15px;
			color: rgba(255,255,255,0.8);
			margin-bottom: 40px;
			line-height: 1.8;
		}
		.info-item {
			display: flex;
			align-items: center;
			margin-bottom: 25px;
		}
		.info-item i {
			font-size: 24px;
			margin-right: 20px;
			color: #ffb6c1;
			width: 30px;
			text-align: center;
		}
		.info-item span {
			font-family: 'Poppins', sans-serif;
			font-size: 15px;
			color: white;
		}
		.contact-form-wrap {
			padding: 60px 40px;
		}
		.contact-form-wrap h4 {
			font-family: 'Playfair Display', serif;
			font-size: 28px;
			font-weight: 700;
			color: #2b003a;
			margin-bottom: 10px;
		}
		.contact-form-wrap p {
			font-family: 'Poppins', sans-serif;
			font-size: 14px;
			color: #888;
			margin-bottom: 30px;
		}
		.input-custom {
			width: 100%;
			background: #f9f9f9;
			border: 1px solid #eee;
			border-radius: 10px;
			padding: 15px 20px;
			font-family: 'Poppins', sans-serif;
			font-size: 14px;
			margin-bottom: 20px;
			transition: all 0.3s;
		}
		.input-custom:focus {
			border-color: #c2185b;
			background: #fff;
			box-shadow: 0 0 10px rgba(194, 24, 91, 0.1);
		}
		textarea.input-custom {
			min-height: 120px;
			resize: none;
		}
		.btn-kirim {
			background: #2b003a;
			color: white !important;
			border: none;
			border-radius: 30px;
			padding: 15px 40px;
			font-family: 'Poppins', sans-serif;
			font-weight: 600;
			font-size: 15px;
			text-transform: uppercase;
			letter-spacing: 1px;
			transition: all 0.3s ease;
			cursor: pointer;
			display: inline-block;
			width: auto;
		}
		.btn-kirim:hover {
			background: #c2185b;
			transform: translateY(-3px);
			box-shadow: 0 10px 20px rgba(194, 24, 91, 0.3);
		}

		.roti-tabs {
			border-bottom: none;
			justify-content: center;
			gap: 15px;
			margin-bottom: 20px;
		}
		.roti-tabs .nav-link {
			border: none !important;
			background-color: #f0f0f0;
			color: #555;
			border-radius: 50px;
			padding: 10px 30px;
			font-family: 'Poppins', sans-serif;
			font-weight: 600;
			transition: all 0.3s ease;
		}
		.roti-tabs .nav-link.active {
			background: linear-gradient(135deg, #c2185b, #800080);
			color: white !important;
			box-shadow: 0 5px 15px rgba(194, 24, 91, 0.4);
		}
		.card-roti {
			border-radius: 20px;
			overflow: hidden;
			box-shadow: 0 8px 25px rgba(0,0,0,0.06);
			transition: transform 0.3s ease, box-shadow 0.3s ease;
			background: #fff;
			padding-bottom: 20px;
			margin: 10px;
			border: 1px solid #f9f9f9;
		}
		.card-roti:hover {
			transform: translateY(-8px);
			box-shadow: 0 15px 35px rgba(128, 0, 128, 0.15);
		}
		.card-roti .block2-pic img {
			height: 250px;
			object-fit: cover;
			width: 100%;
		}
		.roti-title {
			font-family: 'Playfair Display', serif;
			font-weight: 800;
			font-size: 20px;
			color: #2b003a;
			text-align: center;
			margin-top: 15px;
			display: block;
		}
		.roti-price {
			font-family: 'Poppins', sans-serif;
			color: #c2185b;
			font-weight: 700;
			font-size: 18px;
			text-align: center;
			display: block;
			margin-top: 5px;
		}
		.btn-pesan-roti {
			display: block;
			width: 80%;
			margin: 15px auto 0;
			text-align: center;
			background: #c2185b;
			color: white !important;
			border-radius: 30px;
			padding: 10px 0;
			font-family: 'Poppins', sans-serif;
			font-weight: 600;
			font-size: 14px;
			text-transform: uppercase;
			letter-spacing: 1px;
			transition: all 0.3s ease;
			border: none;
			cursor: pointer;
		}
		.btn-pesan-roti:hover {
			background: #800080;
			box-shadow: 0 5px 15px rgba(128,0,128,0.3);
			transform: translateY(-2px);
		}
	</style>

	<section class="hero-roti">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-7 col-lg-6"> 
					
					<!-- Class animasi dihapus, teks akan langsung muncul -->
					<div>
						<span class="hero-badge">
							Roti Fresh Setiap Hari
						</span>
					</div>

					<div>
						<h1 class="hero-title">
							Roti Sahabat
						</h1>
						<p class="hero-subtitle">
							Freshly Baked Every Day
						</p>
						<p class="hero-desc">
							Roti, donat, pastry dan cake premium yang dipanggang fresh setiap hari dengan bahan-bahan pilihan terbaik.
						</p>
					</div>

					<div>
						<div class="hero-btn-group">
							<a href="product.php" class="hero-btn-primary">
								Lihat Menu
							</a>
							<a href="shoping-cart.php" class="hero-btn-secondary">
								Pesan Sekarang
							</a>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>


	<!-- Banner -->
	<div class="sec-banner bg0 p-t-80 p-b-50">
		<div class="container">
			<div class="row">
				
				<div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
					<div class="block1 wrap-pic-w banner-roti">
						<img src="images/gambar roti 2.png" alt="Roti Manis">

						<a href="product.php" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									Roti Manis
								</span>
								<span class="block1-info stext-102 trans-04">
									Favorit Keluarga
								</span>
							</div>
							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
									Lihat Menu
								</div>
							</div>
						</a>
					</div>
				</div>

				<div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
					<div class="block1 wrap-pic-w banner-roti">
						<img src="images/gambar roti 1.png" alt="Roti Gurih">

						<a href="product.php" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									Roti Gurih
								</span>
								<span class="block1-info stext-102 trans-04">
									Pilihan Tepat
								</span>
							</div>
							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
									Lihat Menu
								</div>
							</div>
						</a>
					</div>
				</div>

				<div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
					<div class="block1 wrap-pic-w banner-roti">
						<img src="images/gambar roti 3.png" alt="Kue & Pastry">

						<a href="product.php" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									Kue & Pastry
								</span>
								<span class="block1-info stext-102 trans-04">
									Rasa Premium
								</span>
							</div>
							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
									Lihat Menu
								</div>
							</div>
						</a>
					</div>
				</div>

			</div>
		</div>
	</div>


	<!-- Product -->
	<section class="sec-product bg0 p-t-100 p-b-50">
		<div class="container">
			<div class="p-b-32">
				<h3 class="ltext-105 cl5 txt-center respon1" style="font-family: 'Playfair Display', serif; color: #2b003a; font-weight: 900;">
					Menu Favorit Sahabat
				</h3>
			</div>

			<div class="tab01">
				<ul class="nav nav-tabs roti-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#Best-seller" role="tab">Terlaris</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#Featured" role="tab">Rekomendasi</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#Sale" role="tab">Promo Spesial</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#Top-rate" role="tab">Rating Tertinggi</a>
					</li>
				</ul>

				<div class="tab-content p-t-30">
					
					<div class="tab-pane fade show active" id="Best-seller" role="tabpanel">
						<div class="wrap-slick2">
							<div class="slick2">
								<?php while ($row = mysqli_fetch_assoc($data_product_bs)) { ?>
									<div class="item-slick2 p-l-5 p-r-5 p-t-15 p-b-15">
										<div class="card-roti">
											<div class="block2-pic hov-img0">
												<img src="admin/image/<?php echo $row['image1']; ?>" alt="IMG-PRODUCT">
											</div>
											<div class="p-t-14 p-b-10 text-center">
												<span class="roti-title"><?php echo $row['name']; ?></span>
												<span class="roti-price">Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></span>
												<form method="post" action="">
													<input type="hidden" name="cart_id" value="<?php echo $row['id']; ?>">
													<input type="hidden" name="num_product" value="1">
													<input type="hidden" name="size_select" value="Reguler">
													<input type="hidden" name="color_select" value="Original">
													<button type="submit" name="cart_submit" class="btn-pesan-roti">+ Pesan</button>
												</form>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>

					<div class="tab-pane fade" id="Featured" role="tabpanel">
						<div class="wrap-slick2">
							<div class="slick2">
								<?php while ($row = mysqli_fetch_assoc($data_product_f)) { ?>
									<div class="item-slick2 p-l-5 p-r-5 p-t-15 p-b-15">
										<div class="card-roti">
											<div class="block2-pic hov-img0">
												<img src="admin/image/<?php echo $row['image1']; ?>" alt="IMG-PRODUCT">
											</div>
											<div class="p-t-14 p-b-10 text-center">
												<span class="roti-title"><?php echo $row['name']; ?></span>
												<span class="roti-price">Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></span>
												<form method="post" action="">
													<input type="hidden" name="cart_id" value="<?php echo $row['id']; ?>">
													<input type="hidden" name="num_product" value="1">
													<input type="hidden" name="size_select" value="Reguler">
													<input type="hidden" name="color_select" value="Original">
													<button type="submit" name="cart_submit" class="btn-pesan-roti">+ Pesan</button>
												</form>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>

					<div class="tab-pane fade" id="Sale" role="tabpanel">
						<div class="wrap-slick2">
							<div class="slick2">
								<?php while ($row = mysqli_fetch_assoc($data_product_s)) { ?>
									<div class="item-slick2 p-l-5 p-r-5 p-t-15 p-b-15">
										<div class="card-roti">
											<div class="block2-pic hov-img0">
												<img src="admin/image/<?php echo $row['image1']; ?>" alt="IMG-PRODUCT">
											</div>
											<div class="p-t-14 p-b-10 text-center">
												<span class="roti-title"><?php echo $row['name']; ?></span>
												<span class="roti-price">Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></span>
												<form method="post" action="">
													<input type="hidden" name="cart_id" value="<?php echo $row['id']; ?>">
													<input type="hidden" name="num_product" value="1">
													<input type="hidden" name="size_select" value="Reguler">
													<input type="hidden" name="color_select" value="Original">
													<button type="submit" name="cart_submit" class="btn-pesan-roti">+ Pesan</button>
												</form>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>

					<div class="tab-pane fade" id="Top-rate" role="tabpanel">
						<div class="wrap-slick2">
							<div class="slick2">
								<?php while ($row = mysqli_fetch_assoc($data_product_tr)) { ?>
									<div class="item-slick2 p-l-5 p-r-5 p-t-15 p-b-15">
										<div class="card-roti">
											<div class="block2-pic hov-img0">
												<img src="admin/image/<?php echo $row['image1']; ?>" alt="IMG-PRODUCT">
											</div>
											<div class="p-t-14 p-b-10 text-center">
												<span class="roti-title"><?php echo $row['name']; ?></span>
												<span class="roti-price">Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></span>
												<form method="post" action="">
													<input type="hidden" name="cart_id" value="<?php echo $row['id']; ?>">
													<input type="hidden" name="num_product" value="1">
													<input type="hidden" name="size_select" value="Reguler">
													<input type="hidden" name="color_select" value="Original">
													<button type="submit" name="cart_submit" class="btn-pesan-roti">+ Pesan</button>
												</form>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="flex-c-m flex-w w-full p-t-45">
			<a href="product.php" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04" style="border-radius: 30px;">
				Lihat Semua Menu
			</a>
		</div>
	</section>

	<section class="sec-contact-home">
		<div class="container">
			<div class="contact-box">
				<div class="row m-0">
					
					<div class="col-md-5 p-0">
						<div class="contact-info-bg">
							<h4>Mari Terhubung</h4>
							<p>Punya pertanyaan seputar varian roti, pesanan dalam jumlah besar untuk acara, atau sekadar ingin menyapa? Jangan ragu untuk menghubungi kami.</p>
							
							<div class="info-item">
								<i class="fa fa-map-marker"></i>
								<span>Jl. Roti Manis No. 123, Bandung</span>
							</div>
							<div class="info-item">
								<i class="fa fa-phone"></i>
								<span>+62 812-3456-7890</span>
							</div>
							<div class="info-item">
								<i class="fa fa-envelope"></i>
								<span>halo@rotisahabat.com</span>
							</div>
						</div>
					</div>

					<div class="col-md-7 p-0">
						<div class="contact-form-wrap">
							<h4>Kirim Pesan</h4>
							<p>Isi formulir di bawah ini dan tim kami akan segera membalas pesanmu.</p>
							
							<form method="post" action="">
								<div class="row">
									<div class="col-sm-6">
										<input class="input-custom" type="text" name="name" placeholder="Nama Lengkap" required>
									</div>
									<div class="col-sm-6">
										<input class="input-custom" type="email" name="email" placeholder="Alamat Email" required>
									</div>
								</div>
								
								<textarea class="input-custom" name="msg" placeholder="Tulis pesanmu di sini..." required></textarea>
								
								<button type="submit" name="submit_msg" class="btn-kirim">
									Kirim Pesan
								</button>
							</form>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>


	<?php include_once 'footer.php'; ?>


	<!-- Modal1 -->
	<!-- <div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
		<div class="overlay-modal1 js-hide-modal1"></div>

		<div class="container">
			<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
				<button class="how-pos3 hov3 trans-04 js-hide-modal1">
					<img src="images/icons/icon-close.png" alt="CLOSE">
				</button>

				<div class="row">
					<div class="col-md-6 col-lg-7 p-b-30">
						<div class="p-l-25 p-r-30 p-lr-0-lg">
							<div class="wrap-slick3 flex-sb flex-w">
								<div class="wrap-slick3-dots"></div>
								<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

								<div class="slick3 gallery-lb">
									<div class="item-slick3" data-thumb="images/product-detail-01.jpg">
										<div class="wrap-pic-w pos-relative">
											<img src="images/product-detail-01.jpg" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-01.jpg">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>

									<div class="item-slick3" data-thumb="images/product-detail-02.jpg">
										<div class="wrap-pic-w pos-relative">
											<img src="images/product-detail-02.jpg" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-02.jpg">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>

									<div class="item-slick3" data-thumb="images/product-detail-03.jpg">
										<div class="wrap-pic-w pos-relative">
											<img src="images/product-detail-03.jpg" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-03.jpg">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-6 col-lg-5 p-b-30">
						<div class="p-r-50 p-t-5 p-lr-0-lg">
							<h4 class="mtext-105 cl2 js-name-detail p-b-14">
								Lightweight Jacket
							</h4>

							<span class="mtext-106 cl2">
								$58.79
							</span>

							<p class="stext-102 cl3 p-t-23">
								Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.
							</p>
							

							<div class="p-t-33">
								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Size
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2" name="time">
												<option>Choose an option</option>
												<option>Size S</option>
												<option>Size M</option>
												<option>Size L</option>
												<option>Size XL</option>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Color
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2" name="time">
												<option>Choose an option</option>
												<option>Red</option>
												<option>Blue</option>
												<option>White</option>
												<option>Grey</option>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-204 flex-w flex-m respon6-next">
										<div class="wrap-num-product flex-w m-r-20 m-tb-10">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>

										<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
											Add to cart
										</button>
									</div>
								</div>	
							</div>


							<div class="flex-w flex-m p-l-100 p-t-40 respon7">
								<div class="flex-m bor9 p-r-10 m-r-11">
									<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
										<i class="zmdi zmdi-favorite"></i>
									</a>
								</div>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
									<i class="fa fa-facebook"></i>
								</a>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
									<i class="fa fa-twitter"></i>
								</a>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
									<i class="fa fa-google-plus"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> -->


	<?php include_once 'scripts.php'; ?>