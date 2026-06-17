<?php 
include_once 'site_connection.php';

if (isset($_POST['register']))
{
	$name = $_POST['name'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];

	if($password1 == $password2)
	{
		$sql_select_email = "select * from `user_register` where `email`='$email'";
		$data_email = mysqli_query($conn,$sql_select_email);
		$email_count = mysqli_num_rows($data_email);

		$sql_select_mobile = "select * from `user_register` where `mobile_number`='$mobile'";
		$data_mobile = mysqli_query($conn,$sql_select_mobile);
		$mobile_count = mysqli_num_rows($data_mobile);

			if($email_count==0)
			{
				if($mobile_count==0)
				{
					$sql_insert = "insert into `user_register`(`name`,`email`,`mobile_number`,`password`)values('$name','$email','$mobile','$password1')";
					mysqli_query($conn,$sql_insert);

                    // Redirect ke login dengan pesan sukses (opsional via URL)
					header('location:login.php');
				}
				else
				{ 
                    $error_msg = "Nomor HP sudah terdaftar. Silakan gunakan nomor lain atau fitur lupa sandi.";
                }
			}
			else
			{ 
                $error_msg = "Email sudah terdaftar. Silakan gunakan email lain atau fitur lupa sandi.";
            }
	}
	else
	{ 
        $error_msg = "Kata sandi tidak cocok. Pastikan Anda mengetik ulang sandi dengan benar.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
	<title>Daftar - Roti Sahabat</title>
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
			padding: 40px 20px; /* Padding lebih besar untuk scroll mobile */
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
			max-width: 450px;
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
			margin-bottom: 18px;
			text-align: left;
			position: relative;
		}
		.input-group-custom label {
			font-size: 13px;
			font-weight: 600;
			color: #333;
			display: block;
			margin-bottom: 6px;
		}
		.input-group-custom i {
			position: absolute;
			bottom: 14px;
			left: 15px;
			color: #aaa;
		}
		.input-custom {
			width: 100%;
			height: 45px;
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
            margin-top: 10px;
		}
		.btn-auth:hover {
			transform: translateY(-2px);
			box-shadow: 0 8px 20px rgba(194, 24, 91, 0.4);
		}
		.auth-divider {
			display: flex;
			align-items: center;
			text-align: center;
			margin: 25px 0;
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
            .auth-card { padding: 30px 25px; margin-top: 20px; }
            .auth-wrap { padding: 20px 15px; }
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
			<div class="auth-subtitle">Buat akun untuk menikmati promo menarik</div>

            <?php if(isset($error_msg)){ echo '<div class="error-msg">'.$error_msg.'</div>'; } ?>

			<form method="post">
				<div class="input-group-custom">
					<label for="name">Nama Lengkap</label>
					<i class="fa fa-user"></i>
					<input class="input-custom" id="name" type="text" name="name" placeholder="Misal: Budi Santoso" required>
				</div>

				<div class="input-group-custom">
					<label for="email">Alamat Email</label>
					<i class="fa fa-envelope"></i>
					<input class="input-custom" id="email" type="email" name="email" placeholder="Masukkan email aktif" required>
				</div>

                <div class="input-group-custom">
					<label for="mobile">Nomor HP</label>
					<i class="fa fa-phone"></i>
					<input class="input-custom" id="mobile" type="text" name="mobile" placeholder="Misal: 08123456789" required>
				</div>

				<div class="input-group-custom">
					<label for="password1">Kata Sandi (Minimal 6 Karakter)</label>
					<i class="fa fa-lock"></i>
					<input class="input-custom" id="password1" type="password" name="password1" placeholder="Buat kata sandi" minlength="6" maxlength="10" required>
				</div>

                <div class="input-group-custom">
					<label for="password2">Ulangi Kata Sandi</label>
					<i class="fa fa-check-circle"></i>
					<input class="input-custom" id="password2" type="password" name="password2" placeholder="Ketik ulang kata sandi" minlength="6" maxlength="10" required>
				</div>
				
				<button type="submit" name="register" class="btn-auth">
					Daftar Sekarang
				</button>

				<div class="auth-divider">ATAU</div>
				
				<div class="register-link">
					Sudah punya akun? <a href="login.php">Masuk di sini</a>
				</div>
			</form>
		</div>
	</div>

</body>
</html>