<?php 

	function ValidateLogin($login)
	{ 
		if($login == '')
		{
			echo "	<script type='text/javascript' src='js/fx.slideOpen.js'></script>";
			return "Fields cannot be empty";
		}
		
		if(preg_match('/[^a-z0-9\-\_\.]+/i',$login))
		{
			echo "	<script type='text/javascript' src='js/fx.slideOpen.js'></script>";
			return "Your login contains invalid characters";
		}
		
		//--Logowanie
		if(isset($_POST['log'], $_POST['pwd']))
		{
		//require_once("Src/Util/Checkemail.php");
			if(empty($_POST['log']) || empty($_POST['pwd']) )
			{
					return "Empty rows";
			}
			else
			{
				$user = new User();
				$user->setNick($_POST['log']);
				$user->setPassword(sha1($_POST['pwd']));
				
				
				if($user->IsAuthenticated())
				{
					$_SESSION['podloty_loggedin'] = 'ok';
					$_SESSION['userNick'] = $user->getNick();

					return "Login IN ";
				}
				else
				{
					echo "	<script type='text/javascript' src='js/fx.slideOpen.js'></script>";
					return "Login or password are not correct";
				}
			}
		  }
		
		
	}
	


?>