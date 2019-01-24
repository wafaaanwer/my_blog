<?php include "includes/admin_header.php"; ?>


    <div id="wrapper">
		

        <!-- Navigation -->
        <?php include "includes/admin_nav.php";?>

        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
					    <?php 
							    if((isset($_SESSION['user_name']) && $_SESSION['role'] == 'admin') || (isset($_SESSION['user_name']) && $_SESSION['role'] == 'author') ){
									echo "<h3>Welcome {$_SESSION['user_name']}</h3>";
								} elseif ((isset($_SESSION['user_name']) && $_SESSION['role'] == 'subscriber')) {
									redirect('profile.php');
								
								}
							?>
                        
                    </div>
                </div>
                <!-- /.row -->
				       
           
            <!-- /.row -->

			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="panel panel-fusia">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-file-text fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
									<?php 
										$query = "SELECT * FROM posts";
										$select_all_posts = mysqli_query($connection, $query);
										$post_count = mysqli_num_rows($select_all_posts);
									
										echo "<div class='huge'>{$post_count}</div>";
									?>
									  
									  <div>Posts</div>
								</div>
							</div>
						</div>
						<a href=
						"posts.php">
							<div class="panel-footer">
								<span class="pull-left">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="panel panel-purple">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-comments fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
									<?php 
									
										$query = "SELECT * FROM comments";
										$select_all_comments = mysqli_query($connection, $query);
										$comments_count = mysqli_num_rows($select_all_comments);
									
									
										echo "<div class='huge'>{$comments_count}</div>";
										
									?>
								 
								  <div>Comments</div>
								</div>
							</div>
						</div>
						<a href="comments.php">
							<div class="panel-footer">
								<span class="pull-left">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="panel panel-fusia">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-user fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
									<?php 
										$query = "SELECT * FROM users";
										$select_all_users = mysqli_query($connection, $query);
										$users_count = mysqli_num_rows($select_all_users);
										echo "<div class='huge'>{$users_count}</div>";
									?>
								
									<div> Users</div>
								</div>
							</div>
						</div>
						<a href="users.php">
							<div class="panel-footer">
								<span class="pull-left">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="panel panel-purple">
						<div class="panel-heading">
							<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-list fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
									<?php 
										$query = "SELECT * FROM categories";
										$select_all_categories = mysqli_query($connection, $query);
										$categories_count = mysqli_num_rows($select_all_categories);
										echo "<div class='huge'>{$categories_count}</div>";
									?>
									
									 <div>Categories</div>
								</div>
							</div>
						</div>
						<a href="categories.php">
							<div class="panel-footer">
								<span class="pull-left">View Details</span>
								<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
								<div class="clearfix"></div>
							</div>
						</a>
					</div>
				</div>
			</div>
			<!-- /.row -->
			<?php
			    $published_query = "SELECT * FROM posts where post_status = 'published'";
				$published_query_result = mysqli_query($connection, $published_query);
				$published_posts = mysqli_num_rows($published_query_result);
				
				$draft_query = "SELECT * FROM posts where post_status = 'draft'";
				$draft_query_result = mysqli_query($connection, $draft_query);
				$draft_posts = mysqli_num_rows($draft_query_result);
				
				$admin_query = "SELECT * FROM users where role = 'admin'";
				$admin_query_result = mysqli_query($connection, $admin_query);
				$admin_users = mysqli_num_rows($admin_query_result);
				
				$subscriber_query = "SELECT * FROM users where role = 'subscriber'";
				$subscriber_query_result = mysqli_query($connection, $subscriber_query);
				$subscriber_users = mysqli_num_rows($subscriber_query_result);
			    
				$unapproved_query = "SELECT * FROM comments where comment_status = 'unapproved'";
				$unapproved_query_result = mysqli_query($connection, $unapproved_query);
				$unapproved_comments = mysqli_num_rows($unapproved_query_result);
			    
			      
			?>							
									  
			<div class="row">
				<script type="text/javascript">
				  google.charts.load('current', {'packages':['bar']});
				  google.charts.setOnLoadCallback(drawChart);
				  

				  function drawChart() {
					var data = google.visualization.arrayToDataTable([
						/*
					  ['Year', 'Sales', 'Expenses', 'Profit', { role: 'style' }],
					  ['2014', 1000, 400, 200, 'color: #703593'],
					  ['2015', 1170, 460, 250, 'color: #703593'],
					  ['2016', 660, 1120, 300, 'color: #703593'],
					  ['2017', 1030, 540, 350, 'color: #703593']
					  ])
					  */
						['Data', 'Count'],
						<?php 
                        $element_text = ['All Posts', 'Published Posts', 'Draft Posts', 'Comments', 'Pending Comments', 'Categories', 'Users', 'Admins', 'Subscriber'];
                        $element_count = [$post_count, $published_posts, $draft_posts, $comments_count, $unapproved_comments, $categories_count, $users_count, $admin_users, $subscriber_users];				
							

							for($i=0; $i<8; $i++){
								echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
								
							}
						?>
						
						
					]);
					

					var options = {
					    chart: {
						title: '',
						subtitle: '',
					    
                       
                       
					  }
					  
					};

					var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

					chart.draw(data, google.charts.Bar.convertOptions(options));
				  }
				</script>
			</div>
			<div id="columnchart_material" style="width: auto; height: 500px;"></div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php"; ?>
	