<?php include_once 'site_connection.php'; ?>
<header class="header-v4">
<?php include_once 'header.php'; ?>
</header>
<?php 

$sql_select = "select * from `about`";
$data = mysqli_query($conn,$sql_select);
$row = mysqli_fetch_assoc($data);

 ?>

	<!-- Title page -->
	<section class="txt-center p-lr-15 p-tb-92" style="background: linear-gradient(135deg, #c2185b, #800080);">
		<h2 class="ltext-105 cl0 txt-center" style="font-family: 'Playfair Display', serif; font-weight: 800;">
			Tentang Sahabat
		</h2>
	</section>	

	<section class="bg0 p-t-75 p-b-120">
		<div class="container">
            
			<div class="row p-b-60">
				<div class="col-md-10 col-lg-8 m-lr-auto">
					<div class="p-t-7 txt-center">
						<h3 class="mtext-111 cl2 p-b-16" style="font-family: 'Playfair Display', serif; color: #2b003a; font-weight: 700;">
							Kisah Roti Sahabat
						</h3>
						
						<p class="stext-113 cl6 p-b-26" style="font-family: 'Poppins', sans-serif; font-size: 16px; line-height: 1.8;">
							<?php echo $row['story_detail']; ?>
						</p>

						<p class="stext-113 cl6 p-b-26" style="font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 600; color: #c2185b;">
							Ada pertanyaan atau pesanan khusus? Kunjungi toko kami di Jl. Roti Manis No. 123, Bandung, atau hubungi kami di (+62) 812 3456 7890.
						</p>
					</div>
				</div>
			</div>
            
            <hr style="border-top: 2px dashed #eee; width: 50%; margin: 0 auto 60px auto;">

			<div class="row">
				<div class="col-md-10 col-lg-8 m-lr-auto p-b-30">
					<div class="p-t-7 txt-center">
						<h3 class="mtext-111 cl2 p-b-16" style="font-family: 'Playfair Display', serif; color: #2b003a; font-weight: 700;">
							Misi Kami
						</h3>

						<p class="stext-113 cl6 p-b-26" style="font-family: 'Poppins', sans-serif; font-size: 16px; line-height: 1.8;">
							<?php echo $row['mission_detail']; ?>
						</p>
					</div>
				</div>
			</div>

		</div>
	</section>

<?php include_once 'footer.php'; ?>


<?php include_once 'scripts.php'; ?>