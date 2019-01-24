
<?php include('includes/header.php');
      include('includes/nav.php');
	
?>

    <!-- Page Content -->
    <div class="container">
	<?php
	    if(isset($_POST['liked'])){
			/*
			steps:
			1-select post
			2-update post with likes
			3- create likes for the post
			*/
			$post_id = $_POST['post_id'];
			$user_id = $_POST['user_id'];
			$query = "SELECT * FROM posts WHERE post_id = $post_id";
			$post_result = mysqli_query($connection, $query);
			$post = mysqli_fetch_array($post_result);
			$likes = $post['likes'];
			if(mysqli_num_rows($post_result) >= 1){
				echo $_POST['post_id'];
			}
			$likes_update = mysqli_query($connection, "UPDATE posts SET likes = $likes+1 WHERE post_id = $post_id");
			if(!$likes_update){
				die("Query Failed" . mysqli_error($connection));
			}
			mysqli_query($connection, "INSERT INTO likes(user_id, post_id) VALUES($user_id, $post_id)");
			
		}
		 if(isset($_POST['unliked'])){
			/*
			steps:
			1-select post
			2-update post with likes
			3- delete the like from the likes table
			*/
			$post_id = $_POST['post_id'];
			$user_id = $_POST['user_id'];
			$query = "SELECT * FROM posts WHERE post_id = $post_id";
			$post_result = mysqli_query($connection, $query);
			$post = mysqli_fetch_array($post_result);
			$likes = $post['likes'];
			if(mysqli_num_rows($post_result) >= 1){
				echo $_POST['post_id'];
			}
			$likes_update = mysqli_query($connection, "UPDATE posts SET likes = $likes-1 WHERE post_id = $post_id");
			if(!$likes_update){
				die("Query Failed" . mysqli_error($connection));
			}
			mysqli_query($connection, "DELETE FROM likes where user_id=$user_id AND post_id=$post_id");
			exit();
		}
	
	?>

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">
                <?php 
				    $message = "";
				    if(isset($_GET['p_id']) && !empty($_GET['p_id'])){
						
						$post_id = $_GET['p_id'];
						
						$stmt = mysqli_prepare($connection, "SELECT post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count FROM posts WHERE post_id = ?");
						if(!$stmt){
							die('Query Failed' . mysqli_error($connection));
						}
						mysqli_stmt_bind_param($stmt,'i',$post_id);
						mysqli_stmt_execute($stmt);
						
						mysqli_stmt_store_result($stmt);
						$count = mysqli_stmt_num_rows($stmt);
						
						mysqli_stmt_bind_result($stmt, $post_category_id, $post_title, $post_author, $post_date, $post_image, $post_content, $post_tags, $post_comment_count);
						mysqli_stmt_fetch($stmt);
						
                        if($count < 1) {
						    redirect('index.php');
						} 


						
						mysqli_stmt_close($stmt);
						
						
						
					?>
					
                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $post_title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="author.php"><?php echo $post_author; ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?> </p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead">
				   
				    <?php echo $post_content; ?> 
				</p>
				<?php 
				    if(isLoggedInUser()){
				?>
						
					<div class="row">
				       <p class="pull-right"><a class="<?php echo userLikedThisPost($post_id) ? 'unlikes' : 'likes' ;?>" data-toggle="tooltip" data-placement="top" title="<?php echo userLikedThisPost($post_id) ? 'I liked this before' : 'Want to like this post' ;?>" href=""><span class="glyphicon glyphicon-thumbs-up"></span><?php echo userLikedThisPost($post_id) ? ' unlike' : ' like' ;?> </a></p>
			        </div>
				
				<?php } else { 
				
				?>
				
				 <div class="row">
				       <p class="pull-right"> You need to logged In to like <a href="login.php">LogIn</a></p>
			        </div>
				<?php } ?>
				 <div class="row">
				    
				     <p class="pull-right likes">Likes: <?php echo likesCount($post_id); ?></p>
			     </div>
				
				
				 <div class="clearfix">
				 </div>
				
               
                <hr>
				 
				 <?php } else {
						//echo "can't be empty";
						    redirect('index.php');
					}
				?>
                	<!-- Comments -->
			<?php //include('comments.php');?>
			               
                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
				
				    <?php if(isset($_POST['create_comment']) && isLoggedInUser()){
						$name = isset($_POST['comment_author']) ? $_POST['comment_author'] : false;
						$email = isset($_POST['comment_email']) ? $_POST['comment_email'] : false;
						$comment = isset($_POST['comment']) ? $_POST['comment'] : false;
			
						$name = mysqli_real_escape_string($connection, trim($name));
						$email = mysqli_real_escape_string($connection, trim($email));
						$comment = mysqli_real_escape_string($connection, trim($comment));
						$author_name = filter_var($name, FILTER_SANITIZE_STRING);
						$author_email = filter_var($email, FILTER_SANITIZE_STRING);
						$author_comment = filter_var($comment, FILTER_SANITIZE_STRING);
						
						$user_id = $_SESSION['user_id'];
						$user_image = $_SESSION['user_image'];
						if($name == true && $email == true && $comment == true){
						$stmt1 = mysqli_prepare($connection, "INSERT INTO comments (user_id, user_image, comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES (?,?,?,?,?,?,?,now()) ");
						/*if(!$stmt1){
							die('Query failed' . mysqli_error($connection));
						} 
						*/
						
						
						
						$status = 'Approaved';
						$date = 'now()';
						mysqli_stmt_bind_param($stmt1, 'isissss', $user_id, $user_image, $post_id, $author_name, $author_email, $author_comment, $status);
				
						if(!mysqli_stmt_execute($stmt1)){
							die('Query failed' . mysqli_error($connection));
						} 
						
						mysqli_stmt_close($stmt1);
						redirect($_SERVER['REQUEST_URI']);
						} else {
							echo "<div class='alert alert-danger'><p>can't insert empty field</p></div>";
						}
					} 
						?>
				   
                    <h4>Leave a Comment:</h4>
					 <?php if(!isLoggedInUser()){ ?>
                    <form role="form" method="post" action="" id="comment-form">
                         <div class="form-group">
                            <label for="comment_author">Name</label>
                            <input class="form-control" type="text" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label for="comment_email">email</label>

                            <input class="form-control" type="email" name="comment_email">
                        </div>
						
                        <div class="form-group">
                            <label for="comment">Comment</label>

                            <textarea class="form-control comment" name="comment" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn mybtn">Submit</button>
                    </form>
					<br>
					<p>You need to <a href="login.php">Login </a>to leave a comment</p>
					 <?php } else {
					 ?>
					 
					<form role="form" method="post" action="" >
                         <div class="form-group">
                            <label for="comment_author">Name</label>
                            <input class="form-control" type="text" name="comment_author" value="<?php echo $_SESSION['user_name']?>">
                        </div>
                        <div class="form-group">
                            <label for="comment_email">email</label>

                            <input class="form-control" type="email" name="comment_email" value="<?php echo $_SESSION['user_email']?>">
                        </div>
					 <?php if($_SESSION['user_image'] == ''){?>
					    <img src = "https://via.placeholder.com/150">
					 <?php } else {?>
						<img  height="50px" width="50px" src="images/<?php echo $_SESSION['user_image'] ;?>" class="img-responsive"/>
					 <?php } ?>
                        <div class="form-group">
                            <label for="comment">Comment</label>

                            <textarea class="form-control" name="comment" rows="3" class="comment"></textarea>
                        </div>
						<div class="alert alert-danger custom-alert">
						   <p>Comment can't be empty</p>
						</div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
					
					 <?php } ?>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
				<?php 
				   $query = "SELECT comment_author, comment_content, comment_date, user_image FROM comments WHERE comment_post_id = ?";
				   $stmt2 = mysqli_prepare($connection, $query);
				   mysqli_stmt_bind_param($stmt2, 'i', $post_id);
				    mysqli_stmt_execute($stmt2);
				   mysqli_stmt_bind_result($stmt2, $comment_author, $comment_content, $comment_date, $user_image);
				   while(mysqli_stmt_fetch($stmt2)){
					  
				   ?>
				
                <div class="media">
				    <?php if(($user_image) == " "): ?>
					<img src="https://via.placeholder.com/50" />
                   <?php else: ?>
                    <img class="img-responsive" height="50px" width="50px" src="images/<?php echo $user_image; ?>" alt="">
                    <?php endif; ?>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author;?> </h4>
                        <p> <small> <?php echo $comment_date; ?></small></p>
                       
						<p><?php echo $comment_content; ?></p>
						
                    </div>
					
                </div>
				   <?php 
				   }
				   ///////////
				   
				   
				   
				

				   ?>
				
			
			</div>
			
			<!--end comments-->
			
			 <!-- Blog Sidebar Widgets Column -->
			<?php include('includes/sidebar.php'); ?>

             </div>

			
		
		</div>
            
        <!-- /.row -->

        <hr>
       
					
      <?php include('includes/footer.php'); ?>
	  <script>
	      $(document).ready(function(){
			  var post_id = <?php echo $post_id ?>;
			  var user_id = <?php  echo loggedInUserId(); ?>;
			  $("[data-toggle='tooltip']").tooltip();
			  ///////////Like
			  $('.likes').click(function(){
				  $.ajax({
					  url: "/cms_mapping/post.php?p_id=<?php echo $post_id ?>",
					  type: 'post',
					  data: {
						  'liked': 1,
						  'post_id': post_id,
						  'user_id': user_id,
					  }
				  });
			  });
			  
			  //////unlike
			   $('.unlikes').click(function(){
				  $.ajax({
					  url: "/cms_mapping/post.php?p_id=<?php echo $post_id ?>",
					  type: 'post',
					  data: {
						  'unliked': 1,
						  'post_id': post_id,
						  'user_id': user_id,
					  }
				  });
			  });
		  });
	  </script>
	 