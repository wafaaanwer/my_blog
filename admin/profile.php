<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_nav.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-8">
                        <h1 class="page-header">
                            Welcome to Profile
                           
                        </h1>
						<?php if(isset($_SESSION['user_id'])){
							
							$user_id = $_SESSION['user_id'];
							$query = "SELECT user_name, user_password, user_firstname, user_lastname, user_email, user_image, role FROM users WHERE user_id=?";
							$stmt = mysqli_prepare($connection, $query);
							mysqli_stmt_bind_param($stmt, 'i', $user_id);
							if(! mysqli_stmt_execute($stmt)){
								die('Query Failed' . mysqli_error($connection));
							}
							mysqli_stmt_bind_result($stmt, $user_name, $user_password, $user_firstname, $user_lastname, $user_email, $user_image, $role);
							mysqli_stmt_fetch($stmt);
							mysqli_stmt_close($stmt);
							
							
	
}
	

?>
 <?php 
	if(isset($_POST['add_user'])){
		
		$the_user_id = $user_id;
		$user_name = $_POST['user_name'];
		$_SESSION['user_name'] = $_POST['user_name'];
	    $user_firstname = $_POST['user_firstname'];
		
		$user_lastname = $_POST['user_lastname'];
		$user_password = $_POST['user_password'];
		$user_email = $_POST['user_email'];
		$_SESSION['user_email'] = $_POST['user_email'];
		$user_img_tmp = $_FILES['file']['tmp_name'];
		$user_image = $_FILES['file']['name'];
		$_SESSION['user_image'] = $_FILES['file']['name'];
		move_uploaded_file($user_img_tmp, '../images/{$user_image}');
		
		
		$query_update = "UPDATE users SET user_name = ?, user_password = ?, user_firstname = ?, user_lastname = ?, user_email = ?, user_image = ? WHERE user_id = ?";
		$stmt_update = mysqli_prepare($connection, $query_update);
		mysqli_stmt_bind_param($stmt_update, 'ssssssi', $user_name, $user_password, $user_firstname, $user_lastname, $user_email, $user_image, $the_user_id);
		
		if(!mysqli_stmt_execute($stmt_update)){
			die("Query failed" . mysqli_error($connection));
	    } else {
			echo "<p class='bg-success'>User Successfully Updated</p>";
		}
		mysqli_stmt_fetch($stmt_update);
		mysqli_stmt_close($stmt_update);
		
		
		
		}
	?>

						<form method="post" action="" enctype="multipart/form-data">
							
							<div class="form-group">
								<label for="user_name">Username</label>
								<input type="text" name="user_name" class="form-control" value="<?php echo $user_name; ?>">
							</div>
							<div class="form-group">
								<label for="user_firstname">First Name</label>
								<input type="text" name="user_firstname" class="form-control" value="<?php echo $user_firstname?>">
							</div>
							<div class="form-group">
								<label for="user_lastname">Last Name</label>
								<input type="text" name="user_lastname" class="form-control" value="<?php echo $user_lastname?>">
							</div>
							<div class="form-group">
								<label for="user_password">Password</label>
								<input type="password" name="user_password" class="form-control" value="<?php echo $user_password?>">
							</div>
							<div class="form-group">
								<label for="user_email">Email</label>
								<input type="email" name="user_email" class="form-control" value="<?php echo $user_email?>">
							</div>
							<div class="form-group">
							    <input type="file" name="file"> <br>
								<?php 
						    if(!empty($user_image)){
							
							 echo '<img class="img-responsive" src="../images/{$user_image}" /> ';
							}
						?>
							</div>
							
							<div class="form-group">
								<input type="submit" name="add_user" class="btn btn-primary">
							</div>
							
						</form>


											   
                      
                    </div>
					<div class="col-lg-4">
					    
					   
					</div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        </div>
        <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php"; ?>


