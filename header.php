<?php include_once 'site_connection.php';

if(isset($_SESSION['login']))
{
$login_id = $_SESSION['login'];
$sql_select_login = "select * from `user_register` where `id`='$login_id'";
$data_login = mysqli_query($conn,$sql_select_login);
$row_login = mysqli_fetch_assoc($data_login);

$sql_select_cart = "select * from `cart` where `user_id`='$login_id'";
$data_cart = mysqli_query($conn,$sql_select_cart);

$amt_total = "select * from `cart` where `user_id`='$login_id'";
$data_total = mysqli_query($conn,$amt_total);

$total_price = 0;
while($row_total = mysqli_fetch_assoc($data_total))
{
	$total_price = $total_price + $row_total['price'] * $row_total['num_product'];
}

$data_count = mysqli_num_rows($data_total);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="images/icons/favicon.png"/>
<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
<link rel="stylesheet" type="text/css" href="vendor/MagnificPopup/magnific-popup.css">
<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main_css.css">
</head>
<body class="animsition">
	
	<header>
		<div class="container-menu-desktop">
			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop container">
					
					<a href="index.php" class="logo">
						<img src="images/icons/logo roti sahabat.png" alt="IMG-LOGO" style="max-height: 80px; width: auto;">
					</a>

					<div class="menu-desktop">
						<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
						<ul class="main-menu">
							<li class="<?php echo ($current_page == 'index.php' || $current_page == '') ? 'active-menu' : ''; ?>">
								<a href="index.php">Beranda</a>
							</li>
							<li class="<?php echo ($current_page == 'product.php' || $current_page == 'product-detail.php') ? 'active-menu' : ''; ?>">
								<a href="product.php">Menu Kami</a>
							</li>
							<li class="<?php echo ($current_page == 'about.php') ? 'active-menu' : ''; ?>">
								<a href="about.php">Tentang Kami</a>
							</li>
							<li class="<?php echo ($current_page == 'contact.php') ? 'active-menu' : ''; ?>">
								<a href="contact.php">Kontak Kami</a>
							</li>
						</ul>
					</div>	

					<div class="wrap-icon-header flex-w flex-r-m">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
							<i class="zmdi zmdi-search"></i>
						</div>

						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="<?php echo isset($data_count) ? $data_count : '0'; ?>">
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>

						<div class="flex-w flex-m p-l-20" style="font-family: 'Poppins', sans-serif; font-size: 14px;">
							<?php if (isset($_SESSION['login'])) { ?>
								<a href="my_profile.php" class="cl2 hov-cl1 trans-04 p-lr-10 font-weight-bold">
									<i class="zmdi zmdi-account m-r-4"></i> Profil
								</a>
								<span class="cl2">|</span>
								<a href="logout.php" class="cl2 hov-cl1 trans-04 p-lr-10">
									Logout
								</a>
							<?php } else { ?>
								<a href="login.php" class="cl2 hov-cl1 trans-04 p-lr-10 font-weight-bold">
									Login
								</a>
								<span class="cl2">|</span>
								<a href="register.php" class="cl2 hov-cl1 trans-04 p-lr-10">
									Sign Up
								</a>
							<?php } ?>
						</div>
					</div>
				</nav>
			</div>	
		</div>

		<div class="wrap-header-mobile">
			<div class="logo-mobile">
				<a href="index.php"><img src="images/icons/logo roti sahabat.png" alt="IMG-LOGO"></a>
			</div>

			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>

				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="<?php echo isset($data_count) ? $data_count : '0'; ?>">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>
			</div>

			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>

		<div class="menu-mobile">
			<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
			<ul class="main-menu-m">
				<li class="<?php echo ($current_page == 'index.php' || $current_page == '') ? 'active-menu' : ''; ?>">
					<a href="index.php">Beranda</a>
				</li>
				<li class="<?php echo ($current_page == 'product.php' || $current_page == 'product-detail.php') ? 'active-menu' : ''; ?>">
					<a href="product.php">Menu Kami</a>
				</li>
				<li class="<?php echo ($current_page == 'about.php') ? 'active-menu' : ''; ?>">
					<a href="about.php">Tentang Kami</a>
				</li>
				<li class="<?php echo ($current_page == 'contact.php') ? 'active-menu' : ''; ?>">
					<a href="contact.php">Kontak Kami</a>
				</li>
				
				<?php if (isset($_SESSION['login'])) { ?>
					<li><a href="my_profile.php">Profil Saya</a></li>
					<li><a href="logout.php">Logout</a></li>
				<?php } else { ?>
					<li><a href="login.php">Login</a></li>
					<li><a href="register.php">Sign Up</a></li>
				<?php } ?>
			</ul>
		</div>

		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="images/icons/icon-close2.png" alt="CLOSE">
				</button>

				<form class="wrap-search-header flex-w p-l-15" method="post" action="product.php">
					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input class="plh3" type="text" name="search" placeholder="Search...">
				</form>
			</div>
		</div>
	</header>

	<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>
		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m w-full p-b-8">
				<span class="mtext-103 cl2">
					Your Cart
				</span>
				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>
			
			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full">
				<?php if (isset($_SESSION['login'])) {
				while($row = mysqli_fetch_assoc($data_cart)) { ?>
					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="admin/image/<?php echo $row['image']; ?>\" alt=\"IMG\"> 
						</div>
						<div class="header-cart-item-txt p-t-8">
							<a href="product-detail.php?detail_id=<?php echo $row['product_id']; ?>" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								<?php echo $row['name']; ?>
							</a>
							<span class="header-cart-item-info">
								<?php echo $row['num_product']; ?> x Rs.<?php echo $row['price']; ?>
							</span>
						</div>
					</li>
				<?php } } ?>
				</ul>
				<div class="w-full">
					<div class="header-cart-total w-full p-tb-40">
						Total: Rs.<?php echo isset($total_price) ? $total_price : '0'; ?>
					</div>
					<div class="header-cart-buttons flex-w w-full">
						<a href="shoping-cart.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
							View Cart
						</a>
						<a href="shoping-cart.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
							Check Out
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>