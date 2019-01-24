<?php  
      
	 function get_all_user_posts(){
		 $result = query("SELECT * FROM posts WHERE user_id = " . loggedInUserId() . "");
		 confirm($result);
		 $count = mysqli_num_rows($result);
		 return $count;
	 }
	 function get_all_post_users_comments(){
		 $result = query("SELECT * FROM comments INNER JOIN posts ON comments.comment_post_id = posts.post_id ");
		 confirm($result);
		 $count = mysqli_num_rows($result);
		 return $count;
	 }
	 function get_all_post_users_comments_approved(){
		 $result = query("SELECT * FROM comments INNER JOIN posts ON comments.comment_post_id = posts.post_id WHERE user_id = " . loggedInUserId() . " AND comment_status = 'approved'");
		 confirm($result);
		 $count = mysqli_num_rows($result);
		 return $count;
	 }
	 function get_all_post_users_comments_unapproved(){
		 $result = query("SELECT * FROM comments INNER JOIN posts ON comments.comment_post_id = posts.post_id WHERE user_id = " . loggedInUserId() . " AND comment_status = 'unapproved'");
		 confirm($result);
		 $count = mysqli_num_rows($result);
		 return $count;
	 }
	
		 
	 


?>