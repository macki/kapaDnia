<?php

require_once("Src/Model/User.php");

if($_SESSION['podloty_loggedin'] != 'ok')
{
	// ***************************************************
	// LOGOWANIE - KROK 2 - walidacja i logowanie właściwe
	// ***************************************************
	if($_POST['logowanie_krok2'] == 'ok' && isset($_POST['nick'], $_POST['pass']))
	{
		require_once("Src/Utility/Checkemail.php");
		
		if(empty($_POST['nick']) || empty($_POST['pass']) || !validdata($_POST['nick']))
		{
				echo "<br>";
				echo "<p><b>Blad: Podane dane sa nieprawidlowe.</b></p>";
		}
		else
		{
			$user = new User();
			$user->setNick($_POST['nick']);
			$user->setPassword(sha1($_POST['pass']));
			
			if($user->IsAuthenticated())
			{
				$_SESSION['podloty_loggedin'] = 'ok';
				$_SESSION['userNick'] = $user->getNick();
				header("Location: index.php");
			}
			else
			{
				echo "<p>blad logowania.</p>";
				echo "<p>Mozliwe przyczyny: <br />-podane dane są niepoprawne,<br />-konto nie zostało aktywowane,<br />-konto zostało zablokowane przez administratora.</p>";
			}
		}
	}
	// *******************************************
	// LOGOWANIE - KROK 1 - wypełnienie formularza
	// *******************************************
	else
	{
		
	?>
	
	.
	
<style>
	ul#display-inline-block-example,
	ul#display-inline-block-example li {
		/* Setting a common base */
		margin: 0;
		padding: 0;
	}

	ul#display-inline-block-example li {
		display: inline-block;
		width: auto;
		min-height: 100px;
	}
</style>	

<div style="margin-left:35%;">	
	<ul id="display-inline-block-example">
		<li>
			<form id="loginForm" name="loginForm" method="post" action="index.php?page=login">
				<table>			
					<tr><td>Pijak: </td><td><input type="text" name="nick" /></td></tr>
					<tr><td>Haselko: </td><td><input type="password" name="pass" /></td></tr>
					<input type="hidden" name="logowanie_krok2" value="ok" />
					<tr><td colspan="2"><input type="submit" name="submit" value="Zaloguj" /></td><td></td></tr>
				</table>	
			</form>	
		</li>
		<li>
			<div style="margin-left:20px;">	
				<img src='source/drunk.jpg' width='50px' height='100px'>
			</div>
		</li>	
	</ul>	
</div>

	<?php
	}
}
else // Proba logowania zalogowanego usera - przekierowanie do strony głównej
{
	ob_end_clean();
	header("Location: index.php");
}

?>
