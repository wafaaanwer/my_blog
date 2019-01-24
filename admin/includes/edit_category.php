            <?php
			    $cat_id = filter_var($_GET['cat_id'], FILTER_VALIDATE_INT);
				 $query = "SELECT cat_title from categories WHERE cat_id = ?";
									   $stmt_show = mysqli_prepare($connection, $query);
									   mysqli_stmt_bind_param($stmt_show, 'i', $cat_id);
									   confirm(mysqli_stmt_execute($stmt_show));
										mysqli_stmt_bind_result($stmt_show, $cat_title);
										
										mysqli_stmt_fetch($stmt_show);
										mysqli_stmt_close($stmt_show);
			?>
			<?php
			    if(isset($_POST['update_cat'])){
					$the_cat_id = $cat_id;
					 $cat_title = $_POST['category_title'];
					 $query = "UPDATE categories SET cat_title = ? WHERE cat_id = ?";
					 $update_stmt = mysqli_prepare($connection, $query);
					 
					 mysqli_stmt_bind_param($update_stmt, 'si', $cat_title, $the_cat_id);
					 
					 if(!mysqli_stmt_execute($update_stmt)){
						 die("Query Failed" . mysqli_error($connection));
					 } else {
						 echo "Updated";
					 }
					 
					 mysqli_stmt_fetch($update_stmt);
					 
					 mysqli_stmt_close($update_stmt);
					
				}
			?>
			
			
			<form method="post">
			            
						    <div class="form-group">
							    <input type="text" name="category_title" class="form-control" value="<?php echo $cat_title;?>">
								
							</div>
							 <div class="form-group">
							    
								<input type="submit" name="update_cat"  class="btn btn-primary">
							</div>
			</form>
							
						