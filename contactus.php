<?php 
    include("includes/header.php");
	include("includes/nav.php");

?>

    <?php 
	    if(isset($_POST['send'])){
		    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
			$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
			$mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT);
			$message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
			$errors = [
			'username' => '',
			'email' => '',
			'mobile' => '',
			'message' => '',
			];
			if (empty($name)) {
				$errors['username'] = 'Username can\'t be empty';
			}
			if (strlen($name) <= 4 && strlen($name)>=1) {
				$errors['username'] = 'Username can\'t be less than <strong>5</strong>';
			} 
			if (empty($email)) {
				$errors['email'] = 'Email can\'t be empty';
				
			}
			if (empty($mobile)) {
				$errors['mobile'] = 'Mobile can\'t be empty';
			}
			if (empty($message)) {
				$errors['message'] = 'message can\'t be empty';
			}
			if (strlen($message < 10)) {
				$errors['message'] = 'message can\'t be less than <strong>10</strong> characters';
				
			}
		    foreach($errors as $key => $value){
				if (empty($value)) {
					unset($errors[$key]);
				}
				
			}
			if (empty($errors)) {
				
		        $mymail = "wafaaanwer12@gmail.com";
	            $subject = "Contact form";
		        contactus($name, $email, $mobile, $message);
		 
				$name = '';
				$email = '';
				$mobile = '';
				$message = '';
				//$success = '<div class="alert alert-success">We Recievedyour message</div>';
				
			    
			}
			
		}
	
	?>
    <div class="container">
	    <div class="row">
		    <div class="col-md-6 col-md-offset-3">
			    <div class="mydev">
					<h3 class="text-center">Contact Us</h3>
					<form id="contact-form" action="contactus.php" method="post">
						<div class="form-group">
							<?php if(isset($success)){
							echo $success;
							}?>
							<input type="text" class="form-control username" name="name" placeholder="Type your name" value="<?php if(isset($name)) {echo $name;} ?>">
							<i class="glyphicon glyphicon-user"></i>
							<div class="alert alert-danger custom-alert">
								Username can't be less than <strong>5</strong>
							</div>
							<span class="asterisk">*</span>
							
							   <?php  if (isset($errors['username'])) { ?>
							   
								<div class='alert alert-danger alert-dismissible' role='alert'>
								 
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									<?php echo $errors['username']; ?>
								</div>
								<?php } else {
									echo '';}
									?>
						</div>
						
						<div class="form-group">
							<input type="email" class="form-control email" name="email" placeholder="Type your email" value="<?php if(isset($email)) {echo $email;} ?>">
							<i class="glyphicon glyphicon-envelope"></i>
							<div class="alert alert-danger custom-alert">
								Email can't be empty
							</div>
							<span class="asterisk">*</span>
							  <?php  if (isset($errors['email'])) { ?>
								
								<div class='alert alert-danger alert-dismissible' role='alert'>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							  <?php echo $errors['email']; ?>
								
							</div>
							  <?php } else {
									echo '';
									}
							?>
						</div>
						<div class="form-group">
							<input type="text" class="form-control mobile" name="mobile" placeholder="Type your mobile"  value="<?php if(isset($mobile)) {echo $mobile;} ?>">
							<i class="glyphicon glyphicon-phone"></i>
							<div class="alert alert-danger custom-alert">
								Mobile can't be empty
							</div>
							<span class="asterisk">*</span>
							<?php  if (isset($errors['mobile'])) { ?>
							
							<div class='alert alert-danger alert-dismissible' role='alert'>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							<?php echo  $errors['mobile']  ; 
								?>
							</div>
							
							<?php } else {
									echo '';
									}
							?>
						</div>
						
						<div class="form-group">
							<textarea class="form-control message" name="message" placeholder="Type your message">
								<?php if(isset($message)) {echo $message;} ?>
							</textarea>
							<div class="alert alert-danger custom-alert">
								message can't be less than 10 characters
							</div>
							<span class="asterisk">*</span>
							<?php  if (isset($errors['mobile'])) { ?>
							<div class='alert alert-danger alert-dismissible' role='alert'>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							   <?php echo  $errors['message'] ; 
								?>
							</div>
							<?php } else {
									echo '';
									}
							?>
							<input type="submit" name="send" class="btn mybtn btn-block" value="Send Messag">
							<i class="glyphicon glyphicon-send send-icon"></i>
						</div>
						
					
					</form>
				</div>
		 </div>
	</div>
	</div>

<?php
    include("includes/footer.php");

?>