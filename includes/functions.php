<?php 
    
	 
    function confirm($query){
		global $connection;
		if (!$query) {
			
			die("Query Failed" . mysqli_error($connection));
		}
		
	}
	function query($query){
		global $connection;
		return mysqli_query($connection, $query);
		
	}
	
	function userLikedThisPost($post_id){
		$likes_result = query("SELECT * FROM likes WHERE user_id=" . loggedInUserId() . " AND post_id=$post_id");
		//confirm($likes_result);
		return (mysqli_num_rows($likes_result) >= 1) ? true : false;
	}
	function redirect($location=''){
		header("Location: ".$location);
		exit;
	}
	 function isLoggedInUser() {
		if (isset($_SESSION['role'])) {
			return true;
		} else {
			return false;
		}
	}
	function loggedInUserId(){
		if(isLoggedInUser()){
		$result = query("SELECT * FROM  users WHERE user_name='" . $_SESSION['user_name'] . "'");
		confirm($result);
		$user = mysqli_fetch_array($result);
		//echo $user['user_email'];
		return mysqli_num_rows($result) >= 1 ? $user['user_id'] :  false;
			
		}
		return false;
	}
	function likesCount($post_id){
		 $likes_query = query("SELECT * FROM likes WHERE post_id=" . $post_id);
		  return $count = mysqli_num_rows($likes_query);
	}
    function email_exists($email){
		global $connection;
		$email = mysqli_real_escape_string($connection, $email);
		$query = "SELECT user_email FROM users WHERE user_email = '$email'";
		$query_result = mysqli_query($connection, $query);
		confirm($query_result);
		$count = mysqli_num_rows($query_result);
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}
	function user_name($username){
		global $connection;
		$username = mysqli_real_escape_string($connection, $username);
		$query = "SELECT user_name FROM users WHERE user_name = '$username'";
		$query_result = mysqli_query($connection, $query);
		confirm($query_result);
		$count = mysqli_num_rows($query_result);
		if ($count > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function register_user($username, $email, $password){
		global $connection;
		$username = mysqli_real_escape_string($connection, $username);
		$email = mysqli_real_escape_string($connection, $email);
		$password = mysqli_real_escape_string($connection, $password);
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);
		
		if(!empty($username) && !empty($email) && !empty($password)){
		$query = "INSERT INTO users(user_name, user_email ,user_password) VALUES('{$username}', '{$email}', '{$hashed_password}')";
		$query_result = mysqli_query($connection, $query);
		confirm($query_result);
		}
	}
	function is_admin($id){
		global $connection;
		if(isLoggedInUser()){
		$query = "SELECT role FROM users WHERE user_id=" . $_SESSION['user_id'] . "";
		$role_result = mysqli_query($connection, $query);
		confirm($role_result);
		$row = mysqli_fetch_array($role_result);
		if($row['role'] == 'admin'){
			return true;
		} else {
			return false;
		}
		}
		return false;
		
	}
	function is_author($id){
		global $connection;
		if(isLoggedInUser()){
		$query = "SELECT role FROM users WHERE user_id=" . $_SESSION['user_id'] . "";
		$role_result = mysqli_query($connection, $query);
		confirm($role_result);
		$row = mysqli_fetch_array($role_result);
		if($row['role'] == 'author'){
			return true;
		} else {
			return false;
		}
		}
		return false;
		
	}
	function is_subscriber($id){
		global $connection;
		if(isLoggedInUser()){
		$query = "SELECT role FROM users WHERE user_id=" . $_SESSION['user_id'] . "";
		$role_result = mysqli_query($connection, $query);
		confirm($role_result);
		$row = mysqli_fetch_array($role_result);
		if($row['role'] == 'subscriber'){
			return true;
		} else {
			return false;
		}
		}
		
		return false;
	}
	function login_user($email, $password){
		global $connection;
		$email = mysqli_real_escape_string($connection, trim($email));
		$password = mysqli_real_escape_string($connection, trim($password));
		$query = "SELECT * FROM users WHERE user_email = '$email'";
		$query_result = mysqli_query($connection, $query);
		confirm($query_result);
		$count = mysqli_affected_rows($connection);
		while($row = mysqli_fetch_assoc($query_result)){
				$db_id = $row['user_id'];
				$db_email = $row['user_email'];
				$db_username = $row['user_name'];
				$db_password = $row['user_password'];
				$db_firstname = $row['user_firstname'];
				$db_lastname = $row['user_lastname'];
				$db_image = $row['user_image'];
				$user_role = $row['role'];
			}
			$password = password_verify($password, $db_password);
			if($email == $db_email && $password == $db_password){
				
				$_SESSION['user_id'] = $db_id;
				$_SESSION['user_name'] = $db_username;
				$_SESSION['user_email'] = $db_email;
				$_SESSION['firstname'] = $db_firstname;
				$_SESSION['lastname'] = $db_lastname;
				$_SESSION['role'] = $user_role;
				$_SESSION['user_image'] = $db_image;
				if((is_admin($_SESSION['user_id']) == true) || is_author($_SESSION['user_id']) == true || is_subscriber($_SESSION['user_id']) == true){
				 redirect('../cms_mapping/admin');
				  return true;
			      
			   }
				 
				
			} else {
				   //redirect('index.php');
				   return false;
			   }
			}
	        
			
	
    function contactus($name, $email, $mobile, $message){
		$mymail = "wafaaanwer12@gmail.com";
	    $subject = "Contact form";
		
		$header = "From: " . $mail . "\r\n";
		
		$sent_mail = mail($mymail, $subject, $message, $header);
		
		if($sent_mail){
			$success = '<div class="alert alert-success">We Recievedyour message</div>';
	 } else {
		 $success = '<div class="alert alert-danger">Your mail wasn\'t sent</div>';
	 }
	}
	
		
    function send_activation($name, $email, $password, $token) {
	    global $connection;
		$message = "";
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
              <a href="http://localhost/cms_mapping/activated.php?email='.$email.'&token='.$token.'.&name='.$name.'&password='.$password.' ">http://localhost/cms_mapping/activated.php?email='.$email.'&token='.$token.'</a>

                    </p>';
		   if($mail->send()){
			 
			   $email_sent = true;
			 $message = "Thank You for Registration ,<br> Please Check your Email to activate your account";
			 return $message;
		   } else {
			   echo "Problem Occured";
		   }
		
		
	}
	
	
	?>