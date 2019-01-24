
<?php  include "includes/header.php"; ?>
<?php  include "includes/nav.php"?>

<?php 
     use PHPMailer\PHPMailer\PHPMailer;
     use PHPMailer\PHPMailer\Exception;

      require 'vendor/autoload.php'; 
      require './classes/config.php';

?>
<!-- Page Content -->
<?php 
   
	

	
	if(isset($_POST['recover-submit'])){
		$email = $_POST['email'];
		$length = 50;
		$token = bin2hex(openssl_random_pseudo_bytes($length));
		if(email_exists($email)){
			$query = "UPDATE users SET token = ? WHERE user_email = ?";
			$stmt = mysqli_prepare($connection, $query);
			mysqli_stmt_bind_param($stmt, "ss", $token, $email);
			confirm(mysqli_stmt_execute($stmt));
			mysqli_stmt_close($stmt);
			$mail = new PHPMailer();
			                      
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = Config::SMTP_HOST;  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = Config::SMTP_USER;                 // SMTP username
			$mail->Password = Config::SMTP_PASSWORD;                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = Config::SMTP_PORT;                                    // TCP port to connect to
			 $mail->isHTML(true);        
            
             $mail->CharSet = 'UTF-8';			 
			 $mail->setFrom('wafaaanwer12@gmail.com', 'wafaa');
			$mail->addAddress($email);
			$mail->Body = '<p>Please click to reset your password
              <a href="http://localhost/cms_mapping/reset.php?email='.$email.'&token='.$token.' ">http://localhost/cms_mapping/reset.php?email='.$email.'&token='.$token.'</a>

                    </p>';
		   if($mail->send()){
			 
			   $email_sent = true;
		   } else {
			   echo "Problem Occured";
		   }
		
	}
	}
?>

   
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="myform">
                   
                        <div class="text-center">
						<?php if(!isset($email_sent)): ?>


                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">




                                    <form id="" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg mybtn btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->
								<?php else: ?>
								<h3>Please Check Your Email</h3>
								<?php endif;?>

                       
                    </div>
                </div>
            </div>
        </div>
   



</div> <!-- /.container -->

