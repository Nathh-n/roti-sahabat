<?php 
include_once 'site_connection.php';
	
if (isset($_POST['login']))
{
	$email = $_POST['email'];
	$password = $_POST['password'];

	$sql_select = "select * from `user_register` where `email`='$email' and `password`='$password'";
	$data = mysqli_query($conn,$sql_select);
	$row_count = mysqli_num_rows($data);

	if($row_count>0)
	{
		$row = mysqli_fetch_assoc($data);
		$_SESSION['login']=$row['id'];

		if(isset($_SESSION['cart_id']) && isset($_SESSION['num_product']))
		{
			$user_id = $row['id'];
			$cart_id = $_SESSION['cart_id'];
			$product = $_SESSION['num_product'];
			$size_p = $_SESSION['size_p'];
			$color_p = $_SESSION['color_p'];

			if($product>0)
			{
				$sql_select = "select * from `product` where `id`='$cart_id'";
				$data = mysqli_query($conn,$sql_select);
				$row = mysqli_fetch_assoc($data);

				$sql_select_c = "select * from `cart` where `product_id`='$cart_id' and `user_id`='$user_id'";
				$data_c = mysqli_query($conn,$sql_select_c);
				$row_count = mysqli_num_rows($data_c);
				$row_data = mysqli_fetch_assoc($data_c);

				$product_id = $cart_id;
				$name = $row['name'];
				$price = $row['price'];
				$num_product = $product;
				$image = $row['image1'];

				if($row_count>0)
				{
					$new_price = $price;
					$new_num_product = $num_product + $row_data['num_product'];

					$sql_update = "update `cart` set `price`='$new_price',`num_product`='$new_num_product' where `product_id`='$product_id' and `user_id`='$user_id'";
					mysqli_query($conn,$sql_update);

					header('location:shoping-cart.php');
				}
				else
				{
					$sql_insert = "insert into `cart`(`product_id`,`user_id`,`name`,`price`,`num_product`,`image`,`size`,`color`)values('$product_id','$user_id','$name','$price','$product','$image','$size_p','$color_p')";
					mysqli_query($conn,$sql_insert);

					header('location:shoping-cart.php');
				}
			}
		}
		else
		{
			header('location:index.php');
		}
	}
	else
	{ 
        $error_msg = "Email atau Kata Sandi yang Anda masukkan salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
	<title>Masuk - Roti Sahabat</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon-roti.png"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">

	<style>
		body {
			background-color: #fffafb; 
			font-family: 'Poppins', sans-serif;
		}
		.auth-wrap {
			min-height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 20px;
			position: relative;
		}
		.back-home {
			position: absolute;
			top: 30px;
			left: 30px;
			font-weight: 600;
			color: #2b003a;
			text-decoration: none;
			font-size: 15px;
			transition: 0.3s;
            z-index: 10;
		}
		.back-home:hover {
			color: #c2185b;
			text-decoration: none;
		}
		.auth-card {
			background: #fff;
			width: 100%;
			max-width: 420px;
			border-radius: 20px;
			box-shadow: 0 15px 40px rgba(128, 0, 128, 0.08);
			padding: 50px 40px;
			text-align: center;
			border-top: 5px solid #c2185b;
		}
		.auth-logo {
			font-family: 'Playfair Display', serif;
			font-size: 32px;
			font-weight: 800;
			color: #2b003a;
			margin-bottom: 5px;
		}
		.auth-subtitle {
			font-size: 13px;
			color: #888;
			margin-bottom: 30px;
		}
		.input-group-custom {
			margin-bottom: 20px;
			text-align: left;
			position: relative;
		}
		.input-group-custom label {
			font-size: 13px;
			font-weight: 600;
			color: #333;
			display: block;
			margin-bottom: 8px;
		}
		.input-group-custom i {
			position: absolute;
			bottom: 16px;
			left: 15px;
			color: #aaa;
		}
		.input-custom {
			width: 100%;
			height: 48px;
			border: 2px solid #eee;
			border-radius: 10px;
			padding: 0 20px 0 40px; 
			font-size: 14px;
			transition: all 0.3s;
			background: #fcfcfc;
		}
		.input-custom:focus {
			border-color: #c2185b;
			background: #fff;
			outline: none;
			box-shadow: 0 0 10px rgba(194, 24, 91, 0.1);
		}
		.forgot-link {
			display: block;
			text-align: right;
			font-size: 12px;
			color: #c2185b;
			font-weight: 500;
			text-decoration: none;
			margin-top: -10px;
			margin-bottom: 25px;
			transition: 0.3s;
		}
		.forgot-link:hover {
			color: #800080;
			text-decoration: none;
		}
		.btn-auth {
			width: 100%;
			height: 50px;
			background: linear-gradient(135deg, #c2185b, #800080);
			color: white;
			border: none;
			border-radius: 10px;
			font-weight: 600;
			font-size: 15px;
			text-transform: uppercase;
			letter-spacing: 1px;
			cursor: pointer;
			transition: all 0.3s;
			box-shadow: 0 5px 15px rgba(194, 24, 91, 0.3);
		}
		.btn-auth:hover {
			transform: translateY(-2px);
			box-shadow: 0 8px 20px rgba(194, 24, 91, 0.4);
		}
		.auth-divider {
			display: flex;
			align-items: center;
			text-align: center;
			margin: 30px 0;
			color: #aaa;
			font-size: 12px;
		}
		.auth-divider::before, .auth-divider::after {
			content: '';
			flex: 1;
			border-bottom: 1px dashed #ddd;
		}
		.auth-divider:not(:empty)::before { margin-right: .5em; }
		.auth-divider:not(:empty)::after { margin-left: .5em; }
		.register-link {
			font-size: 13px;
			color: #555;
		}
		.register-link a {
			color: #800080;
			font-weight: 700;
			text-decoration: none;
			transition: 0.3s;
		}
		.register-link a:hover {
			color: #c2185b;
			text-decoration: none;
		}
        .error-msg {
            color: #dc3545;
            font-size: 12px;
            margin-bottom: 15px;
            background: #f8d7da;
            padding: 10px;
            border-radius: 5px;
        }
        
        /* Mobile adjustment */
        @media (max-width: 576px) {
            .back-home { top: 15px; left: 15px; font-size: 13px; }
            .auth-card { padding: 40px 25px; }
        }
	</style>
</head>
<body>

	<div class="auth-wrap">
		<a href="index.php" class="back-home">
			<i class="fa fa-arrow-left"></i> Kembali ke Toko
		</a>

		<div class="auth-card">
			<div class="auth-logo">Roti Sahabat</div>
			<div class="auth-subtitle">Masuk untuk melanjutkan pesananmu</div>

            <?php if(isset($error_msg)){ echo '<div class="error-msg">'.$error_msg.'</div>'; } ?>

			<form method="post">
				<div class="input-group-custom">
					<label for="email">Alamat Email</label>
					<i class="fa fa-envelope"></i>
					<input class="input-custom" id="email" type="email" name="email" placeholder="Masukkan Email kamu" required>
				</div>

				<div class="input-group-custom">
					<label for="password">Kata Sandi</label>
					<i class="fa fa-lock"></i>
					<input class="input-custom" id="password" type="password" name="password" placeholder="Masukkan kata sandi" required>
				</div>
				
				<a href="forgot.php" class="forgot-link">Lupa Kata Sandi?</a>

				<button type="submit" name="login" class="btn-auth">
					Masuk
				</button>

				<div class="auth-divider">ATAU</div>
				
				<div class="register-link">
					Belum punya akun? <a href="register.php">Daftar Sekarang</a>
				</div>
			</form>
		</div>
	</div>

</body>
</html>