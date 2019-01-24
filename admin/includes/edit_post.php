<?php if(isset($_GET['p_id'])){
	
	$post_id = $_GET['p_id'];
	$post_id = filter_var(trim($_GET['p_id']), FILTER_SANITIZE_NUMBER_INT);
	$query = "SELECT post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status FROM posts WHERE post_id=?";
    $stmt = mysqli_prepare($connection, $query);
	mysqli_stmt_bind_param($stmt, 'i', $post_id);
	if(! mysqli_stmt_execute($stmt)){
		die('Query Failed' . mysqli_error($connection));
	}
	
	mysqli_stmt_bind_result($stmt, $post_category_id, $post_title, $post_author, $post_date, $post_image, $post_content, $post_tags, $post_status);
	mysqli_stmt_fetch($stmt);
	mysqli_stmt_close($stmt);
	
	
	
}
	

?>
 <?php 
	if(isset($_POST['submit'])){
		
		$the_post_id = $post_id;
		$post_category_id = $_POST['post_category'];
	    $post_title = $_POST['post_title'];
		$post_author = $_POST['post_author'];
		$user_id_query = "SELECT * FROM users WHERE user_name = '$post_author'";
	    $user_id_result = mysqli_query($connection, $user_id_query);
	    $result = mysqli_fetch_array($user_id_result);
	    $user_id = $result['user_id'];
		
		$post_date = 'now()';
		$post_status = $_POST['post_status'];
		$post_image = $_FILES['post_image']['name'];
		$img_tmp = $_FILES['post_image']['tmp_name'];
		
		move_uploaded_file($img_tmp, "../images/{$post_image}");	
		if(empty($post_image)){
			$img_query = "SELECT * FROM posts WHERE post_id = $the_post_id";
			$img_query_result = mysqli_query($connection, $img_query);
			$img_result = mysqli_fetch_array($img_query_result);
			$post_image = $img_result['post_image'];
			
		}
		$post_tags = $_POST['post_tags'];
		$post_content = $_POST['post_content'];
		$query_update = "UPDATE posts SET post_category_id = ?, post_title = ?, post_author = ?, post_date = now(), post_image = ?, post_content = ?, post_tags = ?, post_status = ?, user_id = ? WHERE post_id = ?";
		$stmt_update = mysqli_prepare($connection, $query_update);
		mysqli_stmt_bind_param($stmt_update, 'issssssii', $post_category_id, $post_title, $post_author, $post_image, $post_content, $post_tags, $post_status,  $user_id, $the_post_id);
		
		if(!mysqli_stmt_execute($stmt_update)){
			die("Query failed" . mysqli_error($connection));
	    } else {
			echo "<p class='bg-success'><a href='../post.php?p_id=$post_id'>view</a></p>";
		}
		//mysqli_stmt_bind_result($stmt_update, $post_category_id, $post_title, $post_author, $post_date, $post_image, $post_content, $post_tags, $post_status);
		mysqli_stmt_fetch($stmt_update);
		mysqli_stmt_close($stmt_update);
		
		
		
		
		}
	?>


<form method="post" action="" enctype="multipart/form-data">
   
	<div class="form-group">
	    <label for="post_title">Post Title</label>
		<input type="text" name="post_title" class="form-control" value="<?php echo $post_title;?>">
	</div>
	<div class="form-group">
	    <label for="post_category">Category</label>
		<select name="post_category">
		    <?php 
			    $cat_default = "SELECT cat_title FROM categories WHERE cat_id = {$post_category_id}";
				$cat_default_query = mysqli_query($connection, $cat_default);
				confirm($cat_default_query);
				$cat_result = mysqli_fetch_assoc($cat_default_query);
				echo "<option value='{$post_category_id}'>{$cat_result['cat_title']}</option>";
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
		<select name="post_status" value="<?php echo $post_status; ?>">
		   <option value='<?php echo $post_status; ?>'><?php echo $post_status; ?></option>;
		   <?php if($post_status == 'draft'){
			    echo "<option value='published'>Published</option>";
		   } else {
		        echo "<option value='draft'>Draft</option>";
		   }
			?>
			
		</select>
	</div>
	<div class="form-group">
	    <label for="post_image">Post Image</label>
		<img src="../images/<?php echo $post_image; ?>" width="100px">
		</br>
		<input type="file" name="post_image" src="../images/<?php echo $post_image; ?>">
	</div>
	<div class="form-group">
	    <label for="post_tags">Post Tags</label>
		<input type="text" name="post_tags" class="form-control" value="<?php echo $post_tags; ?>">
	</div>
	<div class="form-group">
	    <label for="post_content">Post Content</label>
		<textarea class="form-control" name="post_content" value="<?php echo $post_content; ?>">
		    <?php echo $post_content; ?>
		
		</textarea>
	</div>
	<div class="form-group">
	    <input type="submit" name="submit" class="btn btn-primary" value="Update Post">
	</div>
</form>
