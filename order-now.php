<?php include_once 'site_connection.php'; ?>

<?php 

if(isset($_SESSION['login']))
{
$login_id = $_SESSION['login'];
$sql_select_login = "select * from `user_register` where `id`='$login_id'";
$data_login = mysqli_query($conn,$sql_select_login);
$row_login = mysqli_fetch_assoc($data_login);

$sql_select = "select * from `cart` where `user_id`='$login_id'";
$data = mysqli_query($conn,$sql_select);

$sql_select_pro_id = "select `product_id` from `cart` where `user_id`='$login_id'";
$data_pro_id = mysqli_query($conn,$sql_select_pro_id);

while ($row = mysqli_fetch_assoc($data_pro_id)) {
	$pro_id = $row['product_id'];

	$sql_select = "select * from `product` where `id`='$pro_id'";
	$data_price = mysqli_query($conn,$sql_select);
}

$amt_total = "select * from `cart` where `user_id`='$login_id'";
$data_total = mysqli_query($conn,$amt_total);

$total_price = 0;
while($row_total = mysqli_fetch_assoc($data_total))
{
	$total_price = $total_price + $row_total['price'] * $row_total['num_product'];
}

$sql_select_r = "select * from `user_register` where `id`='$login_id'";
$data_r = mysqli_query($conn,$sql_select_r);
$row_r = mysqli_fetch_assoc($data_r);
}
else
{
	header('location:login_home.php');
}


if (isset($_POST['buy'])) {

	$address = $_POST['address'];
	$city = $_POST['city'];
	$pincode = $_POST['pincode'];
	$name = $_POST['name'];
	$mobile = $_POST['mobile'];
	$email = $_POST['email'];
	$date_time = $_POST['date_time'];
	$payment = $_POST['payment'];
	
	$sql_insert = "insert into `order`(`product_id`,`user_id`,`name`,`price`,`num_product`,`size`,`color`,`image`) select `product_id`,`user_id`,`name`,`price`,`num_product`,`size`,`color`,`image` from `cart` where `user_id`='$login_id'";
		mysqli_query($conn,$sql_insert);

	$sql_insert2 = "update `order` set `address`='$address',`city`='$city',`pincode`='$pincode',`cust_name`='$name',`mobile`='$mobile',`email`='$email',`date_time`='$date_time',`payment`='$payment' where `user_id`='$login_id' and `status`='placed'";
	mysqli_query($conn,$sql_insert2);

	$sql_delete = "delete from `cart` where `user_id`='$login_id'";
	mysqli_query($conn,$sql_delete);

	header('location:order.php');
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
	<title>Checkout - Roti Sahabat</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon-roti.png"/>
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
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #fffafb; }
        .checkout-title { font-family: 'Playfair Display', serif; color: #2b003a; font-weight: 800; font-size: 28px; margin-bottom: 30px; }
        .table_head { background: linear-gradient(135deg, #c2185b, #800080); }
        .table_head th { color: #ffffff !important; padding: 15px; font-weight: 600; text-transform: uppercase; font-size: 14px; border: none; }
        .table-shopping-cart { background: #fff; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .table_row td { border-bottom: 1px dashed #eee; padding: 15px; vertical-align: middle; }
        .how-itemcart1 { width: 70px; height: 70px; border-radius: 10px; overflow: hidden; }
        .how-itemcart1 img { width: 100%; height: 100%; object-fit: cover; }
        .form-checkout { background: #fff; padding: 30px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border-top: 4px solid #c2185b; }
        .btn-place-order { background: linear-gradient(135deg, #c2185b, #800080); border-radius: 30px; transition: 0.3s; color: white; border: none; font-weight: 700; width: 100%; height: 50px; text-transform: uppercase; letter-spacing: 1px; margin-top: 20px;}
        .btn-place-order:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(194,24,91,0.3); }
        .summary-card { background: #fff; padding: 30px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); border-top: 4px solid #2b003a; }
        .input-custom { border-radius: 10px !important; border: 1px solid #ddd !important; }
    </style>
</head>
<body class="animsition">

    <header class="header-v4">
        <?php include_once 'header.php'; ?>
	</header>

	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-b-30 p-lr-0-lg">
			<a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
				Beranda
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<a href="shoping-cart.php" class="stext-109 cl8 hov-cl1 trans-04">
				Keranjang Pesanan
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				Checkout
			</span>
		</div>
	</div>

	<div id="new_number_of_product">
	<form class="p-b-85" method="post">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
                        <h3 class="checkout-title">Detail Produk</h3>
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart" align="center">
								<tr class="table_head">
									<th class="column-1">Produk</th>
									<th class="column-2">Detail</th>
									<th class="column-3">Harga</th>
									<th class="column-4" style="text-align: center;">Jumlah</th>
									<th class="column-5">Subtotal</th>
								</tr>

						<?php if(isset($_SESSION['login']))
						{
						while($row = mysqli_fetch_assoc($data)) { ?>
								<tr class="table_row">
									<td class="column-1" align="center">
										<div class="how-itemcart1">
											<img src="admin/image/<?php echo $row['image']; ?>">
										</div>												
									</td>
									<td class="column-2">
										<div class="p-b-10" style="font-weight: 700; color: #2b003a;"><?php echo $row['name']; ?></div>
										<ul style="font-size: 13px; color: #666;">
											<li><b>Ukuran : </b><?php echo $row['size']; ?></li>
											<li><b>Varian : </b><?php echo $row['color']; ?></li>
										</ul>	
									</td>
									<td class="column-3" style="color: #c2185b; font-weight: 600;">Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></td>
									<td class="column-4" align="center">
										<span class="num_pro" style="font-weight: 700;"><?php echo $row['num_product']; ?></span>
									</td>
									<td class="column-5" style="font-weight: 700; color: #2b003a;">
										<?php 
											$total_pro = $row['num_product'];
											$price = $row['price'];
											echo 'Rp '. number_format($total_pro*$price, 0, ',', '.');
										 ?>
									</td>
								</tr>
						<?php } } ?>

							</table>
						</div>

						<div class="form-checkout m-t-40">
                            <h4 class="checkout-title" style="font-size: 22px; margin-bottom: 20px;">Informasi Pengiriman</h4>
							
                            <div class="stext-110 cl2 m-b-10 m-l-3" style="font-weight: 600;">Alamat Lengkap:</div>
                            <div class="bor8 bg0 m-b-15 input-custom">
                                <textarea rows="3" class="stext-111 cl8 plh3 p-t-10 p-lr-15" style="width: 100%; border: none; outline: none; background: transparent;" name="address" placeholder="Masukkan alamat pengiriman..." required></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="stext-110 cl2 m-b-10 m-l-3" style="font-weight: 600;">Kota:</div>
                                    <div class="bor8 bg0 m-b-15 input-custom">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15" style="border: none; outline: none; background: transparent; width: 100%;" type="text" name="city" maxlength="20" placeholder="Contoh: Bandung" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="stext-110 cl2 m-b-10 m-l-3" style="font-weight: 600;">Kode Pos:</div>
                                    <div class="bor8 bg0 m-b-15 input-custom">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15" style="border: none; outline: none; background: transparent; width: 100%;" type="text" name="pincode" maxlength="6" placeholder="Contoh: 40111" required>
                                    </div>
                                </div>
                            </div>

                            <div class="stext-110 cl2 m-t-15 m-b-10 m-l-3" style="font-weight: 600;">Nama Penerima:</div>
                            <div class="bor8 bg0 m-b-15 input-custom">
                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" style="border: none; outline: none; background: transparent; width: 100%;" type="text" name="name" maxlength="40" placeholder="Nama Lengkap" value="<?php echo @$row_r['name']; ?>" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="stext-110 cl2 m-t-15 m-b-10 m-l-3" style="font-weight: 600;">No. WhatsApp / HP:</div>
                                    <div class="bor8 bg0 m-b-15 input-custom">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15" style="border: none; outline: none; background: transparent; width: 100%;" type="text" name="mobile" minlength="10" maxlength="15" placeholder="Contoh: 081234567890" value="<?php echo @$row_r['mobile_number']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="stext-110 cl2 m-t-15 m-b-10 m-l-3" style="font-weight: 600;">Alamat Email:</div>
                                    <div class="bor8 bg0 m-b-15 input-custom">
                                        <input class="stext-111 cl8 plh3 size-111 p-lr-15" style="border: none; outline: none; background: transparent; width: 100%;" type="text" name="email" maxlength="35" placeholder="Email Aktif" value="<?php echo @$row_r['email']; ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="stext-110 cl2 m-t-15 m-b-10 m-l-3" style="font-weight: 600;">Metode Pembayaran:</div>
                            <div class="m-b-22 input-custom overflow-hidden">
                                <select name="payment" class="stext-111 cl8 plh3 size-111 p-lr-15" style="border: none; width: 100%; outline: none;" required>
                                    <option value="" disabled selected>- Pilih Metode Pembayaran -</option>
                                    <option value="Transfer Bank / Virtual Account">Transfer Bank / Virtual Account</option>
                                    <option value="E-Wallet (OVO/Dana/GoPay)">E-Wallet (OVO / Dana / GoPay)</option>
                                    <option value="Cash on Delivery">Bayar di Tempat (COD)</option>
                                </select>
                            </div>

                            <input type="hidden" name="date_time" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date('Y-m-d H:i:s'); ?>" required>
							
						</div>
					</div>
				</div>

				<div class="col-sm-12 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="summary-card m-l-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="checkout-title" style="font-size: 24px; border-bottom: 2px dashed #eee; padding-bottom: 15px;">
							Ringkasan Pembayaran
						</h4>

						<div class="flex-w flex-t p-b-13" style="border-bottom: 1px dashed #eee;">
							<div class="size-208"><span class="stext-110 cl2" style="color: #666;">Subtotal:</span></div>
							<div class="size-209 text-right">
								<span class="mtext-110 cl2" style="font-weight: 600;">
									<?php if(isset($_SESSION['login'])) { echo "Rp " . number_format($total_price, 0, ',', '.'); } else { echo "Rp 0"; } ?>
								</span>
							</div>
						</div>

						<div class="flex-w flex-t p-t-15 p-b-30">
							<div class="size-208 w-full-ssm"><span class="stext-110 cl2" style="color: #666;">Ongkos Kirim:</span></div>
							<div class="size-209 p-r-0-sm w-full-ssm text-right">
								<p class="stext-111 cl6 p-t-2" style="font-style: italic; font-weight: 600; color: #28a745;">Gratis</p>
							</div>
						</div>

						<div class="flex-w flex-t p-t-27 p-b-33" style="border-top: 2px solid #f9f9f9;">
							<div class="size-208"><span class="mtext-101 cl2" style="color: #2b003a; font-weight: 800; font-size: 20px;">Total Pembayaran:</span></div>
							<div class="size-209 p-t-1 text-right">
								<span class="mtext-110 cl2" style="color: #c2185b; font-weight: 800; font-size: 22px;">
									<?php if(isset($_SESSION['login'])) { echo "Rp " . number_format($total_price, 0, ',', '.'); } else { echo "Rp 0"; } ?>
								</span>
							</div>
						</div>

						<button class="btn-place-order" name="buy">
							Konfirmasi Pesanan
						</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

	<?php include_once 'footer.php'; ?>
	<?php include_once 'scripts.php'; ?>
</body>
</html>