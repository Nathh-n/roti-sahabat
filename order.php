<?php include_once 'site_connection.php'; ?>

<?php 
if(isset($_SESSION['login']))
{
	$login_id = $_SESSION['login'];
	$sql_select_login = "select * from `user_register` where `id`='$login_id'";
	$data_login = mysqli_query($conn,$sql_select_login);
	$row_login = mysqli_fetch_assoc($data_login);

    // MODE 1: MELIHAT RIWAYAT (DARI TOMBOL STRUK)
    if(isset($_GET['view_id'])) {
        $view_id = $_GET['view_id'];
        
        $sql_select = "select * from `order` where `id`='$view_id' and `user_id`='$login_id'";
        $data = mysqli_query($conn,$sql_select);
        
        $sql_select_o = "select * from `order` where `id`='$view_id' and `user_id`='$login_id'";
        $data_o = mysqli_query($conn,$sql_select_o);
        $row_o = mysqli_fetch_assoc($data_o);

        if(mysqli_num_rows($data_o) == 0) {
            header('location:order-list.php');
            exit;
        }

        $payment_status = ($row_o['payment']=='Cash on Delivery') ? 'BAYAR DI TEMPAT (COD)' : 'LUNAS (PAID)';
        $is_history = true;
    } 
    // MODE 2: CHECKOUT BARU SELESAI
    else {
        $is_history = false;
        $sql_select_status = "select * from `order` where `user_id`='$login_id' and `status`='placed'";
        $data_status = mysqli_query($conn,$sql_select_status);
        $row_status = mysqli_num_rows($data_status);

        if($row_status > 0)
        {
            $sql_select = "select * from `order` where `user_id`='$login_id' and `status`='placed'";
            $data = mysqli_query($conn,$sql_select);

            $sql_select_o = "select * from `order` where `user_id`='$login_id' and `status`='placed'";
            $data_o = mysqli_query($conn,$sql_select_o);
            $row_o = mysqli_fetch_assoc($data_o);

            $sql_select_pay = "select `payment` from `order` where `user_id`='$login_id' and `status`='placed'";
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

            // Ubah status jadi Pending agar tidak terbaca lagi sebagai pesanan baru
            $sql_update = "update `order` set `status`='Pending' where `user_id`='$login_id' and `status`='placed'";
            mysqli_query($conn,$sql_update);
        }
        else
        {
            header('location:order-list.php');
            exit;
        }
    }

	if (isset($_POST['list']))
	{	
		header('location:order-list.php');
        exit;
	}
}
else
{
	header('location:login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
	<title>Detail Pesanan - Roti Sahabat</title>
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
        
        .success-banner { background: linear-gradient(135deg, #c2185b, #800080); color: white; border-radius: 15px; padding: 40px 20px; text-align: center; margin-bottom: 40px; box-shadow: 0 10px 30px rgba(194, 24, 91, 0.2); }
        .success-banner h1 { font-family: 'Playfair Display', serif; font-weight: 800; font-size: 32px; margin-bottom: 10px; }
        .success-banner p { font-size: 15px; opacity: 0.9; margin: 0; }
        .success-icon { font-size: 50px; margin-bottom: 15px; display: block; }

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
        .btn-primary-custom { background: linear-gradient(135deg, #c2185b, #800080); color: white; border-radius: 30px; font-weight: 600; padding: 12px 30px; border: none; transition: 0.3s; margin-top: 10px; display: inline-block;}
        .btn-outline-custom { background: transparent; color: #2b003a; border: 2px solid #2b003a; border-radius: 30px; font-weight: 600; padding: 10px 25px; transition: 0.3s; display: inline-block; margin-top: 10px; margin-right: 10px; cursor: pointer;}
        .btn-outline-custom:hover { background: #2b003a; color: white; text-decoration: none; }

        @media (max-width: 767px) {
            .wrap-table-shopping-cart { background: transparent; box-shadow: none; overflow: visible; }
            .table-shopping-cart, .table-shopping-cart tbody, .table-shopping-cart tr { display: block; width: 100%; }
            .table-shopping-cart .table_head { display: none; } 
            .table-shopping-cart .table_row { background: #fff; margin-bottom: 20px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); padding: 20px; border: 1px solid #f9f9f9; }
            .table-shopping-cart td { display: flex !important; justify-content: space-between !important; align-items: center !important; padding: 15px 0 !important; border-bottom: 1px dashed #eee !important; text-align: right !important; }
            .table-shopping-cart td:last-child { border-bottom: none !important; }
            .table-shopping-cart td::before { content: attr(data-label); font-weight: 700; color: #888; font-size: 12px; text-transform: uppercase; }
            .table-shopping-cart td.column-1 { flex-direction: column !important; justify-content: center !important; padding: 0 0 15px 0 !important; border-bottom: 2px dashed #f0f0f0 !important; }
            .table-shopping-cart td.column-1::before { display: none !important; } 
            .cart-item-detail { text-align: right; }
            .cart-item-detail ul { text-align: right; display: block; margin-top: 5px; list-style: none; padding: 0;}
            .info-text b { min-width: auto; display: block; margin-bottom: 3px; color: #888; font-size: 12px;}
            .action-buttons { display: flex; flex-direction: column; }
            .action-buttons button, .action-buttons a { width: 100%; text-align: center; margin-right: 0;}
        }

        /* CSS KHUSUS STRUK MINIMARKET (Hanya Muncul Saat Print/PDF) */
        @media print {
            body { background: white; margin: 0; padding: 0; }
            header, .bread-crumb, .success-banner, .wrap-table-shopping-cart, .info-card, footer, .action-buttons, .section-title { display: none !important; }
            
            .minimarket-receipt { display: block !important; }
        }

        /* Gaya layout struk kasir termal (Disembunyikan di layar HP/Desktop) */
        .minimarket-receipt {
            display: none;
            width: 80mm; 
            margin: 0 auto;
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            color: #000;
            line-height: 1.5;
        }
        .minimarket-receipt .receipt-header { text-align: center; margin-bottom: 10px; }
        .minimarket-receipt .receipt-header h2 { font-size: 16px; font-weight: bold; margin: 0 0 5px 0; }
        .minimarket-receipt .receipt-header p { margin: 0; font-size: 12px; }
        .minimarket-receipt .divider { border-bottom: 1px dashed #000; margin: 10px 0; }
        .minimarket-receipt table { width: 100%; border-collapse: collapse; }
        .minimarket-receipt table td { vertical-align: top; padding: 2px 0; }
        .minimarket-receipt .text-right { text-align: right; }
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
			<span class="stext-109 cl4">Detail Pesanan</span>
		</div>
	</div>

	<div class="container">
        <div class="success-banner m-lr-25 m-lr-0-xl">
            <?php if(isset($is_history) && $is_history == true) { ?>
                <h1>Detail Riwayat Pesanan</h1>
                <p>Berikut adalah salinan struk untuk pesanan Anda sebelumnya.</p>
            <?php } else { ?>
                <i class="fa fa-check-circle success-icon"></i>
                <h1>Hore! Pesanan Sahabat Berhasil Dibuat</h1>
                <p>Roti pesananmu akan segera kami siapkan. Berikut adalah detail pesananmu.</p>
            <?php } ?>
        </div>
    </div>

	<form method="post">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 col-xl-7 m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
                        <h4 class="section-title">Detail Produk</h4>
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1" style="text-align: center;">Menu</th>
									<th class="column-2">Detail Roti</th>
									<th class="column-3">Harga</th>
									<th class="column-4" style="text-align: center;">Qty</th>
									<th class="column-5">Subtotal</th>
								</tr>

						<?php 
                        $page_total = 0; // Variabel baru untuk menghitung total secara langsung!
                        if(isset($_SESSION['login'])) {
						    while($row = mysqli_fetch_assoc($data)) { 
                                $sub_total = $row['num_product'] * $row['price'];
                                $page_total += $sub_total; // Menambahkan nilai ke grand total
                        ?>
								<tr class="table_row">
									<td class="column-1" align="center" data-label="Menu">
										<div class="how-itemcart1">
											<img src="admin/image/<?php echo $row['image']; ?>" alt="Roti">
										</div>												
									</td>
									<td class="column-2" data-label="Detail Roti">
										<div class="p-b-10 cart-item-detail" style="font-weight: 700; color: #2b003a; font-size: 15px;"><?php echo $row['name']; ?></div>
										<ul style="font-size: 12px; color: #666;">
											<li><b>Ukuran : </b><?php echo $row['size']; ?></li>
											<li><b>Varian : </b><?php echo $row['color']; ?></li>
										</ul>	
									</td>
									<td class="column-3" data-label="Harga" style="color: #c2185b; font-weight: 600;">Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></td>
									<td class="column-4" data-label="Qty" align="center">
										<span style="font-weight: 700; background: #f9f9f9; padding: 5px 15px; border-radius: 5px;"><?php echo $row['num_product']; ?></span>
									</td>
									<td class="column-5" data-label="Subtotal" style="font-weight: 700; color: #2b003a;">
										Rp <?php echo number_format($sub_total, 0, ',', '.'); ?>
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
                            <div class="info-text"><b>Email</b>: <?php echo $row_o['email']; ?></div>
                            <div class="info-text"><b>Alamat</b>: <?php echo $row_o['address']; ?>, <?php echo $row_o['city']; ?>, <?php echo $row_o['pincode']; ?></div>
                        </div>

						<h4 class="section-title">Ringkasan Pembayaran</h4>
						<div class="flex-w flex-t p-b-10" style="border-bottom: 1px dashed #eee;">
							<div class="size-208"><span class="stext-110 cl2" style="color: #666;">Subtotal:</span></div>
							<div class="size-209 text-right"><span class="mtext-110 cl2" style="font-weight: 600;"><?php echo "Rp " . number_format($page_total, 0, ',', '.'); ?></span></div>
						</div>

						<div class="flex-w flex-t p-t-10 p-b-20">
							<div class="size-208"><span class="stext-110 cl2" style="color: #666;">Ongkos Kirim:</span></div>
							<div class="size-209 text-right"><p class="stext-111" style="font-weight: 600; color: #28a745;">Gratis</p></div>
						</div>

						<div class="flex-w flex-t p-t-20 p-b-20" style="border-top: 2px solid #f9f9f9;">
							<div class="size-208"><span class="mtext-101 cl2" style="color: #2b003a; font-weight: 800; font-size: 18px;">Total:</span></div>
							<div class="size-209 p-t-1 text-right"><span class="mtext-110 cl2" style="color: #c2185b; font-weight: 800; font-size: 20px;"><?php echo "Rp " . number_format($page_total, 0, ',', '.'); ?></span></div>
						</div>

						<div class="text-center p-t-10">
							<div class="payment-status-badge">
                                <i class="fa fa-check-circle m-r-5"></i> <?php echo $payment_status; ?>
                            </div>
						</div>

                        <div class="action-buttons p-t-30">
                            <button type="button" onclick="window.print()" class="btn-outline-custom">
                                <i class="fa fa-download m-r-5"></i> Download Struk
                            </button>

                            <button class="btn-primary-custom" name="list">
                                Kembali ke Daftar <i class="fa fa-arrow-right m-l-5"></i>
                            </button>
                        </div>
						
					</div>
				</div>
			</div>
		</div>
	</form>

    <div class="minimarket-receipt">
        <div class="receipt-header">
            <h2>ROTI SAHABAT</h2>
            <p>Jl. Roti Manis No. 123, Bandung<br>Telp: (+62) 812-3456-7890</p>
        </div>
        
        <div class="divider"></div>
        
        <table style="width: 100%;">
            <tr>
                <td>Tgl: <?php echo date('d/m/Y H:i', strtotime($row_o['date_time'])); ?></td>
            </tr>
            <tr>
                <td>Plg: <?php echo substr($row_o['cust_name'], 0, 20); ?></td>
            </tr>
        </table>
        
        <div class="divider"></div>
        
        <table style="width: 100%;">
            <?php 
            $receipt_total = 0; // Variabel total khusus untuk Struk!
            // Kita kembalikan pointer ke 0 agar bisa di-loop lagi tanpa perlu query ke database
            if(mysqli_num_rows($data) > 0) {
                mysqli_data_seek($data, 0);
                while($row = mysqli_fetch_assoc($data)) { 
                    $sub = $row['num_product'] * $row['price'];
                    $receipt_total += $sub;
            ?>
            <tr>
                <td colspan="3"><?php echo $row['name']; ?> (<?php echo $row['size']; ?>)</td>
            </tr>
            <tr>
                <td style="width: 25%;"><?php echo $row['num_product']; ?> x </td>
                <td style="width: 35%;"><?php echo number_format($row['price'], 0, ',', '.'); ?></td>
                <td style="width: 40%;" class="text-right"><?php echo number_format($sub, 0, ',', '.'); ?></td>
            </tr>
            <?php } } ?>
        </table>
        
        <div class="divider"></div>
        
        <table style="width: 100%;">
            <tr>
                <td>Subtotal</td>
                <td class="text-right"><?php echo number_format($receipt_total, 0, ',', '.'); ?></td>
            </tr>
            <tr>
                <td>Ongkir</td>
                <td class="text-right">0</td>
            </tr>
            <tr>
                <td><b>TOTAL</b></td>
                <td class="text-right"><b><?php echo number_format($receipt_total, 0, ',', '.'); ?></b></td>
            </tr>
        </table>
        
        <div class="divider"></div>
        
        <div class="receipt-header">
            <p>Tipe Bayar: <br> <?php echo $payment_status; ?></p>
            <p style="margin-top: 15px;">Terima kasih telah belanja<br>di Roti Sahabat!</p>
            <p>***</p>
        </div>
    </div>

	<?php include_once 'footer.php'; ?>
	<?php include_once 'scripts.php'; ?>
</body>
</html>