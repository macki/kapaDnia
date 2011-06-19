<?php

	class ShowOnePhoto
	{
		function __construct($url) 
		{
			$this->ShowPhoto($url);
			$this->ShowComment();
			
		}
		
		private function ShowPhoto($url)
		{
				echo"
					<img src='".$url."'
					alt='Angry face' />
				";		
		}
		
		private function ShowComment()
		{
		
			
			
		}
	}

?>