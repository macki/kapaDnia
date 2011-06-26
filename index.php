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
	include_once 'Src/Utility/LoginValidation.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-2">
		<title>Twoja codzienna kapa</title>
		
		<!-- Skrypty JS -->
		<script type="text/javascript" src="jquery.js"></script>	
		<script type="text/javascript" src="js/mootools-1.2-core-yc.js"></script>
		<script type="text/javascript" src="js/mootools-1.2-more.js"></script>
	
		<!-- Style  -->
		<link rel="stylesheet" type="text/css" href="style/style.css" />
		<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="fx.slide.css" type="text/css" media="screen" />
		
		<!-- Show hidden login/Register Panel -->
		<?php 	
			echo "	<script type='text/javascript' src='js/fx.slide.js'></script>";	
		?>	
		
</head>


<body>		
	<!-- Login -->
	<div id="login">
		<div class="loginContent">
		<!-- Validation login in JS -->
			<?php
			  if(isset($_GET['login']))
			  {
				$error = ValidateLogin($_POST['log']);	
				echo $error;
			  }
			  
			  //-- getting url of given page, when user login after clicking a photo
			  if($_GET['photoId'] != '' || $_GET['photoUrl'] != '')
			 	 $fullUrl = "photoId=".$_GET['photoId']."&photoUrl=".$_GET['photoUrl'];
			  
			 echo "<form action='index.php?login&".$fullUrl."' method='post'>";
			?>
				<label for="log"><b>Username: </b></label>
				<input class="field" type="text" name="log" id="log" value="" size="23" /><br>
				<label for="pwd"><b>Password:</b></label>
				<input class="field" type="password" name="pwd" id="pwd" size="23" /><br>
				<input type="submit" name="submit" value="" class="button_login" />
				<input type="hidden" name="redirect_to" value=""/><br>
			</form>
			
            	
		</div>
		<div class="loginClose"><a href="#" id="closeLogin"></a></div>
	</div> 
	
    <div id="container">
		<div id="top">
		<!-- login -->
			<ul class="login">
		    	<li class="left">&nbsp;</li>
		    	
		    <!-- Check user -->
			<?php 
				if($_SESSION['podloty_loggedin'] == 'ok')
				{
					echo " <li>".$_SESSION['userNick']."</li>";
					echo "<li>|</li>
						  <li><a id='submit' class = 'submit' href='Src/View/logout.php'>Wyloguj</a></li>";
				}
				else
				{
					echo " <li>Pijak Anonim</li>";
					echo "<li>|</li>
						  <li><a id='toggleLogin' class='toggleLogin' href='#'>Wbijaj</a></li>";
				}
			?>  	
			</ul> 
		
		</div> 

        <div class="clearfix"></div>

		<div id="content">
			<!-- If javascript is disabled, display message below: -->
			<noscript>
				<!-- Register/Login -->	
				<div id="loginMy">
				<!-- NO JAVASCRIPT -->
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
			</noscript>
		</div>
	</div>
	
		<!-- Page Basic elements -->														
		<!-- Logo/Top -->
			<div id="topMy">
				<img src='source/top.png' width='100%'>
			</div>
			
		<!-- Center View -->	
			<div id = "">		
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
								
		</body>
		

		
</html>



