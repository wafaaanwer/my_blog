<?php 
    session_start();
	include('db.php');
	include("functions.php");
	ob_start();
	

?>
<?php
if(isset($_GET['/admin'])){
	redirect('index.php');
}
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Wafaa Blog</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
				    <?php 
					    $query = "select * from categories";
						$result = mysqli_query($connection, $query);
						
						while($row = mysqli_fetch_assoc($result)){
							
							$cat_id = $row['cat_id'];
							$cat_title = $row['cat_title'];
							$cat_title = $row['cat_title'];
							$category_class = '';
							
							if(isset($_GET['category_id']) && $_GET['category_id'] == $cat_id){
								$category_class = 'active';
							}
							echo "<li class='{$category_class}'><a href='categories.php?category_id={$cat_id}'>{$cat_title}</a></li>";
						}
							
						
					
					?>
                   
                    <li class='<?php echo $contact_calss; ?>'>
                        <a href="contactus.php">Contact</a>
						
                    </li>
					<?php 
					    if (isLoggedInUser()) {
							if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'author'||  $_SESSION['role'] == 'subscriber') {
								
								echo "<li><a href='admin'>Profile</a></li>";
							    
							}
								
							//echo "<li><a href='profile.php'>Profile</a></li>";
							echo "<li class=''><a href='includes/logout.php'>Logout</a></li>";
						
						} else {
							echo "<li class=''><a href='login.php'>Login</a></li>";
							echo "<li class=''><a href='registration.php'>Registeration</a></li>";
						
						}

                    ?>					
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
