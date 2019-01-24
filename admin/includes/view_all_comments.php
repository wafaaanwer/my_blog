<div class="row">
    <div class="col-lg-12">
	    <div class="table-responsive">
		    <table class="table">
			    <thead>
				    <tr>
					    <th>Id</th>
						<th>Author</th>
						<th>Author Email</th>
						<th>Content</th>
						<th>Status</th>
						<th>Date</th>
						
					</tr>
				
				
				
				</thead>
				<tbody>
				    <?php 
					    
					    if(isLoggedInUser() && $_SESSION['role'] == 'admin') {
						 
					    $comments_query_result = query("SELECT * FROM comments");
						confirm($comments_query_result);
						} elseif (isLoggedInUser() && $_SESSION['role'] == 'author'){
							$comments_query_result = query("SELECT * FROM comments INNER JOIN posts ON comments.comment_post_id = posts.post_id WHERE user_id = " . loggedInUserId() . "");
						    confirm($comments_query_result);
						}
						
						while($row = mysqli_fetch_assoc($comments_query_result)){
							$comment_id = $row['comment_id'];
							$comment_author = $row['comment_author'];
							$comment_email = $row['comment_email'];
							$comment_content = $row['comment_content'];
							$comment_status = $row['comment_status'];
							$comment_date = $row['comment_date'];
							
							echo "<tr>";
							echo "<td>{$comment_id}</td>";
							echo "<td>{$comment_author}</td>";
							echo "<td>{$comment_email}</td>";
							echo "<td>{$comment_content}</td>";
							echo "<td>{$comment_status}</td>";
							echo "<td>{$comment_date}</td>";
							echo "<td><a href='comments.php?status=Approved&comment_id={$comment_id}'>Approved</a></td>";
							echo "<td><a href='comments.php?status=Unapproved&comment_id={$comment_id}'>Unapproved</a></td>";
							?>
							<form method="post">
							    <input type="hidden" name='comment_id' value="<?php echo $comment_id; ?>" >
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
					$id = $_POST['comment_id'];
					$query = "DELETE FROM comments WHERE comment_id = ?";
					$stmt = mysqli_prepare($connection, $query);
					mysqli_stmt_bind_param($stmt, "i", $id);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
					redirect("comments.php");
					
					
				}
				if(isset($_GET['status'])){
					$id = $_GET['comment_id'];
					$comment_status = $_GET['status'];
					$query = "UPDATE comments SET comment_status = ? WHERE comment_id = ?";
					$stmt = mysqli_prepare($connection, $query);
					mysqli_stmt_bind_param($stmt, 'si', $comment_status, $id);
					confirm(mysqli_stmt_execute($stmt));
					redirect('comments.php');
				}
						
			?>
			
	    </div>
	<div>
</div>