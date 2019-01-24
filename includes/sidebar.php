<?php
    if(isset($_POST['login'])){
		$email = $_POST['email'];
		$password = $_POST['password'];
		login_user($email, $password);
	}
?>
<div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well mydev">
                    <h4>Blog Search</h4>
					<form action='/cms_mapping/search.php' method='post'>
					
						<div class="input-group">
							<input type="text" class="form-control" name='search'>
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit" name='send'>
									<span class="glyphicon glyphicon-search"></span>
							</button>
							</span>
						</div>
					</form>
                    <!-- /.input-group -->
                </div>
				<?php
				    if(isset($_SESSION['user_name'])){
						$name = $_SESSION['user_name'];
					
					?>
				<div class="well mydev">
				    <h4>you logged as <?php echo $name ?></h4>
					<a href="./includes/logout.php" class="btn mybtn">Logout</a>
				</div>
					
					<?php
					}
					else {
						?>
						
				<div class="well mydev">
				    <form method="post">
						<div class="form-group">
							<input type="email" name="email" class="form-control" placeholder="Your Email">
							
						</div>
						 <div class="form-group">
							<input type="password" name="password" class="form-control" placeholder="Your Password">
							
						</div>
						<input type="submit" name="login" value="Login" class="btn mybtn">
						<div class="form-group">
						    <a href="forgot.php?forgot=<?php echo uniqid(true)?>">Forget Password</a>
						</div>
					</form>
					
                </div>				
						<?php
						
					}
				?>
				

                <!-- Blog Categories Well -->
                <div class="well mydev">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well mydev">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>
	</div>

        