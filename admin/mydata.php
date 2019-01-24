<?php include "includes/admin_header.php"; ?>


    <div id="wrapper">
		

        <!-- Navigation -->
        <?php include "includes/admin_nav.php"; ?>

        <div id="page-wrapper">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
					    <?php 
							    if((!isset($_SESSION['user_name']) && $_SESSION['role'] != 'admin') || (!isset($_SESSION['user_name']) && $_SESSION['role'] != 'author')){
									redirect('../index.php');
								} else {
									echo "<h3>Welcome {$_SESSION['user_name']}</h3>";
									$id = $_SESSION['user_id'];
									$email = $_SESSION['user_email'];
									
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
									  
										$post_count = get_all_user_posts();
									
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
									
									   $comments_count = get_all_post_users_comments();
									
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
				
				
			</div>
			<!-- /.row -->
									
									  
			<div class="row">
				<script type="text/javascript">
				  google.charts.load('current', {'packages':['bar']});
				  google.charts.setOnLoadCallback(drawChart);

				  function drawChart() {
					var data = google.visualization.arrayToDataTable([
						
						['Data', 'Count'],
						<?php 
                        $element_text = ['All Posts', 'Comments'];
                        $element_count = [$post_count, $comments_count];				
							

							for($i=0; $i<2; $i++){
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
	