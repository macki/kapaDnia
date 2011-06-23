<?php ob_start(); ?>

<?php 
	error_reporting(E_ALL & ~E_NOTICE);
	session_start();
	$_SESSION['notRefresh'] = true;
	
	require_once("Src/Model/User.php");
   	include_once 'Src/DBop/DBoperationPhoto.php';
	include_once 'Src/DBop/DBoperationBasic.php';
	include_once 'Src/DBop/DBoperationComment.php';
	include_once 'Src/View/CommentView.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">
		<title>Twoja codzienna kapa</title>
		<link rel="stylesheet" type="text/css" href="style/style.css" />
	
		<body>
		
		<!-- Page Basic elements -->	
		<!-- Register/Login -->	
			<div id="login">
				<?php
					if($_SESSION['podloty_loggedin'] == 'ok')
					{
						echo "Jestes zalogowany jako ".$_SESSION['userNick'];
						echo " <a href=\"index.php?page=logout\">Wyloguj sie</a>";
					}
					else
					{
						echo" <a href=\"index.php?page=registration\">Rejestracja</a> |
						 <a href=\"index.php?page=login\">Logowanie</a>";
					}
					
					ob_end_flush();
				?>
			</div>
											
		<!-- Logo/Top -->
			<div id="top">
				<img src='source/top.png' width='100%'>
			</div>
			
			
		<!--  Formularz Register/Login -->
			<?php		
				$allowed_id = Array('home',
									'registration',
									'login',
									'logout');
				
				//-- Navigate to proper login/register site
				if(in_array($_GET['page'], $allowed_id))
				{
					if(file_exists("Src/View/".$_GET['page'].".php"))
					{	
						include("Src/View/".$_GET['page'].".php");
					}
					else
						echo("Podana podstrona nie istnieje. Powiadom administratora.");
				}
				else
				{
						//echo "<a href='index.php' >"; 
				}
			
			?>		
	
		<!-- Center parts of website -->	
				<?php 
		
					if (isset($_GET['photoUrl']))
					{			
						//$clickedPhoto = new CommentView();
						include_once 'Src/View/comment/comment.php';
						//header("Location: Src/View/comment/comment.php");
					}
					else 
					{
						DBoperationPhoto::GetPhotos('','');
					}					
				?>						
							
		</body>
	</head>	
</html>



