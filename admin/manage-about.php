<?php include_once 'header.php';

$sql_select_story = "select * from `about`";
$data_story = mysqli_query($conn,$sql_select_story);

$sql_select_mission = "select * from `about`";
$data_mission = mysqli_query($conn,$sql_select_mission);

$sql_select_thought = "select * from `about`";
$data_thought = mysqli_query($conn,$sql_select_thought);

?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage About Us (Story and Mission)</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manage About Us</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                <h5 style="font-weight: bold; color: #2b003a; margin-bottom: 15px;">Kisah Roti Sahabat</h5>
                <table class="table table-bordered table-hover mb-5">
                  <thead style="background-color: #f8f9fa;">
                  <tr>
                    <th>Teks Kisah (Story Detail)</th>
                    <th style="width: 15%; text-align: center;">Aksi</th>
                  </tr>
                  </thead>
                  
                  <?php while ($row = mysqli_fetch_assoc($data_story)) { ?>
                   <tr>
                    <td><?php echo $row['story_detail']; ?></td>
                    <td align="center" style="vertical-align: middle;">
                        <a href="edit-story.php?e_id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit Teks</a>
                    </td>
                  </tr>
                  <?php } ?>
                </table>

                <h5 style="font-weight: bold; color: #2b003a; margin-bottom: 15px;">Misi Kami</h5>
                <table class="table table-bordered table-hover mb-5">
                  <thead style="background-color: #f8f9fa;">
                  <tr>
                    <th>Teks Misi (Mission Detail)</th>
                    <th style="width: 15%; text-align: center;">Aksi</th>
                  </tr>
                  </thead>
                  
                  <?php while ($row = mysqli_fetch_assoc($data_mission)) { ?>
                   <tr>
                    <td><?php echo $row['mission_detail']; ?></td>
                    <td align="center" style="vertical-align: middle;">
                        <a href="edit-mission.php?e_id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit Teks</a>
                    </td>
                  </tr>
                  <?php } ?>
                </table>

                <h5 style="font-weight: bold; color: #2b003a; margin-bottom: 15px;">Kutipan / Slogan Toko</h5>
                <table class="table table-bordered table-hover">
                  <thead style="background-color: #f8f9fa;">
                  <tr>
                    <th>Teks Kutipan (Best Thought)</th>
                    <th style="width: 25%;">Nama Tokoh (Thought by)</th>
                    <th style="width: 15%; text-align: center;">Aksi</th>
                  </tr>
                  </thead>
                  
                  <?php while ($row = mysqli_fetch_assoc($data_thought)) { ?>
                   <tr>
                    <td>"<?php echo $row['best_thought']; ?>"</td>
                    <td>- <?php echo $row['thought_by']; ?></td>
                    <td align="center" style="vertical-align: middle;">
                        <a href="edit-thought.php?e_id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm">Edit Teks</a>
                    </td>
                  </tr>
                  <?php } ?>
                </table>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <?php include_once 'footer.php'; ?>


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include_once 'scripts.php'; ?>
