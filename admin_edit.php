<?php 

require_once("includes/core.php");

session_start();



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
                    <div class="row">
                        <div class="col-md-8 offset-2">
                            <div class="card">
                                <div class="card-title">Edit Admin Profile </div>
                                <div class="card-body">
                                    <?php 
                                        if (isset($_POST['edit_btn'])) {
                                            $id = $_POST['edit_id'];
                                            $sql = "SELECT * FROM profile WHERE id='$id' " ;
                                            global $id;
                                            $query = mysqli_query($db,$sql) or die(mysqli_error($db));
                                            $edit_rows = $query;
                                            foreach ($edit_rows as $row) {
                                            
                                     ?>
                                    <form action="includes/engine.php" method="POST" role="form">
                                        <legend>Form title</legend>
                                    
                                        <div class="form-group">
                                            <label for="">full Name</label>
                                            <input type="hidden" class="form-control" value="<?=$row['id']?>" id="" name="edit_id">
                                            <input type="text" name="edit_name" class="form-control" value="<?=$row['name']?>" id="" name="name">
                                            <label for="">User Name</label>
                                            <input type="text" name="edit_uname" class="form-control" value="<?=$row['uname']?>" id="" name="uname">
                                            <label for=""> E-mail</label>
                                            <input type="text" name="edit_email" class="form-control" value="<?=$row['email']?>" id="" name="email">
                                            <label for="">password</label>
                                            <input type="password" name="edit_password" class="form-control" value="<?=$row['password']?>" id="" name="password">
                                           <select name="edit_role" class="form-control"   >
                                               <option value="Admin">Admin</option>
                                               <option value="User" >User</option>
                                           </select>
                                        </div>
                                       <a href="register.php" class="btn btn-danger"> Cancel</a>
                                        <button type="submit" name="update_btn" class="btn btn-primary">update</button>
                                    </form>
                                    <?php 
                                }
                            }


                                     ?>
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
            <?php include"includes/footer.php" ; ?> 