<?php include_once 'site_connection.php'; ?>

<?php
if(isset($_SESSION['login']))
{
	$login_id = $_SESSION['login'];
	$sql_select_login = "select * from `user_register` where `id`='$login_id'";
	$data_login = mysqli_query($conn,$sql_select_login);
	$row_login = mysqli_fetch_assoc($data_login);

	if(isset($_GET['c_id']))
	{
		$cancel = $_GET['c_id'];

		$sql_select = "select * from `order` where `id`='$cancel'";
		$data = mysqli_query($conn,$sql_select);

		$sql_select_o = "select * from `order` where `id`='$cancel'";
		$data_o = mysqli_query($conn,$sql_select_o);
		$row_o = mysqli_fetch_assoc($data_o);

		$amt_total = "select * from `order` where `id`='$cancel'";
		$data_total = mysqli_query($conn,$amt_total);

		$total_price = 0;
		while($row_total = mysqli_fetch_assoc($data_total))
		{
			$total_price = $total_price + $row_total['price'] * $row_total['num_product'];
		}

		$sql_select_pay = "select `payment` from `order` where `id`='$cancel'";
		$data_pay = mysqli_query($conn,$sql_select_pay);
		$row_pay = mysqli_fetch_assoc($data_pay);

		if ($row_pay['payment']=='Cash on Delivery') 
		{
			$payment_status = 'BAYAR DI TEMPAT (COD)';
		}
		else
		{
			$payment_status = 'LUNAS (PAID)';
		}
	}

	if (isset($_POST['yes'])) {
		$sql_update = "update `order` set `status`='Cancelled-By-Client' where `id`='$cancel'";
		mysqli_query($conn,$sql_update);
		header('location:canceled.php');
	}

	if (isset($_POST['no'])) {
		header('location:order-list.php');
	}
}
else
{
	header('location:login_home.php');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
	<title>Batalkan Pesanan - Roti Sahabat</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon-roti.png"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main_css.css">

    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #fffafb; }
        
        .cancel-banner { background: #fff3cd; color: #856404; border-radius: 15px; padding: 40px 20px; text-align: center; margin-bottom: 40px; border: 2px solid #ffeeba; }
        .cancel-banner h1 { font-family: 'Playfair Display', serif; font-weight: 800; font-size: 28px; margin-bottom: 10px; }
        .cancel-banner p { font-size: 15px; margin: 0; }
        .cancel-icon { font-size: 50px; margin-bottom: 15px; display: block; color: #ffc107; }

        .section-title { font-family: 'Playfair Display', serif; color: #2b003a; font-weight: 700; font-size: 22px; border-bottom: 2px dashed #eee; padding-bottom: 10px; margin-bottom: 20px; }
        
        /* Tabel Produk Layar Utama */
        .wrap-table-shopping-cart { border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); background: #fff; overflow: hidden; border: none; }
        .table-shopping-cart { width: 100%; border-collapse: collapse; }
        .table-shopping-cart .table_head { background: #f9f9f9; }
        .table-shopping-cart .table_head th { color: #333; padding: 15px; font-weight: 700; text-transform: uppercase; font-size: 13px; border-bottom: 2px solid #eee; text-align: left;}
        .table-shopping-cart .table_row td { border-bottom: 1px dashed #eee; vertical-align: middle; padding: 20px 15px; }
        .how-itemcart1 { width: 70px; height: 70px; border-radius: 10px; overflow: hidden; margin: 0 auto;}
        .how-itemcart1 img { width: 100%; height: 100%; object-fit: cover; }
        
        .info-card { background: #fff; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); padding: 30px; margin-bottom: 30px; border-top: 4px solid #c2185b;}
        .info-text { font-size: 14px; color: #555; margin-bottom: 12px; line-height: 1.6; }
        .info-text b { color: #2b003a; display: inline-block; min-width: 130px; }
        .payment-status-badge { display: inline-block; padding: 10px 20px; border-radius: 30px; font-weight: 700; font-size: 14px; background: #e8f5e9; color: #28a745; border: 1px solid #c3e6cb; margin-top: 15px; letter-spacing: 1px;}
        
        .btn-danger-custom { background: #dc3545; color: white; border-radius: 30px; font-weight: 600; padding: 12px 30px; border: none; transition: 0.3s; margin-top: 10px; display: inline-block; width: 100%; margin-bottom: 10px; cursor: pointer;}
        .btn-danger-custom:hover { background: #c82333; color: white; text-decoration: none; }
        .btn-outline-custom { background: transparent; color: #2b003a; border: 2px solid #2b003a; border-radius: 30px; font-weight: 600; padding: 10px 25px; transition: 0.3s; display: inline-block; margin-top: 10px; width: 100%; text-align: center; cursor: pointer;}
        .btn-outline-custom:hover { background: #2b003a; color: white; text-decoration: none; }

    </style>
</head>
<body class="animsition">

	<header class="header-v4">
        <?php include_once 'header.php'; ?>
	</header>

	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-b-20 p-lr-0-lg">
			<a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
				Beranda <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>
			<a href="order-list.php" class="stext-109 cl8 hov-cl1 trans-04">
				Riwayat Pesanan <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>
			<span class="stext-109 cl4">Batalkan Pesanan</span>
		</div>
	</div>

	<div class="container">
        <div class="cancel-banner m-lr-25 m-lr-0-xl">
            <i class="fa fa-exclamation-triangle cancel-icon"></i>
            <h1>Apakah Sahabat Yakin Ingin Membatalkan Pesanan?</h1>
            <p>Catatan: Jika pesanan sudah dibayar via transfer, dana akan dikembalikan maksimal 7 hari kerja ke rekening Anda.</p>
        </div>
    </div>

	<form method="post">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 col-xl-7 m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
                        <h4 class="section-title">Detail Roti yang Dibatalkan</h4>
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1" style="text-align: center;">Menu</th>
									<th class="column-2">Detail Roti</th>
									<th class="column-3">Harga</th>
									<th class="column-4" style="text-align: center;">Qty</th>
									<th class="column-5">Subtotal</th>
								</tr>

						<?php if(isset($_SESSION['login'])) {
						while($row = mysqli_fetch_assoc($data)) { ?>
								<tr class="table_row">
									<td class="column-1" align="center">
										<div class="how-itemcart1">
											<img src="admin/image/<?php echo $row['image']; ?>" alt="Roti">
										</div>												
									</td>
									<td class="column-2">
										<div class="p-b-10" style="font-weight: 700; color: #2b003a; font-size: 15px;"><?php echo $row['name']; ?></div>
										<ul style="font-size: 12px; color: #666;">
											<li><b>Ukuran : </b><?php echo $row['size']; ?></li>
											<li><b>Varian : </b><?php echo $row['color']; ?></li>
										</ul>	
									</td>
									<td class="column-3" style="color: #c2185b; font-weight: 600;">Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></td>
									<td class="column-4" align="center">
										<span style="font-weight: 700; background: #f9f9f9; padding: 5px 15px; border-radius: 5px;"><?php echo $row['num_product']; ?></span>
									</td>
									<td class="column-5" style="font-weight: 700; color: #2b003a;">
										<?php 
											$sub_total = $row['num_product'] * $row['price'];
											echo 'Rp '. number_format($sub_total, 0, ',', '.');
										 ?>
									</td>
								</tr>
						<?php } } ?>

							</table>
						</div>
					</div>
				</div>

				<div class="col-lg-5 col-xl-5 m-b-50">
					<div class="info-card m-l-40 m-lr-0-xl p-lr-15-sm">
						
                        <h4 class="section-title">Informasi Pengiriman</h4>
                        <div class="m-b-30">
                            <div class="info-text"><b>Penerima</b>: <?php echo $row_o['cust_name']; ?></div>
                            <div class="info-text"><b>No. HP</b>: <?php echo $row_o['mobile']; ?></div>
                            <div class="info-text"><b>Alamat</b>: <?php echo $row_o['address']; ?>, <?php echo $row_o['city']; ?>, <?php echo $row_o['pincode']; ?></div>
                        </div>

						<h4 class="section-title">Ringkasan Nilai Pesanan</h4>
						<div class="flex-w flex-t p-b-10" style="border-bottom: 1px dashed #eee;">
							<div class="size-208"><span class="stext-110 cl2" style="color: #666;">Subtotal:</span></div>
							<div class="size-209 text-right"><span class="mtext-110 cl2" style="font-weight: 600;"><?php echo "Rp " . number_format($total_price, 0, ',', '.'); ?></span></div>
						</div>

						<div class="flex-w flex-t p-t-10 p-b-20">
							<div class="size-208"><span class="stext-110 cl2" style="color: #666;">Ongkos Kirim:</span></div>
							<div class="size-209 text-right"><p class="stext-111" style="font-weight: 600; color: #28a745;">Gratis</p></div>
						</div>

						<div class="flex-w flex-t p-t-20 p-b-20" style="border-top: 2px solid #f9f9f9;">
							<div class="size-208"><span class="mtext-101 cl2" style="color: #2b003a; font-weight: 800; font-size: 18px;">Total Batal:</span></div>
							<div class="size-209 p-t-1 text-right"><span class="mtext-110 cl2" style="color: #dc3545; font-weight: 800; font-size: 20px;"><?php echo "Rp " . number_format($total_price, 0, ',', '.'); ?></span></div>
						</div>

						<div class="text-center p-t-10">
							<div class="payment-status-badge">
                                <i class="fa fa-info-circle m-r-5"></i> Metode Pembayaran: <?php echo $payment_status; ?>
                            </div>
						</div>

                        <!-- TOMBOL AKSI -->
                        <div class="p-t-30">
                            <button type="submit" name="yes" class="btn-danger-custom">
                                <i class="fa fa-times-circle m-r-5"></i> Ya, Batalkan Pesanan Ini
                            </button>
                            <button type="submit" name="no" class="btn-outline-custom">
                                Tidak, Kembali ke Riwayat
                            </button>
                        </div>
						
					</div>
				</div>
			</div>
		</div>
	</form>

	<?php include_once 'footer.php'; ?>
	<?php include_once 'scripts.php'; ?>
</body>
</html>