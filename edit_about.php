<?php 
session_start();
require_once("includes/core.php");


$abouts = get_about();


include"includes/header.php";?> 
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include"includes/sidebar.php";


    ?> 
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include "includes/navbar.php";
        ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Button trigger modal -->
          <h3>Edit About Page</h3>
          <?php 
          if (isset($_SESSION['success'])) {
           echo '<h3 class="alert alert-success" >'.$_SESSION['success'].'</h3>';
         }
         if (isset($_SESSION['note'])) {
           echo '<h3 class= "alert alert-danger" >'.$_SESSION['note'].'</h3>';
         }
         ?>

         <div class="row" >
          <div class="col-md-8 offset-2" >
            <div class="card">
              <div class="card-title">

        <?php  
        if (isset($_POST['edit_aboutbtn'])) {
          $id = $_POST['edit_id'];
          $sql = " SELECT * FROM about where id = '$id' ";
          global $db;
          $query = mysqli_query($db,$sql) or die(mysqli_query($db));

          foreach ($query as $row) {


            ?>

            <div class="card-body">
             <form action="includes/engine.php" method="POST" role="form">


              <div class="form-group">
                <label for="">Title</label>
                <input type="hidden" name="edit_id" value="<?=$row['id']?>" >
                <input type="text" name="editTitle" class="form-control" id="" value="<?=$row['title']?>">

              </div>
              <div class="form-group">
                <label for="">SubTitle</label>
                <input type="text" name="editSubtitle" class="form-control" id="" value="<?=$row['subtitle']?>">
              </div>
              <div class="form-group">
                <label for="">Description</label>
                <!--<textarea name="editDescription" class="form-control" value="<?=$row['description']?>"></textarea>-->
                <input type="text" name="editDescription"  class="form-control" value="<?=$row['description']?>" >
              </div>

              <div class="form-group">
                <label for="">Link</label>
                <input type="text" name="editLink" class="form-control" id="" value="<?=$row['link']?>">
              </div>

              </div>




              <div class="modal-footer">
                
                <a href="about.php" class="btn btn-secondary"> Cancel</a>
                <button type="submit" name="update_aboutbtn" class="btn btn-primary">Save </button>
              </div>
            </form>

          </div>
          <?php 
        }

      }
      ?>
    </div>
              </div>
            </div>
          </div>
        </div>












      </div>

    </div>
  </div>
</div>


<div class="container-fluid">







</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<?php unset($_SESSION['note']); ?>
<?php unset($_SESSION['success']); ?>
<?php include"includes/footer.php" ; ?> 