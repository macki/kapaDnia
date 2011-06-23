<?php 
	session_start();
?>

<?php
include_once '../../DBop/DBoperationBasic.php';

if($_POST)
{
	$name=$_POST['name'];
	$comment_dis=$_POST['comment'];
	$photoId = $_POST['photoId'];
	
	$email = "EmptyString";
	
	 $lowercase = strtolower($email);
  	 $image = md5( $lowercase );
     
    //TODO:: check if user is log in
	 DBoperationBasic::ExecuteNonQuery("insert into comment (PhotoId,CommentName,CommentText, OwnerID, CommentDate) values ('$photoId','$name','$comment_dis','1',NOW())");
}

?>


<div id="main2">
	<li class="box">
	<img src="source/commentIcon2.jpg" 
		<?php echo $image; ?> class="com_img">
	<span class="com_name">
		<?php echo $name; ?></span> <br />
		<?php echo $comment_dis?></li>

</div>