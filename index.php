    <?php
        include("includes/header.php");
        
		ob_start();
    ?>

    <!-- Navigation -->
	
   <?php 
        include("includes/nav.php");
       
         
   ?>
   
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
			
			    <?php 
				    $posts_per_page = 2;
					$all_posts = "SELECT * FROM posts WHERE post_status = 'published'";
					$all_posts_query = mysqli_query($connection, $all_posts);
					if (!$all_posts_query) {
						die("Query_failed" . mysqli_error());
					}
					$posts_count = mysqli_num_rows($all_posts_query);
					
					if($posts_count <1){
						
						echo "<h3>No Posts Was Found</h3>";
					} else {
						
						$posts_count = ceil($posts_count / $posts_per_page );
					
					
					if (isset($_GET['page']) && !empty($_GET['page'])) {
						
					   $page = filter_var(mysqli_real_escape_string($connection, trim($_GET['page'])), FILTER_SANITIZE_NUMBER_INT);
						
					} else {
						
						$page = 1;
					}
					
				    $start_post_index = ($page * $posts_per_page) - $posts_per_page;
					
					$status = 'published';
					$query = "SELECT post_id, post_category_id, post_title, post_author, post_date, post_image, post_content  FROM posts WHERE post_status = ? ";
					$query .= "ORDER BY post_id DESC LIMIT $start_post_index, $posts_per_page ";
					$stmt = mysqli_prepare($connection, $query);
					mysqli_stmt_bind_param($stmt, 's', $status);
					confirm(mysqlI_stmt_execute($stmt));
					mysqli_stmt_store_result($stmt);
					
					$count = mysqli_stmt_num_rows($stmt);
					
					if($count < 1){
						redirect('index.php');
					}
					mysqli_stmt_bind_result($stmt, $post_id, $post_category_id, $post_title, $post_author, $post_date, $post_image, $post_content);
					while(mysqli_stmt_fetch($stmt)){;
					
						?>
						
						
				<div class="card">	
				   
				    <div class="image">
					    <a href="post.php?p_id=<?php echo $post_id; ?>"><img class="img-responsive" src="images/<?php echo $post_image; ?>" alt=""></a>
					</div>
					<div class="content">
							
						 <h2>
							<a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
						</h2>
						<p class="lead">
							by <a href="index.php"><?php echo $post_author; ?></a>
						</p>
						<p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
						
						<p class="mycontent"><?php echo substr($post_content, 0, 200);?></p>
						<a class="btn mybtn" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
					
					</div>

					<!-- First Blog Post -->
					
					
					
				</div>
				<?php }
					
					}
					
				?>

               
               
               

            </div>
					

            <!-- Blog Sidebar Widgets Column -->
            <?php include("includes/sidebar.php");?>
        <!-- /.row -->

        <hr>

       
	
     </div>
	</div>
	<div class="container">
	    <div class="row">
		     <!-- Pager -->
                <ul class="pager">
				    <?php 
					    if ($page > 1) {
							
							echo "<li><a href='index.php?page=" . ($page-1) . "' class='button'>Previous</a></li>";
						}
						for ($i=1; $i<=$posts_count; $i++){
							if($i == $page){
								echo "<li><a href='index.php?page=$i' class='active_link'>$i</a></li>";
							} else {
								echo "<li><a href='index.php?page=$i'>$i</a></li>";
								
							}
							
						}
						 if ($page <= $posts_count) {
							
							echo "<li><a href='index.php?page=" . ($page+1 ). "' class='button'>Next</a></li>";
						}
					
					
					?>
					
 
                </ul>
		</div>
	</div>
	<?php include("includes/footer.php");
	 
	?>