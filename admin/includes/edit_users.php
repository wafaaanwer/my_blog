<?php if(isset($_GET['user_id'])){
	
	$user_id = $_GET['user_id'];
	$user_id = filter_var(trim($_GET['user_id']), FILTER_SANITIZE_STRING);
	$query = "SELECT user_name, user_password, user_firstname, user_lastname, user_email, role FROM users WHERE user_id=?";
    $stmt = mysqli_prepare($connection, $query);
	mysqli_stmt_bind_param($stmt, 'i', $user_id);
	if(! mysqli_stmt_execute($stmt)){
		die('Query Failed' . mysqli_error($connection));
	}
	mysqli_stmt_bind_result($stmt, $user_name, $user_password, $user_firstname, $user_lastname, $user_email, $role);
	mysqli_stmt_fetch($stmt);
	mysqli_stmt_close($stmt);
	
	
	
}
	

?>
 <?php 
	if(isset($_POST['add_user'])){
		
		$the_user_id = $user_id;
		$user_name = $_POST['user_name'];
	    $user_firstname = $_POST['user_firstname'];
		
		$user_lastname = $_POST['user_lastname'];
		$user_password = $_POST['user_password'];
		$user_email = $_POST['user_email'];
		$role = $_POST['user_role'];
		
		$query_update = "UPDATE users SET user_name = ?, user_password = ?, user_firstname = ?, user_lastname = ?, user_email = ?, role = ? WHERE user_id = ?";
		$stmt_update = mysqli_prepare($connection, $query_update);
		mysqli_stmt_bind_param($stmt_update, 'ssssssi', $user_name, $user_password, $user_firstname, $user_lastname, $user_email, $role, $the_user_id);
		
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
	    <label for="user_role">Role</label>
		<select name="user_role">
		       <option value='<?php echo $role;?>'><?php echo $role;?></option>
		    <?php 
			    if($role == 'author'){
			     echo "<option value='admin'>Admin</option>";
				 
				} else {
		        echo "<option value='author'>Author</option>";
				}
			?>
		</select>
	</div>
	<div class="form-group">
	    <input type="submit" name="add_user" class="btn btn-primary">
	</div>
	
</form>

