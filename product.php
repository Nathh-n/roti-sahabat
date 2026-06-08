<?php include_once 'site_connection.php'; ?>

<header class="header-v4">
<?php include_once 'header.php'; ?>
</header>

<?php 

$_SESSION['short']='default';

$sql_select_data = "select * from `product` where `stock`='In Stock'";
$data_data = mysqli_query($conn,$sql_select_data);
$data_count = mysqli_num_rows($data_data);

$limit = 8;
$page_count = ceil($data_count/$limit);

if (isset($_GET['all_pro_p_id']))
{
	$page_no = $_GET['all_pro_p_id'];
}
else
{
	$page_no=1;
}

$start = ($page_no-1)*$limit;

$previous = $page_no-1;
$next = $page_no+1;


if(isset($_SESSION['short']))
{
	if($_SESSION['short']=='default')
	{
		$sql_select = "select * from `product` where `stock`='In Stock' limit $start,$limit";
		$data = mysqli_query($conn,$sql_select);
	}
	if($_SESSION['short']=='newness')
	{
		$sql_select = "select * from `product` where `stock`='In Stock' order by `id` asc limit $start,$limit";
		$data = mysqli_query($conn,$sql_select);
	}
	if($_SESSION['short']=='low_high')
	{
		$sql_select = "select * from `product` where `stock`='In Stock' order by `price` asc limit $start,$limit";
		$data = mysqli_query($conn,$sql_select);
	}
	if($_SESSION['short']=='high_low')
	{
		$sql_select = "select * from `product` where `stock`='In Stock' order by `price` desc limit $start,$limit";
		$data = mysqli_query($conn,$sql_select);
	}
	
}


if(isset($_GET['search_product']))
{
	$search_pro = $_GET['search_product'];


	$sql_select_data = "select * from `product` where `stock`='In Stock' AND (`name` like '%$search_pro%' OR `category` like '%$search_pro%' OR `tag` like '%$search_pro%' OR `type` like '%$search_pro%' OR `one_line_title` like '%$search_pro%' OR `size` like '%$search_pro%' OR `color` like '%$search_pro%' OR `description` like '%$search_pro%' OR `weight` like '%$search_pro%' OR `dimension` like '%$search_pro%' OR `material` like '%$search_pro%')";
	$data_data = mysqli_query($conn,$sql_select_data);
	$data_count = mysqli_num_rows($data_data);

	$limit = 8;
	$page_count_s = ceil($data_count/$limit);

	if (isset($_GET['all_pro_p_id_s']))
	{
		$page_no = $_GET['all_pro_p_id_s'];
	}
	else
	{
		$page_no=1;
	}

	$start = ($page_no-1)*$limit;

	if(isset($_SESSION['short']))
	{
		if($_SESSION['short']=='default')
		{
			$sql_select = "select * from `product` where `stock`='In Stock' AND (`name` like '%$search_pro%' OR `category` like '%$search_pro%' OR `tag` like '%$search_pro%' OR `type` like '%$search_pro%' OR `one_line_title` like '%$search_pro%' OR `size` like '%$search_pro%' OR `color` like '%$search_pro%' OR `description` like '%$search_pro%' OR `weight` like '%$search_pro%' OR `dimension` like '%$search_pro%' OR `material` like '%$search_pro%') order by `id` asc limit $start,$limit";
			$data = mysqli_query($conn,$sql_select);
		}
		if($_SESSION['short']=='newness')
		{
			$sql_select = "select * from `product` where `stock`='In Stock' AND (`name` like '%$search_pro%' OR `category` like '%$search_pro%' OR `tag` like '%$search_pro%' OR `type` like '%$search_pro%' OR `one_line_title` like '%$search_pro%' OR `size` like '%$search_pro%' OR `color` like '%$search_pro%' OR `description` like '%$search_pro%' OR `weight` like '%$search_pro%' OR `dimension` like '%$search_pro%' OR `material` like '%$search_pro%') order by `price` asc limit $start,$limit";
			$data = mysqli_query($conn,$sql_select);
		}
		if($_SESSION['short']=='low_high')
		{
			$sql_select = "select * from `product` where `stock`='In Stock' AND (`name` like '%$search_pro%' OR `category` like '%$search_pro%' OR `tag` like '%$search_pro%' OR `type` like '%$search_pro%' OR `one_line_title` like '%$search_pro%' OR `size` like '%$search_pro%' OR `color` like '%$search_pro%' OR `description` like '%$search_pro%' OR `weight` like '%$search_pro%' OR `dimension` like '%$search_pro%' OR `material` like '%$search_pro%') limit $start,$limit";
			$data = mysqli_query($conn,$sql_select);
		}
		if($_SESSION['short']=='high_low')
		{
			$sql_select = "select * from `product` where `stock`='In Stock' AND (`name` like '%$search_pro%' OR `category` like '%$search_pro%' OR `tag` like '%$search_pro%' OR `type` like '%$search_pro%' OR `one_line_title` like '%$search_pro%' OR `size` like '%$search_pro%' OR `color` like '%$search_pro%' OR `description` like '%$search_pro%' OR `weight` like '%$search_pro%' OR `dimension` like '%$search_pro%' OR `material` like '%$search_pro%') order by `price` desc limit $start,$limit";
			$data = mysqli_query($conn,$sql_select);
		}
	}

	$previous = $page_no-1;
	$next = $page_no+1;

}

 ?>

<!-- Product -->
<style>
	/* --- KODE REDESAIN KARTU ROTI --- */
	.card-roti {
		border-radius: 20px;
		overflow: hidden;
		box-shadow: 0 8px 25px rgba(0,0,0,0.06);
		transition: transform 0.3s ease, box-shadow 0.3s ease;
		background: #fff;
		padding-bottom: 20px;
		margin-bottom: 30px;
		border: 1px solid #f9f9f9;
		position: relative;
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
	/* Tombol Beli / Pesan Langsung */
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
	<div class="bg0 m-t-23 p-b-140">
		<div class="container">
			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-l-m filter-tope-group m-tb-10">
					
					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
						All products
					</button>

					<a href="women-product.php" class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5">
						Women-Products
					</a>

					<a href="men-product.php" class="stext-106 stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5">
						Men-Products
					</a>

					<a href="accessories-product.php" class="stext-106 stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5">
						Fashion Accessories
					</a>

					<!-- <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".Men">
						Men
					</button>

					<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".Accessories">
						Accessories
					</button> -->
				</div>

				<div class="flex-w flex-c-m m-tb-10">
					<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
						<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
						<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						Search
					</div>
				</div>
				
				<!-- Search product -->
				
				<div class="dis-none panel-search w-full p-t-10 p-b-15">
					
					<div class="bor8 dis-flex p-l-15">
						<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
							<i class="zmdi zmdi-search"></i>
						</button>
					<form method="get">
						<input class="mtext-107 cl2 size-114 plh2 p-r-15 search-product" type="text" name="search_product" placeholder="Search" id="search_product_text">
					</form>
					</div>
					
				</div>


				<!-- Filter -->
				<div class="dis-none panel-filter w-full p-t-10">
					<div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
						<div class="filter-col1 p-r-15 p-b-27">
							<div class="mtext-102 cl2 p-b-15">
								Sort By
							</div>

							<ul>
								<li class="p-b-6">
									<?php 
									if(isset($_GET['search_product']))
									{ ?>
										<a href="product.php?search_product=<?php echo $search_pro; ?>" id="default_s" class="filter-link stext-106 trans-04								
											<?php if($_SESSION['short']=='default'){echo "filter-link-active";} ?>">
												Default
										</a>
									<?php }
									else
									{ ?>
										<a href="product.php" id="default" class="filter-link stext-106 trans-04								
											<?php if($_SESSION['short']=='default'){echo "filter-link-active";} ?>">
												Default
										</a>
									<?php }
									 ?>
								</li>

								<li class="p-b-6">
									<?php 
									if(isset($_GET['search_product']))
									{ ?>
										<a href="javascript:void(0)" attr_id="short" attr_id_s=<?php echo $search_pro; ?> id="newness_s" class="filter-link stext-106 trans-04">
										Newness
										</a>
									<?php }
									else
									{ ?>
										<a href="javascript:void(0)" attr_id="short" id="newness" class="filter-link stext-106 trans-04">
										Newness
										</a>
									<?php }
									 ?>
								</li>

								<li class="p-b-6">
									<?php 
									if(isset($_GET['search_product']))
									{ ?>
										<a href="javascript:void(0)" attr_id="short" attr_id_s="<?php echo $search_pro; ?>" id="low_high_s" class="filter-link stext-106 trans-04 low_high_active">
											Price: Low to High
										</a>
									<?php }
									else
									{ ?>
										<a href="javascript:void(0)" attr_id="short" id="low_high" class="filter-link stext-106 trans-04 low_high_active">
											Price: Low to High
										</a>
									<?php }
									 ?>
								</li>
								
								<li class="p-b-6">
									<?php 
									if(isset($_GET['search_product']))
									{ ?>
										<a href="javascript:void(0)" attr_id="short" attr_id_s=<?php echo $search_pro; ?> id="high_low_s" class="filter-link stext-106 trans-04">
											Price: High to Low
										</a>
									<?php }
									else
									{ ?>
										<a href="javascript:void(0)" attr_id="short" id="high_low" class="filter-link stext-106 trans-04">
											Price: High to Low
										</a>
									<?php }
									 ?>
								</li>
							</ul>
						</div>

					</div>
				</div>
			</div>

			<!-- products -->

	<div id="all_product_page_change_data">
		<div class="row isotope-grid" >

			<?php while ($row = mysqli_fetch_assoc($data)) { ?>	
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
					<div class="card-roti">
						<div class="block2-pic hov-img0">
							<img src="admin/image/<?php echo $row['image1']; ?>" alt="IMG-PRODUCT">
						</div>

						<div class="p-t-14 p-b-10">
							<span class="roti-title">
								<?php echo $row['name']; ?>
							</span>

							<span class="roti-price">
								Rp <?php echo number_format($row['price'], 0, ',', '.'); ?>
							</span>

							<!-- Form Add to Cart Langsung -->
							<!-- Pastikan action dikirim ke script proses keranjang. Jika logic cart_submit ada di index.php, gunakan action="" -->
							<form method="post" action="product.php">
								<!-- Menyimpan data roti yang dipilih secara tersembunyi -->
								<input type="hidden" name="cart_id" value="<?php echo $row['id']; ?>">
								<input type="hidden" name="num_product" value="1">
								
								<!-- Karena toko roti biasanya tidak butuh ukuran baju (S/M/L), kita isi value default atau sembunyikan -->
								<input type="hidden" name="size_select" value="Reguler">
								<input type="hidden" name="color_select" value="Original">
								
								<button type="submit" name="cart_submit" class="btn-pesan-roti">
									+ Pesan
								</button>
							</form>

							<?php if (isset($_GET['search_product'])) { ?>
								<input type="hidden" name="search_txt" value="<?php echo $_GET['search_product']; ?>" id="srch_txt">
							<?php } ?>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>

		<!-- Pagination Statis yang Diperbarui -->
		<div class="flex-l-m flex-w w-full p-t-10 m-lr--7" style="justify-content: center; margin-top: 20px;">
			<style>
				.roti-page-btn {
					width: 40px; height: 40px;
					border-radius: 50%; border: 1px solid #c2185b;
					color: #c2185b; font-family: 'Poppins', sans-serif;
					font-weight: 600; display: flex;
					align-items: center; justify-content: center;
					margin: 0 5px; transition: all 0.3s ease;
					text-decoration: none !important;
				}
				.roti-page-btn:hover, .roti-page-btn.active-page {
					background-color: #c2185b; color: white !important;
					box-shadow: 0 4px 10px rgba(194, 24, 91, 0.3);
				}
				.roti-page-text { padding: 0 15px; border-radius: 20px; width: auto;}
			</style>

			<!-- Tombol Previous (Sebelumnya) -->
			<?php if (isset($_GET['search_product'])) {
				if ($page_no > 1) { ?>
					<a href="product.php?search_product=<?php echo $_GET['search_product']; ?>&all_pro_p_id_s=<?php echo $previous; ?>" class="roti-page-btn roti-page-text">
						Sebelumnya
					</a>
			<?php } 
			} else {
				if ($page_no > 1) { ?>
					<a href="product.php?all_pro_p_id=<?php echo $previous; ?>" class="roti-page-btn roti-page-text">
						Sebelumnya
					</a>
			<?php }
			} ?>

			<!-- Tombol Angka Halaman -->
			<?php 
			if (isset($_GET['search_product'])) {
				for ($i = 1; $i <= $page_count_s; $i++) { 
					$isActive = (isset($_GET['all_pro_p_id_s']) && $_GET['all_pro_p_id_s'] == $i) || (!isset($_GET['all_pro_p_id_s']) && $i == 1) ? 'active-page' : '';
					?>
					<a href="product.php?search_product=<?php echo $_GET['search_product']; ?>&all_pro_p_id_s=<?php echo $i; ?>" class="roti-page-btn <?php echo $isActive; ?>">
						<?php echo $i; ?>
					</a>
				<?php } 
			} else {
				for ($i = 1; $i <= $page_count; $i++) { 
					$isActive = (isset($_GET['all_pro_p_id']) && $_GET['all_pro_p_id'] == $i) || (!isset($_GET['all_pro_p_id']) && $i == 1) ? 'active-page' : '';
					?>
					<a href="product.php?all_pro_p_id=<?php echo $i; ?>" class="roti-page-btn <?php echo $isActive; ?>">
						<?php echo $i; ?>
					</a>
			<?php } 
			} ?>

			<!-- Tombol Next (Selanjutnya) -->
			<?php if (isset($_GET['search_product'])) {
				if ($page_no < $page_count_s) { ?>
					<a href="product.php?search_product=<?php echo $_GET['search_product']; ?>&all_pro_p_id_s=<?php echo $next; ?>" class="roti-page-btn roti-page-text">
						Selanjutnya
					</a>
			<?php } 
			} else {
				if ($page_no < $page_count) { ?>
					<a href="product.php?all_pro_p_id=<?php echo $next; ?>" class="roti-page-btn roti-page-text">
						Selanjutnya
					</a>
			<?php }
			} ?>
		</div>
        
    </div> <!-- Ini penutup div id="all_product_page_change_data" yang sebelumnya hilang -->
</div> <!-- Ini penutup div container yang sebelumnya hilang -->
</div> <!-- Ini penutup div pembungkus utama p-b-140 yang sebelumnya hilang -->

	<?php include_once 'footer.php'; ?>

	<?php include_once 'scripts.php'; ?>
