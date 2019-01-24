
<?php  include "includes/header.php"; ?>
<?php include "includes/nav.php"; ?>
<?php 
   $message = "";
   if(isset($_GET['email']) && isset($_GET['token']) && isset($_GET['name']) && isset($_GET['password'])){
	   
		$token = $_GET['token'];
		$email = $_GET['email'];
		$password = $_GET['password'];
		$password = password_hash($password, PASSWORD_DEFAULT);
		$name = $_GET['name'];
		register_user($name, $email, $password);
		$message = "<h2 class='text-center'>Your Account Activated now</h2>";
	    login_user($email, $password);
		
		
		
	}
?>


<!-- Page Content -->
<div class="container">

    
    
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
               
                        
                        <div class="text-center mydev">
						           <?php echo $message;?>
								   
								   <a href="login.php" class="btn mybtn">Login</a>

                        </div>
						
                    
               
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>



