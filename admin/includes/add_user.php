<?php if(isset($_POST['add_user'])){
	$user_name = filter_var(mysqli_real_escape_string($connection, trim($_POST['user_name'])), FILTER_SANITIZE_STRING);
	$user_firstname = filter_var(mysqli_real_escape_string($connection, trim($_POST['user_firstname'])), FILTER_SANITIZE_STRING);
	$user_lastname = filter_var(mysqli_real_escape_string($connection, trim($_POST['user_lastname'])), FILTER_SANITIZE_STRING);
	$user_password = filter_var(mysqli_real_escape_string($connection, trim($_POST['user_password'])), FILTER_SANITIZE_STRING);
	$user_password = password_hash($user_password, PASSWORD_DEFAULT);
	$user_email = filter_var(mysqli_real_escape_string($connection, trim($_POST['user_email'])), FILTER_SANITIZE_STRING);
	$query = "INSERT INTO users(user_name, user_firstname, user_lastname, user_password, user_email) VALUES(?,?,?,?,?)";
	$stmt = mysqli_prepare($connection, $query);
	mysqli_stmt_bind_param($stmt, 'sssss', $user_name, $user_firstname, $user_lastname, $user_password, $user_email);
	if(!mysqli_stmt_execute($stmt)){
		die("Query failed" . mysqli_error($connection));
	} else {
		echo "<p class='bg-success'>User Added successfully</p>";
	}
	mysqli_stmt_close($stmt);
	
}

?>

<form method="post" action="" enctype="multipart/form-data">
    
	<div class="form-group">
	    <label for="user_name">Username</label>
		<input type="text" name="user_name" class="form-control">
	</div>
	<div class="form-group">
	    <label for="user_firstname">First Name</label>
		<input type="text" name="user_firstname" class="form-control">
	</div>
	<div class="form-group">
	    <label for="user_lastname">Last Name</label>
		<input type="text" name="user_lastname" class="form-control">
	</div>
	<div class="form-group">
	    <label for="user_password">Password</label>
		<input type="password" name="user_password" class="form-control">
	</div>
	<div class="form-group">
	    <label for="user_email">Email</label>
		<input type="password" name="user_email" class="form-control">
	</div>
	
	<div class="form-group">
	    <label for="user_role">Role</label>
		<select name="user_role">
		    <?php 
			    echo "<option value='admin'>Admin</option>";
		        echo "<option value='subscriber'>Subscriber</option>";
			
			?>
		</select>
	</div>
	<div class="form-group">
	    <input type="submit" name="add_user" class="btn btn-primary">
	</div>
	
</form>



