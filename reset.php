
<?php  include "includes/header.php"; ?>
<?php include "includes/nav.php"; ?>
<?php 
   $message = "";
   if(isset($_GET['email']) && isset($_GET['token'])){
	   
		$token = $_GET['token'];
		$email = $_GET['email'];
		
		$query = "SELECT user_name, user_email, token FROM users WHERE token = ?";
		$stmt = mysqli_prepare($connection, $query);
		mysqli_stmt_bind_param($stmt, 's', $token);
		confirm(mysqli_stmt_execute($stmt));
		mysqli_stmt_bind_result($stmt, $user_name, $user_email, $token);
		mysqli_stmt_fetch($stmt);
		echo $user_name;
		mysqli_stmt_close($stmt);
		
		} else {
			redirect('index.php');
		}
		
	//}
?>
<?php 
    $verified = false;
    if(isset($_POST['update'])){
		$password = $_POST['password'];
		$confirm = $_POST['confirm'];
		if($password == $confirm){
			$password = password_hash($password, PASSWORD_DEFAULT);
			$update_query = "UPDATE users SET user_password = ?, token = ' ' WHERE user_email = ?";
			$update_stmt = mysqli_prepare($connection, $update_query);
			mysqli_stmt_bind_param($update_stmt, 'ss', $password, $user_email);
			confirm(mysqli_stmt_execute($update_stmt));
			mysqli_stmt_close($update_stmt);
			
		} else {
			 echo "<h3 class='alert alert-danger'>Password is not the same</h3>";
		}
	}
?>

<!-- Page Content -->
<div class="container">

    
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
               
                        
                        <div class="text-center mydev">
						           <?php if(!$verified): ?>
						           <h3>Change Password</h3>

                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                                <input name="password" placeholder="New Password" class="form-control"  type="password">
                                            </div>
                                        </div>
										 <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-ok-circle"></i></span>
                                                <input name="confirm" placeholder="Confirm Password" class="form-control"  type="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="update" class="btn btn-lg mybtn btn-block" value="Submit" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>


                        </div>
						<?php else: ?>
						<h3>Your Password has been updated <a href='login.php'>Login</a><h3>
						<?php endif; ?>
                    
               
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

