<?php 
include_once 'site_connection.php'; 

if(isset($_SESSION['login']))
{
	$id = $_SESSION['login'];

	$sql_select = "select * from user_register where id='$id'";
	$data = mysqli_query($conn,$sql_select);
	$row = mysqli_fetch_assoc($data);

	if (isset($_POST['edit_data'])) {
		header('location:edit_profile_data.php');
	}

	if (isset($_POST['change_pass'])) {
		header('location:change_profile_pass.php');
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
	<title>Profil Saya - Roti Sahabat</title>
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
        .page-title { font-family: 'Playfair Display', serif; color: #2b003a; font-weight: 800; font-size: 32px; text-align: center; margin-top: 30px; margin-bottom: 40px; }
        
        /* Kartu Desain Roti Sahabat */
        .profile-card { background: #fff; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); padding: 40px; border-top: 5px solid #c2185b; height: 100%;}
        .menu-card { background: #fff; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); padding: 40px; border-top: 5px solid #2b003a; text-align: center; height: 100%;}
        .card-heading { font-family: 'Playfair Display', serif; color: #2b003a; font-weight: 700; font-size: 22px; border-bottom: 2px dashed #eee; padding-bottom: 15px; margin-bottom: 25px; }

        /* Tampilan Data Diri */
        .profile-label { font-weight: 600; color: #888; margin-bottom: 8px; font-size: 13px; text-transform: uppercase; letter-spacing: 1px;}
        .profile-value { font-size: 16px; color: #333; font-weight: 600; margin-bottom: 25px; padding: 15px 20px; background: #fdfdfd; border-radius: 10px; border: 1px solid #eee; display: flex; align-items: center;}
        .profile-value i { color: #c2185b; font-size: 20px; width: 30px; }

        /* Tombol Aksi */
        .btn-custom { border-radius: 30px; font-weight: 600; padding: 12px 25px; transition: 0.3s; display: block; width: 100%; text-align: center; margin-bottom: 15px; border: none; cursor: pointer; text-decoration: none; font-size: 15px;}
        .btn-edit { background: linear-gradient(135deg, #c2185b, #800080); color: white; box-shadow: 0 5px 15px rgba(194,24,91,0.3);}
        .btn-edit:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(194,24,91,0.4); color: white; text-decoration: none;}
        
        .btn-pass { background: transparent; border: 2px solid #2b003a; color: #2b003a; }
        .btn-pass:hover { background: #2b003a; color: white; text-decoration: none;}
        
        .btn-history { background: #28a745; color: white; box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3); }
        .btn-history:hover { background: #218838; color: white; transform: translateY(-3px); box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4); text-decoration: none;}
        
        .btn-home { background: #f1f1f1; color: #555; }
        .btn-home:hover { background: #e2e2e2; color: #333; text-decoration: none;}

    </style>
</head>
<body class="animsition">

    <header class="header-v4">
        <?php include_once 'header.php'; ?>
	</header>

	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
				Beranda
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>
			<span class="stext-109 cl4">Profil Saya</span>
		</div>
	</div>

    <h2 class="page-title">Profil Pelanggan</h2>

	<div class="container p-b-80">
		<div class="row">
            
            <div class="col-md-7 col-lg-7 m-b-30">			
				<div class="profile-card">
                    <h4 class="card-heading">Informasi Akun</h4>
                    
                    <div class="profile-label">Nama Lengkap</div>
                    <div class="profile-value">
                        <i class="fa fa-user"></i> <?php echo $row['name']; ?>
                    </div>

                    <div class="profile-label">Alamat Email</div>
                    <div class="profile-value">
                        <i class="fa fa-envelope"></i> <?php echo $row['email']; ?>
                    </div>

                    <div class="profile-label">Nomor WhatsApp / HP</div>
                    <div class="profile-value">
                        <i class="fa fa-phone"></i> <?php echo $row['mobile_number']; ?>
                    </div>
                </div>
			</div>

            <div class="col-md-5 col-lg-5 m-b-30">
                <div class="menu-card">
                    <h4 class="card-heading">Menu Cepat</h4>
                    
                    <form method="post" class="m-b-20">
                        <button type="submit" name="edit_data" class="btn-custom btn-edit">
                            <i class="fa fa-pencil-square-o m-r-5"></i> Edit Detail Profil
                        </button>
                        
                        <button type="submit" name="change_pass" class="btn-custom btn-pass">
                            <i class="fa fa-lock m-r-5"></i> Ganti Password
                        </button>
                    </form>

                    <div style="border-top: 1px dashed #eee; margin: 25px 0;"></div>
                    
                    <div class="profile-label m-b-15">Pesanan Anda</div>
                    
                    <a href="order-list.php" class="btn-custom btn-history">
                        <i class="fa fa-shopping-bag m-r-5"></i> Riwayat Pesanan
                    </a>
                    
                    <a href="index.php" class="btn-custom btn-home m-t-15">
                        <i class="fa fa-home m-r-5"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>

		</div>
	</div>

	<?php include_once 'footer.php'; ?>
	<?php include_once 'scripts.php'; ?>
</body>
</html>