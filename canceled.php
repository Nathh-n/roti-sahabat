<?php include_once 'site_connection.php'; ?>

<?php
if(isset($_SESSION['login']))
{
	$login_id = $_SESSION['login'];
	$sql_select_login = "select * from `user_register` where `id`='$login_id'";
	$data_login = mysqli_query($conn,$sql_select_login);
	$row_login = mysqli_fetch_assoc($data_login);
}
else
{
	header('location:login_home.php');
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
	<title>Pesanan Dibatalkan - Roti Sahabat</title>
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
        
        .canceled-container {
            max-width: 600px;
            margin: 80px auto;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.05);
            padding: 50px 30px;
            text-align: center;
            border-top: 5px solid #dc3545; /* Garis merah penanda batal */
        }
        .canceled-icon {
            font-size: 70px;
            color: #dc3545;
            margin-bottom: 20px;
            display: inline-block;
        }
        .canceled-title {
            font-family: 'Playfair Display', serif;
            font-weight: 800;
            font-size: 32px;
            color: #2b003a;
            margin-bottom: 15px;
        }
        .canceled-text {
            font-size: 15px;
            color: #666;
            line-height: 1.8;
            margin-bottom: 35px;
            padding: 0 20px;
        }
        .info-box {
            background: #fdf2f2;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 15px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 30px;
            text-align: left;
        }
        
        .btn-group-custom { display: flex; flex-direction: column; gap: 15px; }
        
        .btn-primary-custom { background: linear-gradient(135deg, #c2185b, #800080); color: white; border-radius: 30px; font-weight: 600; padding: 12px 30px; border: none; transition: 0.3s; width: 100%; display: block; text-decoration: none;}
        .btn-primary-custom:hover { background: #2b003a; color: white; text-decoration: none; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(194, 24, 91, 0.3);}
        
        .btn-outline-custom { background: transparent; color: #2b003a; border: 2px solid #2b003a; border-radius: 30px; font-weight: 600; padding: 12px 30px; transition: 0.3s; display: block; width: 100%; text-decoration: none;}
        .btn-outline-custom:hover { background: #2b003a; color: white; text-decoration: none; }
    </style>
</head>
<body class="animsition">

	<header class="header-v4">
        <?php include_once 'header.php'; ?>
	</header>

    <!-- Kotak Notifikasi Batal -->
    <div class="container">
        <div class="canceled-container">
            <i class="fa fa-times-circle canceled-icon"></i>
            <h1 class="canceled-title">Pesanan Berhasil Dibatalkan</h1>
            <p class="canceled-text">
                Permintaan pembatalan Anda telah kami terima dan pesanan tidak akan diproses lebih lanjut.
            </p>

            <div class="info-box">
                <i class="fa fa-info-circle m-r-5"></i> <b>Catatan Pengembalian Dana:</b><br>
                Jika Anda sebelumnya telah melakukan pembayaran (Transfer Bank), dana Anda akan dikembalikan secara penuh dalam waktu <b>maksimal 7 hari kerja</b>.
            </div>

            <div class="btn-group-custom">
                <a href="product.php" class="btn-primary-custom">
                    <i class="fa fa-shopping-cart m-r-5"></i> Pesan Roti Lainnya
                </a>
                <a href="order-list.php" class="btn-outline-custom">
                    <i class="fa fa-list-alt m-r-5"></i> Kembali ke Riwayat Pesanan
                </a>
            </div>
        </div>
    </div>

	<?php include_once 'footer.php'; ?>
	<?php include_once 'scripts.php'; ?>
</body>
</html>