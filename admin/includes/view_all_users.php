<div class="row">
    <div class="col-lg-12">
	    <div class="table-responsive">
		    <table class="table">
			    <thead>
				    <tr>
					    <th>Id</th>
						<th>Name</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>
						<th>Role</th>
						
					</tr>
				
				</thead>
				<tbody>
				    <?php 
					    $user_query = "SELECT * FROM users";
						$user_query_result = mysqli_query($connection, $user_query);
						confirm($user_query_result);
						while($row = mysqli_fetch_assoc($user_query_result)){
							$id = $row['user_id'];
							$user_name = $row['user_name'];
							$user_firstname = $row['user_firstname'];
							$user_lastname = $row['user_lastname'];
							$user_email = $row['user_email'];
							$role = $row['role'];
							
							echo "<tr>";
							echo "<td>{$id}</td>";
							echo "<td>{$user_name}</td>";
							echo "<td>{$user_firstname}</td>";
							echo "<td>{$user_lastname}</td>";
							echo "<td>{$user_email}</td>";
							echo "<td>{$role}</td>";
							if(isLoggedInUser() && $_SESSION['role'] == 'admin'){
							echo "<td><a href='users.php?source=edit_user&user_id={$id}'>Edit</a></td>";
							echo "<td><a href='users.php?role=admin&user_id={$id}'>Admin</a></td>";
							echo "<td><a href='users.php?role=subscriber&user_id={$id}'>Subscriber</a></td>";
							echo "<td><a href='users.php?role=author&user_id={$id}'>Author</a></td>";
							
							?>
							<form method="post">
							    <input type="hidden" name='post_id' value="<?php echo $id; ?>" >
								<td><input type="submit" name="delete" value="delete" class="btn btn-danger"></td>
							</form>
							<?php
							    
							}
							    echo "</tr>";
							
						}
						
					?>
				   
				
				</tbody>
				
		    </table>
			<?php 
			    if(isset($_POST['delete'])){
					$id = $_POST['post_id'];
					$query = "DELETE FROM users WHERE user_id = ?";
					$stmt = mysqli_prepare($connection, $query);
					mysqli_stmt_bind_param($stmt, "i", $id);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_close($stmt);
					redirect("users.php");
					
					
				}
				if(isset($_GET['role'])){
					$role = $_GET['role'];
					$user_id = $_GET['user_id'];
					$query = "UPDATE users SET role = ? WHERE user_id = ?";
					$stmt = mysqli_prepare($connection, $query);
					mysqli_stmt_bind_param($stmt, 'si', $role, $user_id);
					confirm(mysqli_stmt_execute($stmt));
					redirect('users.php');
				}
			?>
			
	    </div>
	<div>
</div>