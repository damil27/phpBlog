<?php 
session_start();
require_once("includes/core.php");


$faculties = get_faculty();


include"includes/header.php";?> 
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include"includes/sidebar.php";


        ?> 
         <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "includes/navbar.php";
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                      Add 
                  </button>

                  <?php 
                      if (isset($_SESSION['success'])) {
                        echo '<h3 class="alert alert-success" >'.$_SESSION['success'].'</h3>';
                      }
                      if (isset($_SESSION['note'])) {
                        echo '<h3 class= "alert alert-danger" >'.$_SESSION['note'].'</h3>';
                      }
                   ?>
                  

                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Faculty</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">

                        <form action="includes/engine.php" method="POST" enctype="multipart/form-data" >
                          
                        
                          <div class="form-group">
                            <label >Name</label>
                            <input type="text" name="name" class="form-control" id="" placeholder="Name">

                          </div>
                          <div class="form-group">
                            <label >Designation</label>
                            <input type="text" name="designation" class="form-control" id="" placeholder="Designation">
                          </div>
                          <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" name="description" class="form-control" placeholder="Description" >
                          </div>

                          <div class="form-group">
                            <label for="">Upload</label>
                            <input type="file" name="filename" class="form-control" >
                          </div>
                          
                          </div>
                        
                        

                        
                         <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="uploadbtn" class="btn btn-primary">Save </button>
                            </div>
                        </form>
                           
                           
                        

                    </div>
                    
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row" >
                <div class="col-md-12" >
                    <div class="card">
                        <div class="card-title">
                          
                            
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Description</th>
                                        <th>Images</th>
                                        <th>Updated</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                   


                                      <?php 
                                        if (is_array($faculties) && !empty($faculties)) {
                                          foreach ($faculties as $faculty) {
                                            ?>
                                        
                                           
                                           <tr>
                                            <td> <?=$faculty['id']?> </td>
                                            <td> <?=$faculty['name']?></td>
                                            <td> <?=$faculty['designation']?></td>
                                            <td><?=$faculty['description']?> </td>
                                            <td><?php echo "<img src='img/faculty/".$faculty['filename']."' width='100' height='100' class='img-responsive zoom-img' />"?></td>
                                            <td> <?=$faculty['create_date']?></td>
                                     
                                           <td> <form action="edit_faculty.php" method="POST"  >
                                            <input type="hidden" name="faculty_id" value="<?=$faculty['id']?>">
                                               <button type="submit" name="faculty_editbtn" class="btn  btn-success">Edit</button>
                                           </form>
                                            
                                        </td>
                                           <td>
                                            <form method="POST" action="includes/engine.php">
                                                <input type="hidden" name="fa_del_id" value="<?= $faculty['id']?>" >
                                            <button type="submit" class="btn  btn-danger" name="faculty_delete" >Delete</button></td>
                                            
                                            </form>
                                        </tr>
                                        <?php 
                                          }
                                        }
                                      
                                         ?>
                                 
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>


<?php unset($_SESSION['note']); ?>
<?php unset($_SESSION['success']); ?>
<?php include"includes/footer.php" ; ?> 

<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
