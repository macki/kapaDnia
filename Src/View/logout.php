<?php ob_start(); ?>

<?php
	session_start();
	$_SESSION['notRefresh'] = true;


	if($_SESSION['podloty_loggedin'] == 'ok')
	{
		$spr = $_SESSION['podloty_loggedin'];
		
		unset($_SESSION['podloty_loggedin']);
		unset($_SESSION['userNick']);
	
		session_destroy();
		
		if(!empty($spr))
		{
			header("Location: http://127.0.0.1/kapa/index.php");
			ob_end_flush();

		}
	}
	else
	{
		header("Location: http://127.0.0.1/kapa/index.php");
	
		ob_end_flush();
	}

?>