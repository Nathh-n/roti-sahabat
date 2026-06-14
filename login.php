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
			background-color: #fffafb; /* Warna latar pink sangat lembut */
			font-family: 'Poppins', sans-serif;
		}
		.login-wrap {
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
		}
		.back-home:hover {
			color: #c2185b;
			text-decoration: none;
		}
		.login-card {
			background: #fff;
			width: 100%;
			max-width: 420px;
			border-radius: 20px;
			box-shadow: 0 15px 40px rgba(128, 0, 128, 0.08);
			padding: 50px 40px;
			text-align: center;
			border-top: 5px solid #c2185b;
		}
		.login-logo {
			font-family: 'Playfair Display', serif;
			font-size: 32px;
			font-weight: 800;
			color: #2b003a;
			margin-bottom: 5px;
		}
		.login-subtitle {
			font-size: 13px;
			color: #888;
			margin-bottom: 40px;
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
			padding: 0 20px 0 40px; /* Jarak untuk icon */
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
		.btn-login {
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
		.btn-login:hover {
			transform: translateY(-2px);
			box-shadow: 0 8px 20px rgba(194, 24, 91, 0.4);
		}
		.login-divider {
			display: flex;
			align-items: center;
			text-align: center;
			margin: 30px 0;
			color: #aaa;
			font-size: 12px;
		}
		.login-divider::before, .login-divider::after {
			content: '';
			flex: 1;
			border-bottom: 1px dashed #ddd;
		}
		.login-divider:not(:empty)::before { margin-right: .5em; }
		.login-divider:not(:empty)::after { margin-left: .5em; }
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
	</style>
</head>
<body>

	<div class="login-wrap">
		<a href="index.php" class="back-home">
			<i class="fa fa-arrow-left"></i> Kembali ke Toko
		</a>

		<div class="login-card">
			<div class="login-logo">Roti Sahabat</div>
			<div class="login-subtitle">Masuk untuk melanjutkan pesananmu</div>

			<form method="post">
				<div class="input-group-custom">
					<label for="user_id">Email / User ID</label>
					<i class="fa fa-user"></i>
					<input class="input-custom" id="user_id" type="text" name="user_id" placeholder="Masukkan ID kamu" required>
				</div>

				<div class="input-group-custom">
					<label for="password">Kata Sandi</label>
					<i class="fa fa-lock"></i>
					<input class="input-custom" id="password" type="password" name="password" placeholder="Masukkan kata sandi" required>
				</div>
				
				<a href="#" class="forgot-link">Lupa Kata Sandi?</a>

				<button type="submit" name="login" class="btn-login">
					Masuk
				</button>

				<div class="login-divider">ATAU</div>
				
				<div class="register-link">
					Belum punya akun? <a href="register.php">Daftar Sekarang</a>
				</div>
			</form>
		</div>
	</div>

</body>
</html>