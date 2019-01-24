<?php 
   $user_id = $_SESSION['user_id'];
  if(isset($_POST['create_post'])){
	
	$title = filter_var(mysqli_real_escape_string($connection, trim($_POST['post_title'])), FILTER_SANITIZE_STRING);
	$category_id = $_POST['post_category'];
	$author = $_POST['post_author'];
	$user_id_query = "SELECT * FROM users WHERE user_name = '$author'";
	$user_id_result = mysqli_query($connection, $user_id_query);
	$result = mysqli_fetch_array($user_id_result);
	$user_id = $result['user_id'];
	
	
	
	$status = $_POST['post_status'];
	$img_name = $_FILES['post_image']['name'];
	$img_tmp = $_FILES['post_image']['tmp_name'];
	
	move_uploaded_file($img_tmp, "../images/{$img_name}");	
	$tags = filter_var(mysqli_real_escape_string($connection, trim($_POST['post_tags'])), FILTER_SANITIZE_STRING);
	$content = filter_var(mysqli_real_escape_string($connection, trim($_POST['post_content'])), FILTER_SANITIZE_STRING);
	$query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status, user_id) VALUES(?,?,?,now(),?,?,?,?,?)";
	$stmt = mysqli_prepare($connection, $query);
	mysqli_stmt_bind_param($stmt, 'issssssi', $category_id, $title, $author, $img_name, $content, $tags, $status, $user_id);
	if(!mysqli_stmt_execute($stmt)){
		die("Query failed" . mysqli_error($connection));
	} else {
		echo "<div class=''>Post Added Successfully </div>";
	}
	mysqli_stmt_close($stmt);
	
}

?>

<form method="post" action="" enctype="multipart/form-data">
    
	<div class="form-group">
	    <label for="post_title">Post Title</label>
		<input type="text" name="post_title" class="form-control">
	</div>
	<div class="form-group">
	    <label for="post_category">Category</label>
		<select name="post_category">
		    <?php 
			    $cat_query = "SELECT * FROM categories";
				$cat_result = mysqli_query($connection, $cat_query);
				while($row = mysqli_fetch_assoc($cat_result)){
					$cat_title = $row['cat_title'];
					$cat_id = $row['cat_id'];
					echo "<option value='{$cat_id}'>{$cat_title}</option>";
				}
			
			?>
		</select>
	</div>
	<div class="form-group">
	    <label for="post_category">Author</label>
		<select name="post_author">
		    <?php 
			    $user_query = "SELECT * FROM users";
				$user_result = mysqli_query($connection, $user_query);
				while($row = mysqli_fetch_assoc($user_result)){
					$user_id = $row['user_id'];
					$user_name = $row['user_name'];
					echo "<option value='{$user_name}'>{$user_name}</option>";
				}
			
			?>
		</select>
	</div>
	<div class="form-group">
	    <label for="post_status">Status</label>
		<select name="post_status">
		    <?php 
			    echo "<option value='draft'>Draft</option>";
		        echo "<option value='published'>Published</option>";
					
				
			
			?>
		</select>
	</div>
	<div class="form-group">
	    <label for="post_image">Post Image</label>
		<input type="file" name="post_image">
	</div>
	<div class="form-group">
	    <label for="post_tags">Post Tags</label>
		<input type="text" name="post_tags" class="form-control">
	</div>
	<div class="form-group">
	    <label for="post_content">Post Content</label>
		<textarea class="form-control" name="post_content"></textarea>
	</div>
	<div class="form-group">
	    <input type="submit" name="create_post" class="btn btn-primary" value="Add Post">
	</div>
</form>



