<?php 
	session_start();
?>

<html>

<head>
<link rel="stylesheet" type="text/css" href="style/style.css" />
</head>

	<body>
		<div id = "centerMy">		
			<?php
			
				if($_SESSION['podloty_loggedin'] == 'ok')
				{
					
				
				}
				else 
				{
					
					echo"<img src='images/zalogujSie.jpg' align-text='center' alt='Angry face' />";
					
				}
		?>
	
	</body>

<div>

</html>