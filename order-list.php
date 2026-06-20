<?php include_once 'site_connection.php'; ?>

<?php 
if(isset($_SESSION['login']))
{
	$login_id = $_SESSION['login'];
	$sql_select_login = "select * from `user_register` where `id`='$login_id'";
	$data_login = mysqli_query($conn,$sql_select_login);
	$row_login = mysqli_fetch_assoc($data_login);

    // Mengambil data pesanan dari yang terbaru
    $sql_select = "select * from `order` where `user_id`='$login_id' order by `id` desc";
    $data = mysqli_query($conn,$sql_select);
}
else
{
	header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
	<title>Riwayat Pesanan - Roti Sahabat</title>
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
        .page-title { font-family: 'Playfair Display', serif; color: #2b003a; font-weight: 800; font-size: 32px; text-align: center; margin-top: 20px; margin-bottom: 40px; }
        
        .wrap-table-shopping-cart { border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); background: #fff; overflow: hidden; border: none; }
        .table-shopping-cart { width: 100%; border-collapse: collapse; }
        .table-shopping-cart .table_head { background: linear-gradient(135deg, #c2185b, #800080); }
        .table-shopping-cart .table_head th { background: transparent; color: #ffffff !important; padding: 18px 20px; font-weight: 600; text-transform: uppercase; font-size: 13px; letter-spacing: 1px; border: none; text-align: left;}
        .table-shopping-cart .table_head th.text-center { text-align: center; }
        .table-shopping-cart .table_row td { border-bottom: 1px dashed #eee; vertical-align: middle; padding: 25px 20px; }
        
        .how-itemcart1 { width: 75px; height: 75px; border-radius: 10px; overflow: hidden; margin: 0 auto; box-shadow: 0 4px 10px rgba(0,0,0,0.05);}
        .how-itemcart1 img { width: 100%; height: 100%; object-fit: cover; }
        
        /* Status Pesanan */
        .status-badge { display: inline-block; padding: 6px 15px; border-radius: 20px; font-size: 12px; font-weight: 700; text-transform: uppercase;}
        .status-pending { background: #fff3cd; color: #28a745; border: 1px solid #c3e6cb; }
        .status-delivered { background: #e2e3e5; color: #383d41; border: 1px solid #d6d8db; }
        
        /* Tombol Aksi */
        .btn-cancel { color: #ff4d4d; border: 1px solid #ff4d4d; border-radius: 20px; padding: 5px 15px; font-size: 12px; font-weight: 600; transition: 0.3s; display: inline-block; background: transparent; text-decoration: none;}
        .btn-cancel:hover { background: #ff4d4d; color: white; text-decoration: none; }
        
        .btn-receipt { color: #2b003a; border: 1px solid #2b003a; border-radius: 20px; padding: 5px 15px; font-size: 12px; font-weight: 600; transition: 0.3s; display: inline-block; background: transparent; text-decoration: none; margin-bottom: 5px;}
        .btn-receipt:hover { background: #2b003a; color: white; text-decoration: none; }

        /* Responsivitas Mobile (Flexbox Method) */
        @media (max-width: 767px) {
            .wrap-table-shopping-cart { background: transparent; box-shadow: none; overflow: visible; }
            .table-shopping-cart, .table-shopping-cart tbody, .table-shopping-cart tr { display: block; width: 100%; }
            .table-shopping-cart .table_head { display: none; } 
            
            .table-shopping-cart .table_row { background: #fff; margin-bottom: 25px; border-radius: 15px; box-shadow: 0 8px 25px rgba(0,0,0,0.05); padding: 20px; border: 1px solid #f9f9f9; }
            
            .table-shopping-cart td { display: flex !important; justify-content: space-between !important; align-items: center !important; padding: 12px 0 !important; border-bottom: 1px dashed #eee !important; text-align: right !important; }
            .table-shopping-cart td:last-child { border-bottom: none !important; }
            
            .table-shopping-cart td::before { content: attr(data-label); font-weight: 700; color: #888; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;}

            .table-shopping-cart td.column-1 { flex-direction: column !important; justify-content: center !important; padding: 0 0 15px 0 !important; border-bottom: 2px dashed #f0f0f0 !important; }
            .table-shopping-cart td.column-1::before { display: none !important; } 
            
            .cart-item-detail { text-align: right; }
            .cart-item-detail ul { text-align: right; display: block; margin-top: 5px; list-style: none; padding: 0;}
            
            .action-col { flex-direction: column; align-items: flex-end !important; }
            .action-col a { margin-left: 0; margin-top: 5px; }
        }
    </style>
</head>
<body class="animsition">

    <!-- Memanggil Header Bersih Roti Sahabat -->
	<header class="header-v4">
        <?php include_once 'header.php'; ?>
	</header>

	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-b-10 p-lr-0-lg">
			<a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
				Beranda
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>
			<span class="stext-109 cl4">Riwayat Pesanan</span>
		</div>
	</div>

    <h2 class="page-title">Riwayat Pesananmu</h2>

	<form class="p-b-85" method="post">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-xl-10 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart" align="center">
								<tr class="table_head">
									<th class="column-1" style="text-align: center;">Menu</th>
									<th class="column-2">Detail Roti</th>
									<th class="column-3">Harga</th>
									<th class="column-4" style="text-align: center;">Qty</th>
									<th class="column-5">Subtotal</th>
									<th class="column-6 text-center">Status</th>
									<th class="column-7 text-center">Aksi</th>
								</tr>

						<?php if(isset($_SESSION['login'])) {
                            if(mysqli_num_rows($data) > 0) {
						        while($row = mysqli_fetch_assoc($data)) { ?>
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
									<td class="column-4" align="center" data-label="Qty">
										<span style="font-weight: 700; background: #f9f9f9; padding: 5px 15px; border-radius: 5px;"><?php echo $row['num_product']; ?></span>
									</td>
									<td class="column-5" data-label="Subtotal" style="font-weight: 700; color: #2b003a;">
										<?php 
											$sub_total = $row['num_product'] * $row['price'];
											echo 'Rp '. number_format($sub_total, 0, ',', '.');
										 ?>
									</td>
									<td class="column-6 text-center" data-label="Status">
                                        <?php if($row['status'] == "Pending") { ?>
                                            <span class="status-badge status-pending"><i class="fa fa-clock-o m-r-5"></i> Diproses</span>
                                        <?php } else { ?>
                                            <span class="status-badge status-delivered"><i class="fa fa-check m-r-5"></i> Selesai</span>
                                        <?php } ?>
									</td>
									<td class="column-7 text-center action-col" data-label="Aksi">
                                        <!-- Tombol Lihat/Download Struk -->
                                        <a href="order.php?view_id=<?php echo $row['id']; ?>" class="btn-receipt"><i class="fa fa-file-text-o m-r-5"></i> Struk</a>

										<?php if($row['status'] == "Pending") { ?>
										    <a href="cancel-order.php?c_id=<?php echo $row['id']; ?>" class="btn-cancel" onclick="return confirm('Apakah kamu yakin ingin membatalkan pesanan ini?');"><i class="fa fa-times m-r-5"></i> Batal</a>
										<?php } ?>
									</td>
								</tr>
						<?php       } 
                                } else {
                                    echo '<tr><td colspan="7" align="center" style="padding: 50px 0; color: #888;">Kamu belum memiliki riwayat pesanan. Yuk, mulai belanja!</td></tr>';
                                }
                            } 
                        ?>

							</table>
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