<?php 

include_once '../connection.php';

$sql_select_data = "select * from `order` where `status`='Cancelled-By-Client' or `status`='Delivered' or `status` = 'Cancelled-By-Supplier'";
$data_data = mysqli_query($conn,$sql_select_data);
$data_count = mysqli_num_rows($data_data);

$limit = 5;
$page_count = ceil($data_count/$limit);

if (isset($_GET['p_id']))
{
  $page_no = $_GET['p_id'];
}
else
{
  $page_no=1;
}

$start = ($page_no-1)*$limit;

$sql_select = "select * from `order` where `status`='Cancelled-By-Client' or `status`='Delivered' or `status` = 'Cancelled-By-Supplier' limit $start,$limit";
$data = mysqli_query($conn,$sql_select);

?>

                  <thead>
                  <tr>
                    <th>ID Roti</th>
                    <th>Tgl & Waktu Pesan</th>
                    <th>Nama Roti</th>
                    <th>Jumlah (Qty)</th>
                    <th>Gambar Pesanan</th>
                    <th>Alamat Pengiriman</th>
                    <th>Kota & Kode Pos</th>
                    <th class="text-center">Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  
                  <tbody>
                  <?php 
                  if(mysqli_num_rows($data) > 0) {
                      while ($row = mysqli_fetch_assoc($data)) { ?>

                       <tr>
                        <td><?php echo $row['product_id']; ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($row['date_time'])); ?></td>
                        <td style="font-weight: 600; color: #2b003a;"><?php echo $row['name']; ?></td>
                        <td align="center"><span class="badge badge-info" style="font-size: 14px;"><?php echo $row['num_product']; ?></span></td>
                        <td align="center">
                             <div style="width: 120px; height: 100px; border-radius: 8px; overflow: hidden; border: 1px solid #ddd;">
                                <img src="image/<?php echo $row['image']; ?>" style="height: 100%; width: 100%; object-fit: cover; object-position: center;">
                             </div>
                        </td>
                        <td style="white-space: normal; min-width: 200px;"><?php echo $row['address']; ?></td>
                        <td><?php echo $row['city']; ?>, <?php echo $row['pincode']; ?></td>                    
                        <td align="center">
                            <?php 
                                if($row['status'] == 'Delivered') {
                                    echo '<span class="badge badge-success" style="padding: 8px 12px; font-size:12px;"><i class="fa fa-check"></i> Selesai / Terkirim</span>';
                                } else {
                                    echo '<span class="badge badge-danger" style="padding: 8px 12px; font-size:12px;"><i class="fa fa-times"></i> Dibatalkan</span><br><small class="text-muted">'.$row['status'].'</small>';
                                }
                            ?>
                        </td>                    
                        <td>
                            <a href="view-more-past-order.php?v_id=<?php echo $row['id']; ?>" class="btn btn-sm btn-secondary">
                                <i class="fa fa-eye"></i> Detail
                            </a>
                        </td>
                      </tr>

                      <?php } 
                  } else {
                      echo '<tr><td colspan="9" align="center" style="padding: 30px;">Belum ada riwayat pesanan (Selesai/Batal).</td></tr>';
                  }
                  ?>
                  </tbody>

                   <tr>
                    <td colspan="9" align="center">
                  <?php for ($i=1; $i<=$page_count; $i++) { ?>
                    <a href="javascript:void(0)" class="btn btn-sm <?php echo (isset($_GET['p_id']) && $_GET['p_id']==$i) || (!isset($_GET['p_id']) && $i==1) ? 'btn-secondary' : 'btn-outline-secondary'; ?> past_order_admin_page_change" attr_id="<?php echo $i; ?>">
                    <?php echo $i; ?>
                    </a>
                  <?php } ?>   
                    </td>
                  </tr>

<script type="text/javascript">
	
	$('.past_order_admin_page_change').click(function(){

        var po_page_change_id = $(this).attr('attr_id');

        // alert(o_page_change_id);
        $.ajax({

          type: 'get',
          url: 'ajax/past_order_admin_page_change.php',
          data: {'p_id':po_page_change_id},

          success:function(res)
          {
              $('.display_past_order_admin_page_change').html(res);

              $('html,body').animate({scrollTop:0},'slow');
          }

        });
    });

</script>