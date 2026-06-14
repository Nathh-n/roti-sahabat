<?php include_once 'site_connection.php'; ?>
<header class="header-v4">
<?php include_once 'header.php'; ?>
</header>

<?php 
if (isset($_POST['submit_msg']))
{
	$name = $_POST['name'];
	$email = $_POST['email'];
	$msg = $_POST['msg'];
	date_default_timezone_set('Asia/Jakarta');
	$time = date('Y-m-d H:i:s');

	$sql_insert = "insert into `contact_us`(`name`,`email`,`msg`,`time`)values('$name','$email','$msg','$time')";
	mysqli_query($conn,$sql_insert);

    // Tambahkan notifikasi popup agar pelanggan tahu pesannya terkirim
    echo "<script>alert('Terima kasih! Pesan Sahabat telah berhasil dikirim dan akan segera kami balas.'); window.location.href='contact.php';</script>";
}
?>

	<section class="txt-center p-lr-15 p-tb-92" style="background: linear-gradient(135deg, #c2185b, #800080);">
		<h2 class="ltext-105 cl0 txt-center" style="font-family: 'Playfair Display', serif; font-weight: 800;">
			Hubungi Kami
		</h2>
	</section>	

	<section class="bg0 p-t-104 p-b-116">
		<div class="container">
			<div class="flex-w flex-tr">
				
                <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
					<form method="post">
						<h4 class="mtext-105 cl2 txt-center p-b-30" style="font-family: 'Playfair Display', serif; font-weight: 700; color: #2b003a;">
							Kirim Pesan
						</h4>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="name" placeholder="Nama Lengkap Sahabat" required maxlength="20" style="font-family: 'Poppins', sans-serif;">
							<img class="how-pos4 pointer-none" src="images/icons/icon-heart-01.png" alt="ICON">
						</div>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="email" name="email" placeholder="Alamat Email" required maxlength="25" style="font-family: 'Poppins', sans-serif;">
							<img class="how-pos4 pointer-none" src="images/icons/icon-email.png" alt="ICON">
						</div>

						<div class="bor8 m-b-30">
							<textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="msg" placeholder="Ada yang bisa kami bantu? (Misal: Pesanan khusus, katering, dll)" required maxlength="500" style="font-family: 'Poppins', sans-serif;"></textarea>
						</div>

						<button class="flex-c-m stext-101 cl0 size-121 bor1 p-lr-15 trans-04 pointer" name="submit_msg" style="background: #2b003a; border-radius: 30px; font-family: 'Poppins', sans-serif; font-weight: 600;">
							Kirim Sekarang
						</button>
					</form>
				</div>

                <div class="size-210 bor10 flex-w flex-col-m p-lr-90 p-tb-30 p-lr-15-lg w-full-md">
					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211" style="color: #c2185b;">
							<span class="lnr lnr-map-marker"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2" style="font-family: 'Poppins', sans-serif; font-weight: 600;">
								Alamat Toko
							</span>

							<p class="stext-115 cl6 size-213 p-t-18" style="font-family: 'Poppins', sans-serif;">
								Jl. Roti Manis No. 123, Kecamatan Sumur Bandung, Kota Bandung, Jawa Barat 40111
							</p>
						</div>
					</div>

					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211" style="color: #c2185b;">
							<span class="lnr lnr-phone-handset"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2" style="font-family: 'Poppins', sans-serif; font-weight: 600;">
								Telepon / WhatsApp
							</span>

							<p class="stext-115 cl1 size-213 p-t-18" style="font-family: 'Poppins', sans-serif; color: #c2185b; font-weight: 500;">
								(+62) 812-3456-7890
							</p>
						</div>
					</div>

					<div class="flex-w w-full">
						<span class="fs-18 cl5 txt-center size-211" style="color: #c2185b;">
							<span class="lnr lnr-envelope"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2" style="font-family: 'Poppins', sans-serif; font-weight: 600;">
								Email Dukungan
							</span>

							<p class="stext-115 cl1 size-213 p-t-18" style="font-family: 'Poppins', sans-serif; color: #c2185b; font-weight: 500;">
								halo@rotisahabat.com
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>	
	
	<div style="width: 100%;">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.56347862248!2d107.57311654129782!3d-6.903444341687889!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146a1f93d3e815b2!2sBandung%2C%20Bandung%20City%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1718000000000!5m2!1sen!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
	</div>	

<?php include_once 'footer.php'; ?>
<?php include_once 'scripts.php'; ?>