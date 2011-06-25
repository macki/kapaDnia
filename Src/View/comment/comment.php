<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Twoja Kapa</title>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
 
 
	$(function() {
	$(".submit").click(function() {
	
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


</script>

<style type="text/css">
body
{
font-family:Arial, Helvetica, sans-serif;
font-size:14px;
}
.comment_box
{
background-color:#D3E7F5; border-bottom:#ffffff solid 1px; padding-top:3px
}
a
	{
	text-decoration:none;
	
	}
	a:hover
	{
	text-decoration:underline;
	}
	*{margin:0;padding:0;}
	
	
	ol.timeline
	{list-style:none;font-size:1.2em;}
	ol.timeline li{ display:none;position:relative;padding:.7em 0 .6em 0;}ol.timeline li:first-child{}
	
	#main2
	{
	width:500px; margin-top:20px; margin-left:30%;
	font-family:"Trebuchet MS";
	}
	#flash
	{
	margin-left:100px;
	
	}
	.box
	{
	height:85px;
	border-bottom:#dedede dashed 1px;
	margin-bottom:20px;
	}
		input
	{
	color:#000000;
	font-size:14px;
	border:#666666 solid 2px;
	height:24px;
	margin-bottom:10px;
	width:200px;
	
	
	}
	textarea
	{
	color:#000000;
	font-size:14px;
	border:#666666 solid 2px;
	height:124px;
	margin-bottom:10px;
		width:400px;
	
	}
	.titles{
	font-size:13px;
	padding-left:10px;
	
	
	}
	.star
	{
	color:#FF0000; font-size:16px; font-weight:bold;
	padding-left:5px;
	}
	
	.com_img
	{
	float: left; width: 80px; height: 80px; margin-right: 20px;
	}
	.com_name
	{
	font-size: 16px; margin-leftt: 0px; color: rgb(102, 51, 153); font-weight: bold;
	}
	
	#center
	{
		margin-top:10px;
		width:100%;
		text-align:center;
		height:auto;
	}
	
</style>
</head>

<body>

<!-- Display photo -->	
	<div id="center">
		<?php echo" <img src =".$_GET['photoUrl']. " />";?>
	</div>

<!-- Display comments -->		
	<div id="main2">
		<?php
			include('Src/View/comment/config.php');
			include_once 'Src/DBop/DBoperationBasic.php';
							
			//$sql=mysql_query("select * from comments where post_id_fk = '$post_id'");
			//$sql=mysql_query("select * from comments where post_id_fk = 1");
			
			$result = DBoperationBasic::ExecuteQuery("select * from comment where photoId=".$_GET['photoId'] );
			
			while($row=mysql_fetch_array($result))
			{
				$name=$row['CommentName'];
				//$email=$row['com_email'];
				$comment_dis=$row['CommentText'];
					
				$lowercase = strtolower($email);
				$image = md5( $lowercase );
		?>
	
	
		<li class="box">
		<img src="source/commentIcon.jpg"
			<?php echo $image; ?>" class="com_img">
		<span class="com_name">
			<?php echo $name; ?></span> <br />
			<?php echo $comment_dis?></li>
		<?php
		}
		?>
	
	
	<ol  id="update" class="timeline"></ol>
	<div style="margin-left:100px">
		<form action="#" method="post">
			<input type="hidden" name="photoId" id="photoId" value="<?php echo $_GET['photoId']; ?>"/>
			<input type="text" name="title" id="name"/><span class="titles">Name</span><span class="star">*</span><br/>
			<textarea name="comment" id="comment"></textarea><br />
			<input type="submit" class="submit" value="Dodaj Komentarz" />	
		</form>
	</div>
	
	</div>

</body>
</html>