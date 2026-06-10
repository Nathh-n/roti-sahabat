<?php include_once 'site_connection.php';

// --- KODE PROSES PLUS MINUS HAPUS KERANJANG SIDEBAR ---
if(isset($_GET['cart_action']) && isset($_GET['c_id']) && isset($_SESSION['login'])) {
    $c_id = $_GET['c_id'];
    $u_id = $_SESSION['login'];
    $action = $_GET['cart_action'];

    $cek_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE `product_id`='$c_id' AND `user_id`='$u_id'");
    if(mysqli_num_rows($cek_cart) > 0) {
        $row_c = mysqli_fetch_assoc($cek_cart);
        $qty_now = $row_c['num_product'];

        if($action == 'add') {
            $new_qty = $qty_now + 1;
            mysqli_query($conn, "UPDATE `cart` SET `num_product`='$new_qty' WHERE `product_id`='$c_id' AND `user_id`='$u_id'");
        } elseif($action == 'min') {
            $new_qty = $qty_now - 1;
            if($new_qty > 0) {
                mysqli_query($conn, "UPDATE `cart` SET `num_product`='$new_qty' WHERE `product_id`='$c_id' AND `user_id`='$u_id'");
            } else {
                mysqli_query($conn, "DELETE FROM `cart` WHERE `product_id`='$c_id' AND `user_id`='$u_id'");
            }
        } elseif($action == 'del') {
            mysqli_query($conn, "DELETE FROM `cart` WHERE `product_id`='$c_id' AND `user_id`='$u_id'");
        }
    }
    // Refresh otomatis ke halaman saat ini
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
// --- AKHIR KODE PROSES KERANJANG ---

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
		
		<div class="header-cart flex-col-l p-l-40 p-r-40" style="width: 420px; max-width: 100%; box-shadow: -5px 0 20px rgba(0,0,0,0.1);">
			
			<div class="header-cart-title flex-w flex-sb-m w-full p-b-20 p-t-30" style="border-bottom: 2px solid #f9f9f9;">
				<span class="mtext-103" style="font-family: 'Playfair Display', serif; font-weight: 800; font-size: 24px; color: #2b003a;">
					Keranjang Roti
				</span>
				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>
			
			<div class="header-cart-content flex-w js-pscroll w-full p-t-20">
				<ul class="header-cart-wrapitem w-full">
				
				<?php 
				if (isset($_SESSION['login'])) {
					if (mysqli_num_rows($data_cart) > 0) {
						while($row = mysqli_fetch_assoc($data_cart)) { ?>
						
						<li class="header-cart-item m-b-25" style="display: flex; flex-wrap: nowrap; align-items: center; border-bottom: 1px dashed #eee; padding-bottom: 15px;">
							
							<div style="flex-shrink: 0; width: 80px; height: 80px; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-right: 15px;">
								<img src="admin/image/<?php echo $row['image']; ?>" alt="IMG" style="width: 100%; height: 100%; object-fit: cover;">
							</div>

							<div style="flex-grow: 1; width: calc(100% - 95px);">
								<div style="display: flex; justify-content: space-between; align-items: flex-start;">
									<a href="#" class="header-cart-item-name hov-cl1 trans-04" style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 16px; color: #2b003a; line-height: 1.2; padding-right: 10px; width: auto;">
										<?php echo $row['name']; ?>
									</a>
									
									<a href="?cart_action=del&c_id=<?php echo $row['product_id']; ?>" class="pointer hov-cl1 trans-04" style="color: #ff4d4d; font-size: 20px; line-height: 1;" title="Hapus">
										<i class="zmdi zmdi-delete"></i>
									</a>
								</div>

								<div style="color: #c2185b; font-weight: 600; font-size: 15px; margin-top: 5px;">
									Rp <?php echo number_format($row['price'], 0, ',', '.'); ?>
								</div>

								<div style="display: flex; align-items: center; margin-top: 10px;">
									<a href="?cart_action=min&c_id=<?php echo $row['product_id']; ?>" style="display: flex; justify-content: center; align-items: center; width: 30px; height: 30px; border-radius: 8px; background-color: #f9f9f9; color: #2b003a; border: 1px solid #ddd; text-decoration: none; transition: 0.3s;" onmouseover="this.style.backgroundColor='#e0e0e0'" onmouseout="this.style.backgroundColor='#f9f9f9'">
										<i class="fs-14 zmdi zmdi-minus"></i>
									</a>
									
									<span style="font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 15px; color: #333; width: 35px; text-align: center;">
										<?php echo $row['num_product']; ?>
									</span>
									
									<a href="?cart_action=add&c_id=<?php echo $row['product_id']; ?>" style="display: flex; justify-content: center; align-items: center; width: 30px; height: 30px; border-radius: 8px; background-color: #f9f9f9; color: #2b003a; border: 1px solid #ddd; text-decoration: none; transition: 0.3s;" onmouseover="this.style.backgroundColor='#e0e0e0'" onmouseout="this.style.backgroundColor='#f9f9f9'">
										<i class="fs-14 zmdi zmdi-plus"></i>
									</a>
								</div>
							</div>
						</li>

						<?php } 
					} else {
						// Jika Keranjang Kosong
						echo '<div class="flex-col-c-m p-t-50 p-b-50 w-full"><i class="zmdi zmdi-shopping-cart" style="font-size: 60px; color: #ddd; margin-bottom: 15px;"></i><p style="font-family:\'Poppins\', sans-serif; color: #888; text-align: center;">Keranjang Sahabat masih kosong.</p></div>';
					}
				} else {
					// Jika Belum Login
					echo '<div class="flex-col-c-m p-t-50 p-b-50 w-full"><i class="zmdi zmdi-account" style="font-size: 60px; color: #ddd; margin-bottom: 15px;"></i><p style="font-family:\'Poppins\', sans-serif; color: #888; text-align: center;">Silakan login terlebih dahulu.</p></div>';
				}
				?>
				</ul>
				
				<div class="w-full p-b-30">
					<div class="header-cart-total w-full p-tb-20" style="font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 800; color: #2b003a; border-top: 2px solid #f9f9f9; text-align: right;">
						Total: Rp <?php echo isset($total_price) ? number_format($total_price, 0, ',', '.') : '0'; ?>
					</div>

					<div class="header-cart-buttons flex-w w-full">
						<a href="shoping-cart.php" class="flex-c-m stext-101 cl0 size-107 trans-04 w-full" style="background: linear-gradient(135deg, #c2185b, #800080); border-radius: 30px; font-family: 'Poppins', sans-serif; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 5px 15px rgba(194, 24, 91, 0.3);">
							Checkout Sekarang
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>