<div class="row">
    <div class="col-lg-12">
	    <div class="table-responsive">
		    <table class="table">
			    <thead>
				    <tr>
					    <th>Id</th>
						<th>Title</th>
						<th>Author</th>
						<th>Category</th>
						<th>Status</th>
						<th>Image</th>
						<th>Tags</th>
						<th>Comments</th>
						<th>Date</th>
						<th>Post View Count</th>
					</tr>
				
				
				
				</thead>
				<tbody>
				    <?php 
					    if(isLoggedInUser() && $_SESSION['role'] == 'admin') {
					    $post_query = "SELECT * FROM posts";
						$post_query_result = mysqli_query($connection, $post_query);
						confirm($post_query_result);
						} elseif (isLoggedIn() && $_SESSION['role'] == 'author') { 
						$post_query_result = query("SELECT * FROM posts WHERE user_id = " . loggedInUserId() . "");
						 confirm($post_query_result);
						}
						
						while($row = mysqli_fetch_assoc($post_query_result)){
							$id = $row['post_id'];
							$title = $row['post_title'];
							$author = $row['post_author'];
							$category_id = $row['post_category_id'];
							$status = $row['post_status'];
							$image = $row['post_image'];
							$tags = $row['post_tags'];
							$comments_count = $row['post_comment_count'];
							$date = $row['post_date'];
							$views = $row['post_views_count'];
							
							$category_query = "SELECT * FROM categories WHERE cat_id = {$category_id}";
							$category_query_result = mysqli_query($connection, $category_query);
							confirm($category_query_result);
							$result = mysqli_fetch_assoc($category_query_result);
							$cat_title = $result['cat_title'];
							
							echo "<tr>";
							echo "<td>{$id}</td>";
							echo "<td>{$title}</td>";
							echo "<td>{$author}</td>";
							echo "<td>{$cat_title}</td>";
							echo "<td>{$status}</td>";
							echo "<td><img src='../images/{$image}' width='100px'></td>";
							echo "<td>{$tags}</td>";
							echo "<td>{$comments_count}</td>";
							echo "<td>{$date}</td>";
							echo "<td>{$views}</td>";
							echo "<td><a href='posts.php?source=edit_post&p_id={$id}'>Edit</a></td>";
							?>
							<form method="post">
							    <input type="hidden" name='post_id' value="<?php echo $id; ?>" >
								<td><input type="submit" name="delete" value="delete" class="btn btn-danger"></td>
							</form>
							<?php
							    
							   
							    echo "</tr>";
							
						}
						
					?>
				   
				
				</tbody>
				
			
			
		    </table>
			<?php 
			    if(isset($_POST['delete'])){
					$id = $_POST['post_id'];
					$query = "DELETE FROM posts WHERE post_id = ?";
					$stmt = mysqli_prepare($connection, $query);
					mysqli_stmt_bind_param($stmt, "i", $id);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
					redirect("posts.php");
					
					
				}
			?>
			
	    </div>
	<div>
</div>