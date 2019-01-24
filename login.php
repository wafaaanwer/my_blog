<?php 
    include("includes/header.php");
    include("includes/nav.php"); 
	include("includes/db.php");
	//include("includes/functions.php");
	
	
?>

<?php 
    if (isset($_POST['login'])) {
		$email = $_POST['email'];
		$password = $_POST['password'];
		login_user($email, $password);
		
		
	}


?>
<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
			  
				   
						<div class="myform">


							<h3>Login</h3>
							<div class="panel-body">


								<form id="login-form" role="form" autocomplete="off" class="form" method="post">

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>

											<input name="email" type="email" class="form-control" placeholder="Enter Username">
										</div>
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
											<input name="password" type="password" class="form-control" placeholder="Enter Password">
										</div>
									</div>

									<div class="form-group">

										<input name="login" class="btn mybtn btn-block" value="Login" type="submit">
									</div>


								</form>
								<a href="registration.php">Register</a> OR <a href="forgot.php">Forgot Password</a>

							

					</div>
				
				
				</div>
			
			
			
			</div>

        </div>
</div>
