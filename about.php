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
                            <h5 class="modal-title" id="exampleModalLabel">Add About</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">

                        <form action="includes/engine.php" method="POST" role="form">
                        	
                        
                        	<div class="form-group">
                        		<label for="">Title</label>
                        		<input type="text" name="title" class="form-control" id="" placeholder="Title">

                        	</div>
                        	<div class="form-group">
                        		<label for="">SubTitle</label>
                        		<input type="text" name="subtitle" class="form-control" id="" placeholder="SubTitle">
                        	</div>
                        	<div class="form-group">
                        		<label for="">Description</label>
                        		<textarea name="description" class="form-control"></textarea>
                        	</div>

                        	<div class="form-group">
                        		<label for="">Link</label>
                        		<input type="text" name="link" class="form-control" id="" placeholder="link">
                        	</div
                        	
                        	</div>
                        
                        

                        
                         <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="about_btn" class="btn btn-primary">Save </button>
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
                                        <th>Title</th>
                                        <th>SubTitle</th>
                                        <th>Description</th>
                                        <th>Link</th>
                                        <th>Updated</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                   


                                   		<?php 
                                   			if (is_array($abouts) && !empty($abouts)) {
                                   				foreach ($abouts as $about) {
                                   					?>
                                   			
                                           
                                           <tr>
                                            <td><?=$about['id']?></td>
                                            <td> <?=$about['title']?></td>
                                            <td> <?=$about['subtitle']?></td>
                                            <td><?=$about['description']?> </td>
                                            <td><?=$about['link']?> </td>
                                            <td> <?=$about['updated']?></td>
                                     
                                           <td> <form action="edit_about.php" method="POST"  >
                                            <input type="hidden" name="edit_id" value="<?=$about['id']?>">
                                               <button type="submit" name="edit_aboutbtn" class="btn  btn-success">Edit</button>
                                           </form>
                                            
                                        </td>
                                           <td>
                                            <form method="POST" action="includes/engine.php">
                                                <input type="hidden" name="delete_id" value="<?= $profile['id']?>" >
                                            <button type="submit" class="btn  btn-danger" name="delete_btn" >Delete</button></td>
                                            
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






</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Footer -->
<?php unset($_SESSION['note']); ?>
<?php unset($_SESSION['success']); ?>
<?php include"includes/footer.php" ; ?> 