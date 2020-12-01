<?php 
session_start();
require_once("includes/core.php");

$profiles = get_all_admin();



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
                      Add Admin profile
                  </button>
                  

                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Register</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">

                        <form class="user" method="post" action="includes/engine.php">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" name="name" class="form-control form-control-user" id="exampleFirstName"
                                    placeholder="full Name">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="uname" class="form-control form-control-user" id="exampleLastName"
                                    placeholder="User Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail"
                                placeholder="Email Address">
                            </div>
                             
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" name="password" class="form-control form-control-user"
                                    id="exampleInputPassword" placeholder="Password">
                                </div>
                                 <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" name="cpassword" class="form-control form-control-user"
                                    id="exampleInputPassword" placeholder="confirm password">
                                </div>

                              <div class="form-group">
                                <input type="hidden" name="role" value="admin" class="form-control form-control-user" >
                            </div>

                                
                            </div>
                            <a href="login.html" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </a>
                            <hr>
                            <a href="index.html" class="btn btn-google btn-user btn-block">
                                <i class="fab fa-google fa-fw"></i> Register with Google
                            </a>
                            <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                            </a>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="registerbtn" class="btn btn-primary">Save </button>
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
                            <?php 
                            if (isset($_SESSION['note']) && $_SESSION['note'] !='') {
                                echo '<h2 class= "alert alert-danger">'.$_SESSION['note'].'</h2>';
                                
                                
                            } 
                            if (isset($_SESSION['success']) &&  !empty($_SESSION['success'])  ) {
                                echo '<h2 class="alert alert-success" >'.$_SESSION['success'].'</h2>';
                            }
                            

                            ?>
                            
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Full Name</th>
                                        <th>User Name</th>
                                        <th>E-mail</th>
                                        <th>Password</th>
                                        <th>Roles</th>
                                        <th>Start Date</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 


                                    if (is_array($profiles) && !empty($profiles)) {
                                        foreach ($profiles as $profile) {
                                            
                                            
                                            
                                            
                                           ?>
                                           
                                           <tr>
                                            <td><?= $profile['id']?> </td>
                                            <td><?= $profile['name']?> </td>
                                            <td><?= $profile['uname']?> </td>
                                            <td><?= $profile['email']?> </td>
                                            <td><?= $profile['password']?> </td>
                                            <td><?= $profile['role']?> </td>
                                            <td><?= $profile['updated']?> </td>
                                           <td> <form action="admin_edit.php" method="POST"  >
                                            <input type="text" hidden="type" name="edit_id" value="<?= $profile['id']?>">
                                               <button type="submit" name="edit_btn" class="btn  btn-success">Edit</button>
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