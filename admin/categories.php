<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_nav.php";?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small>Author</small>
                        </h1>
                    </div>
			    </div>
				
			</div>
			<div class="container-fluid">
			    <div class="row">
					<div class="col-md-6">
					    <?php 
						    if(isset($_POST['add_category'])){
								$category = $_POST['category'];
								if(empty($category) || $category == ""){
									echo "<p class='alert alert-danger'> Category can't be empty<p>";
								} else {
									$query_insert = "INSERT INTO categories(cat_title) VALUES (?)";
									$stmt_insert = mysqli_prepare($connection, $query_insert);
									mysqli_stmt_bind_param($stmt_insert, "s", $category);
									confirm(mysqli_stmt_execute($stmt_insert));
									mysqli_stmt_execute(stmt_insert);
									redirect("categories.php");
								}
							}
						?>
					    <form method="post">
						    <div class="form-group">
							    <input type="text" name="category" class="form-control">
								
							</div>
							 <div class="form-group">
							    
								<input type="submit" name="add_category"  class="btn btn-primary">
							</div>
						</form>
						<?php  if(isset($_GET['cat_id'])){
							include("includes/edit_category.php");
						}
							
						?>
						
                      
	                   
                    </div>	
					<div class="col-md-6">
					    <div class="table-responsive">
						    <table class="table">
							    <thead>
								    <th>Id</th>
									<th>Category Title</th>
									
								</thead>
								<tbody>
								    <?php
									 
									    $query = "SELECT cat_id, cat_title from categories";
									   
										$stmt = mysqli_prepare($connection, $query);
										confirm(mysqli_stmt_execute($stmt));
										mysqli_stmt_bind_result($stmt, $cat_id, $cat_title);
										
										while(mysqli_stmt_fetch($stmt)){
											echo "<tr>";
											echo "<td>{$cat_id}</td>";
											echo "<td>{$cat_title}</td>";
											echo "<td><a href='categories.php?cat_id={$cat_id}'>Edit</a></td>";
											echo "<td>"
											?>
											<form method="post">
											    <input type="hidden" name="cat_id" value="<?php echo $cat_id ;?>">
												<input type="submit" class="btn btn-danger" name="delete" value="Delete">
											
											</form>
											<?php
											echo "</td>";
											echo "</tr>";
										}
										mysqli_stmt_close($stmt);
									?>
								
								</tbody>
								
							</table>
							<?php 
							    if(isset($_POST['delete'])){
									$id = $_POST['cat_id'];
									$query = "DELETE FROM categories WHERE cat_id = ?";
									$stmt = mysqli_prepare($connection, $query);
									mysqli_stmt_bind_param($stmt, "i", $id);
									confirm(mysqli_stmt_execute($stmt));
									mysqli_stmt_close($stmt);
									redirect("categories.php");
					
								}
							?>
							
						
						</div>
						
					 
                    </div>	
						
						
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        
        </div>
        <!-- /#page-wrapper -->
		
 <?php include("includes/admin_footer.php"); ?>