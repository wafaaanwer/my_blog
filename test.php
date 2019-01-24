<?php
        include("includes/header.php");
         ob_start();
		
    ?>

    <!-- Navigation -->
	
   <?php 
        include("includes/nav.php");
        include("includes/db.php");		
   
   ?>
   <?php  echo loggedInUserId();
         if(userLikedThisPost(8)){
			 echo "Liked The post";
		 } else {
			 echo "Didn't like";
		 }
   ?>
   