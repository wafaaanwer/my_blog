<?php
    include("includes/header.php");
	
	?>
	<?php
	include("includes/nav.php");
	include("includes/db.php");
	
?>
     

        <div class="container">
		    <div class="row">
				<div class="col-md-8">
						<?php  
						if (isset($_POST['send'])) {
							
							$search = $_POST['search'];
							$query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
							$query_result = mysqli_query($connection, $query);
							
							if (!$query_result) {
								die("Failed to select" . mysqli_error($connection));
							}
						
						$count = mysqli_num_rows($query_result);
						
						if ($count <1 ) {
							echo "<h3>No Result Found for " . $search . "</h3>";
						}
						else {
					
					
						
						while($row = mysqli_fetch_assoc($query_result)){
									$post_category_id = $row['post_category_id'];
									$post_title = $row['post_title'];
									$post_author = $row['post_author'];
									$post_date = $row['post_date'];
									$post_image = $row['post_image'];
									$post_content = $row['post_content'];
									
									?>
									
									
								

							<h1 class="page-header">
								Page Heading
								<small>Secondary Text</small>
							</h1>

							<!-- First Blog Post -->
							<h2>
								<a href="#"><?php echo $post_title; ?></a>
							</h2>
							<p class="lead">
								by <a href="index.php"><?php echo $post_author; ?></a>
							</p>
							<p><span class="glyphicon glyphicon-time"></span> <?php echo $post_author; ?></p>
							<hr>
							<img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
							<hr>
							<p><?php echo $post_content;?></p>
							<a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

							<hr>
							<?php }
								
								
								}
							?>

				 </div>
				 
					 <!-- Blog Sidebar Widgets Column -->
                     <?php include("includes/sidebar.php");?>
               				 
				   
				   

            </div>
					

           
        <!-- /.row -->
		
		<?php } ?>
		<?php include("includes/footer.php");
	     ?>

	
	
	
