<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_nav.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small><?php echo $_SESSION['user_name']; ?></small>
							<?php $user_id = $_SESSION['user_id']; ?>
                        </h1>
				  </div>
                </div>
                       
                       <?php 
					       if(isset($_GET['source'])){
							   $source = $_GET['source'];
							   
						   } else {
							   $source = '';
						   }
						   switch($source){
							   case('edit_post'):
							   include("includes/edit_post.php"); 
							   break;
							   case('add_post'):
							   include("includes/add_post.php");
							   break;
							   default:
							   include("includes/view_all_posts.php");
							   
						   }
					   ?>
                        	
                  
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        </div>
        <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php"; ?>