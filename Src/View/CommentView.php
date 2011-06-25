
<?php
	
	class CommentView
	{
		function __construct()
		{
			$this->comment = $com;
			
			echo "<div id='center'>";
				$this->DisplayPhoto();
				$this->DisplayComments();
			echo "</div>";
		}

		//-- Getting photo [GET]
		private function DisplayPhoto()
		{
			echo" <img src =".$_GET['photoUrl']. " />";
		}
		
		//-- Getting comments Module
		private function DisplayComments()
		{
			
			
		}
		
	}

?>