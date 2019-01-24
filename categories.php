    <?php
        include("includes/header.php");
         
		
    ?>

    <!-- Navigation -->
	
   <?php 
        include("includes/nav.php");
        include("includes/db.php");		
   
   ?>

    

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
			      
			
			    <?php
				    if(isset($_GET['category_id'])){
					$category_id = $_GET['category_id'];
				    $posts_per_page = 2;
					$all_posts = "SELECT * FROM posts WHERE post_status = 'published' AND post_category_id = '$category_id'";
					$all_posts_query = mysqli_query($connection, $all_posts);
					if (!$all_posts_query) {
						die("Query_failed" . mysqli_error());
					}
					$posts_count = mysqli_num_rows($all_posts_query);
					
					if($posts_count <1){
						
						echo "<div class='text-center'>
						    <h3>No Posts Was Found</h3>
						</div>";
					} else {
						
						
					
						
					
					while($row = mysqli_fetch_assoc($all_posts_query)){
						$post_id = $row['post_id'];
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
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_author; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>"><img class="img-responsive" src="images/<?php echo $post_image; ?>" alt=""></a>
                <hr>
                <p><?php echo $post_content;?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
				<?php }
					
					
					}
					
					
					}
				?>

               
               
               

            </div>
					

            <!-- Blog Sidebar Widgets Column -->
            <?php include("includes/sidebar.php");?>
        <!-- /.row -->

        <hr>

        <!-- Pager -->
                
	
     </div>
	</div>
	<?php include("includes/footer.php");
	?>