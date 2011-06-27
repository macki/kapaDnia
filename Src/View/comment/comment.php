<?php 

	session_start();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- Skrypty JS -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript"> 

(function($){
	$(function() {
		$(".submitComment").click(function() {
		
		var name = $("#name").val();
		var email = $("#email").val();
		var comment = $("#comment").val();
		var photoId = $("#photoId").val();
		var dataString = 'name='+ name + '&photoId=' + photoId + '&comment=' + comment;
			
			if(name=='' || email=='' || comment=='')
		     {
		 		alert('Please Give Valide Details');
		     }
			else
			{
				$("#flash").show();
				$("#flash").fadeIn(400).html('<img src="ajax-loader.gif" align="absmiddle">&nbsp;<span class="loading">Loading Comment...</span>');
				
				$.ajax({
					type: "POST",
					   url: "Src/View/comment/commentajax.php",
					   data: dataString,
					   cache: false,
					   success: function(html){
			 
			  $("ol#update").append(html);
			  $("ol#update li:last").fadeIn("slow");
			  document.getElementById('email').value='';
			  document.getElementById('name').value='';
			  document.getElementById('comment').value='';
			  
				$("#name").focus();	 
			    $("#flash").hide();	
		  }
		 });
		}
		return false;
			});
		
		
		
		});

})(jQuery);

</script>

		<script type="text/javascript" src="js/mootools-1.2-core-yc.js"></script>
		<script type="text/javascript" src="js/mootools-1.2-more.js"></script>

		<!-- Style  -->
		<link rel="stylesheet" type="text/css" href="style/style.css" />
		<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="Src/View/comment/styleComment.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="fx.slide.css" type="text/css" media="screen" />
		
		<!-- Show hidden login/Register Panel -->
		<?php 	
			echo "	<script type='text/javascript' src='js/fx.slide.js'></script>";	
		?>	
			
<title>Twoja Kapa</title>



</head>
<body>


<!-- Display photo -->	
	<div id="centerComment">
		<?php echo" <img src =".$_GET['photoUrl']. " />";?>
		
	</div>

<!-- Display comments -->		
	<div id="mainComment">
		<?php

			include('Src/View/comment/config.php');
			include_once 'Src/DBop/DBoperationBasic.php';
							

			$result = DBoperationBasic::ExecuteQuery("select * from comment where photoId=".$_GET['photoId'] );
			
			while($row=mysql_fetch_array($result))
			{
				$name=$row['CommentName'];
				//$email=$row['com_email'];
				$comment_dis=$row['CommentText'];
					
				$lowercase = strtolower($email);
				$image = md5( $lowercase );
		?>
	

			<li class="boxComment">
			<img src="source/commentIcon.jpg"
				<?php echo $image; ?> class="com_img"></img>
			<span class="com_name">
				<?php echo $name; ?><br/></span>
				<?php echo $comment_dis?></li>
			<?php
		}
	?>

	<ol  id="update" class="timeline"></ol>
	<div style="margin-left:100px">
		<form action="#" method="post">
			<input class="inputComment" type="hidden" name="photoId" id="photoId" value="<?php echo $_GET['photoId']; ?>"/>
				
				<?php
					
					if($_SESSION['podloty_loggedin'] != 'ok')
					{
						 echo "<input class='inputComment' type='text' name='title' id='name'/>";
						 echo "<span class='titlesComment'>Name</span><span class='star'>*</span>";
					}
					else 
					{
						  echo "<span type='hidden' class='titlesCommentLogged'>".$_SESSION['userNick']."</span><span class='star'></span>";						
					}
					
				?>
					
							
			<br></br>
			<textarea  name="styled-textarea" name="comment" id="comment"></textarea><br />
			<input type="submit" class="submitComment" value="Dodaj Komentarz" />	
		</form>
	</div>
	
</div>

</body>
</html>