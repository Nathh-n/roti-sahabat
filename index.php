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

$sql_select_blog = "select * from `blog`";
$data_blog = mysqli_query($conn,$sql_select_blog);

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
				<h3 class="ltext-105 cl5 txt-center respon1">
					Store Overview
				</h3>
			</div>

			<!-- Tab01 -->
			<div class="tab01">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item p-b-10">
						<a class="nav-link active" data-toggle="tab" href="#Best-seller" role="tab">Best Seller</a>
					</li>

					<li class="nav-item p-b-10">
						<a class="nav-link" data-toggle="tab" href="#Featured" role="tab">Featured</a>
					</li>

					<li class="nav-item p-b-10">
						<a class="nav-link" data-toggle="tab" href="#Sale" role="tab">Sale</a>
					</li>

					<li class="nav-item p-b-10">
						<a class="nav-link" data-toggle="tab" href="#Top-rate" role="tab">Top Rate</a>
					</li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content p-t-50">
					<!-- - -->
					<div class="tab-pane fade show active" id="Best-seller" role="tabpanel">
						<!-- Slide2 -->
						<div class="wrap-slick2">
							<div class="slick2">


						<?php while ($row = mysqli_fetch_assoc($data_product_bs)) { ?>
							
								<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
									<!-- Block2 -->
									<div class="block2">
										<div class="block2-pic hov-img0">
											<img src="admin/image/<?php echo $row['image1']; ?>" alt="IMG-PRODUCT">

											<!-- <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
												Quick View
											</a> -->
										</div>

										<div class="block2-txt flex-w flex-t p-t-14">
											<div class="block2-txt-child1 flex-col-l ">
												<a href="product-detail.php?detail_id=<?php echo $row['id']; ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
													<?php echo $row['name']; ?>
												</a>

												<span class="stext-105 cl3">
													Rs.<?php echo $row['price']; ?>
												</span>
											</div>

											<div class="block2-txt-child2 flex-r p-t-3">
												<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
													<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
													<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
												</a>
											</div>
										</div>
									</div>
								</div>

						<?php } ?>
								
							</div>
						</div>
					</div>

					<!-- - -->
					<div class="tab-pane fade" id="Featured" role="tabpanel">
						<!-- Slide2 -->
						<div class="wrap-slick2">
							<div class="slick2">

						<?php while ($row = mysqli_fetch_assoc($data_product_f)) { ?>
								<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
									<!-- Block2 -->
									<div class="block2">
										<div class="block2-pic hov-img0">
											<img src="admin/image/<?php echo $row['image1']; ?>" alt="IMG-PRODUCT">

											<!-- <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
												Quick View
											</a> -->
										</div>

										<div class="block2-txt flex-w flex-t p-t-14">
											<div class="block2-txt-child1 flex-col-l ">
												<a href="product-detail.php?detail_id=<?php echo $row['id']; ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
													<?php echo $row['name']; ?>
												</a>

												<span class="stext-105 cl3">
													Rs.<?php echo $row['price']; ?>
												</span>
											</div>

											<div class="block2-txt-child2 flex-r p-t-3">
												<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
													<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
													<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
												</a>
											</div>
										</div>
									</div>
								</div>
						<?php } ?>
							</div>
						</div>
					</div>

					<!-- - -->
					<div class="tab-pane fade" id="Sale" role="tabpanel">
						<!-- Slide2 -->
						<div class="wrap-slick2">
							<div class="slick2">

						<?php while ($row = mysqli_fetch_assoc($data_product_s)) { ?>
								<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
									<!-- Block2 -->
									<div class="block2">
										<div class="block2-pic hov-img0">
											<img src="admin/image/<?php echo $row['image1']; ?>" alt="IMG-PRODUCT">

											<!-- <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
												Quick View
											</a> -->
										</div>

										<div class="block2-txt flex-w flex-t p-t-14">
											<div class="block2-txt-child1 flex-col-l ">
												<a href="product-detail.php?detail_id=<?php echo $row['id']; ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
													<?php echo $row['name']; ?>
												</a>

												<span class="stext-105 cl3">
													Rs.<?php echo $row['price']; ?>
												</span>
											</div>

											<div class="block2-txt-child2 flex-r p-t-3">
												<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
													<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
													<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
												</a>
											</div>
										</div>
									</div>
								</div>
						<?php } ?>

							</div>
						</div>
					</div>

					<!-- - -->
					<div class="tab-pane fade" id="Top-rate" role="tabpanel">
						<!-- Slide2 -->
						<div class="wrap-slick2">
							<div class="slick2">

						<?php while ($row = mysqli_fetch_assoc($data_product_tr)) { ?>
								<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
									<!-- Block2 -->
									<div class="block2">
										<div class="block2-pic hov-img0">
											<img src="admin/image/<?php echo $row['image1']; ?>" alt="IMG-PRODUCT">

											<!-- <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
												Quick View
											</a> -->
										</div>

										<div class="block2-txt flex-w flex-t p-t-14">
											<div class="block2-txt-child1 flex-col-l ">
												<a href="product-detail.php?detail_id=<?php echo $row['id']; ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
													<?php echo $row['name']; ?>
												</a>

												<span class="stext-105 cl3">
													Rs.<?php echo $row['price']; ?>
												</span>
											</div>

											<div class="block2-txt-child2 flex-r p-t-3">
												<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
													<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
													<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
												</a>
											</div>
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

		<!-- Load more -->
			<div class="flex-c-m flex-w w-full p-t-45">
				<a href="product.php" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
					Load All Products
				</a>
			</div>
	</section>

	<!-- Blog -->
	<section class="sec-blog bg0 p-t-60 p-b-90">
		<div class="container">
			<div class="p-b-66">
				<h3 class="ltext-105 cl5 txt-center respon1">
					Our Blogs
				</h3>
			</div>

			<div class="row">
		<?php $count=0; while ($row = mysqli_fetch_assoc($data_blog)) { ?>
				<div class="col-sm-6 col-md-4 p-b-40">
					<div class="blog-item">
						<div class="hov-img0">
							<a href="blog-detail.php?detail_id=<?php echo $row['id']; ?>">
								<img src="admin/image/<?php echo $row['image']; ?>" alt="IMG-BLOG">
							</a>
						</div>

						<div class="p-t-15">
							<div class="stext-107 flex-w p-b-14">
								<span class="m-r-3">
									<span class="cl4">
										By
									</span>

									<span class="cl5">
										Admin
									</span>
								</span>

								<span>
									<span class="cl4">
										on
									</span>

									<span class="cl5">
										<?php echo $row['day']; ?> <?php echo $row['month']; ?>, <?php echo $row['year']; ?>
									</span>
								</span>
							</div>

							<h4 class="p-b-12">
								<a href="blog-detail.php?detail_id=<?php echo $row['id']; ?>" class="mtext-101 cl2 hov-cl1 trans-04">
									<?php echo $row['title']; ?>
								</a>
							</h4>

							<p class="stext-108 cl6">
								<?php echo $row['short_detail']; ?>
							</p>
						</div>
					</div>
				</div>
		<?php 
				$count++;
				if($count == 3)
				{
					break;
				}

	} ?>
			</div>
		</div>

		<!-- Load more -->
			<div class="flex-c-m flex-w w-full p-t-45">
				<a href="blog.php" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
					Load More Blogs
				</a>
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