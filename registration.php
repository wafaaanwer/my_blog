<?php 
    use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

		//Load Composer's autoloader
		
        include './vendor/autoload.php';
    include("includes/header.php");
	include("includes/nav.php");
	//include("includes/functions.php");
	
	 
	?>
	<?php
	   
	    $message = '';
	    if (isset($_POST['submit'])) {
			$length = 50;
			$token = bin2hex(openssl_random_pseudo_bytes($length));
			
			$username = trim($_POST['username']);
			$email = trim($_POST['email']);
			$password = trim($_POST['password']);
			
			
			$errors = [
				'username'=>'',
				'email'=>'',
				'password'=>''
			];
			
			
			if (empty($username)) {
				$errors['username'] = 'Username Can\'t be empty';
			}
			if (strlen($username) <=4 ) {
				$errors['username'] = 'Username Can\'t be less than 5';
			}
			if (email_exists($email)) {
				$errors['email'] = 'Please Enter another email, as this exists';
			}
			if (empty($email)) {
				$errors['email'] = 'Email Can\'t be empty';
			}
			
			if (empty($password)) {
				$errors['password'] = 'Password Can\'t be empty';
			}
		
		foreach($errors as $key => $value) {
			if(empty($value)) {
				unset($errors[$key]);
			}
		}
		if(empty($errors)) {
			$message = send_activation($username, $email, $password, $token);
							
			
		}
		   
		}
	
	?>

		<div class="container">
			<div class="row">
				<div class="col-xs-6 col-xs-offset-3">
				    <?php if($message == '') : ?>
				    <div class="myform">
						
								<h3 class="text-center">Register</h3>
						
					
					   
						<form role="form" action="registration.php" method="post" id="register-form" autocomplete="off">
							<div class="form-group">
								<label for="username" class="sr-only">username</label>
								<input type="text" name="username" id="username" class="form-control username" placeholder="Enter Desired Username" />
								<div class="alert alert-danger custom-alert">
								    Name can't be less than 5 character
							    </div>
							    <span class="asterisk">*</span>
									<?php  if (isset($errors['username'])) { ?>
								<div class='alert alert-danger alert-dismissible' role='alert'>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								   <?php echo  $errors['username'] ; 
									?>
								</div>
								<?php } else {
										echo '';
										}
								?>
							</div>
							
							
							 <div class="form-group">
								<label for="email" class="sr-only">Email</label>
								<input type="email" name="email" id="email" class="form-control email" placeholder="somebody@example.com" />
								<div class="alert alert-danger custom-alert">
								    Email can't be empty
							   </div>
							   <span class="asterisk">*</span>
										<?php  if (isset($errors['email'])) { ?>
									<div class='alert alert-danger alert-dismissible' role='alert'>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									   <?php echo  $errors['email'] ; 
										?>
									</div>
									<?php } else {
											echo '';
											}
									?>
							</div>
							
							
							 <div class="form-group">
								<label for="password" class="sr-only">Password</label>
								<input type="password" name="password" id="key" class="form-control password" placeholder="Password" />
								<div class="alert alert-danger custom-alert">
								    password can't be empty
							    </div>
							    <span class="asterisk">*</span>
								<?php  if (isset($errors['password'])) { ?>
								<div class='alert alert-danger alert-dismissible' role='alert'>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								   <?php echo  $errors['password'] ; 
									?>
								</div>
								<?php } else {
										echo '';
										}
								?>
							</div>
							
							
					
							<input type="submit" name="submit" id="btn-login" class="btn mybtn btn-lg btn-block" value="Submit">
						</form>
						
					</div>
					<?php else: ?>
					<div class="mydev">
					    <h4><?php echo $message; ?></h4>
					</div>
					<?php endif; ?>
				</div> <!-- /.col-xs-12 -->
			</div> <!-- /.row -->
		</div> <!-- /.container -->
		<?php
    include("includes/footer.php");

?>

    