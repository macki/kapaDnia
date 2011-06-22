<?php
	
	include_once 'Src/View/CommentView.php';

	class DBoperationComment
	{
		//-- database column
		private static $textComment = 'commentText';
			
		//--
		private static  $commentTable = 'comment';
	
	
		//-- Get Comment from DB
		public static  function GetComment()		
		{
				DBoperationComment::SendQueryGetComment();
		}
		
		//-- getting filtered then calling CommentView
		private static function SendQueryGetComment()
		{
			$resultQuery = DBoperationBasic::ExecuteQuery("SELECT *  
								   from ". DBoperationComment::$commentTable."
								   where  PhotoID = ".$_GET['photoId']);
			
			new CommentView($resultQuery);

		}
		
		
		//-- Add comment to Database
		public static function AddCommentToDatabase($comment,$photoId)
		{
			//TODO:: odpowiednie filtorwanie "$comment"
			// 		 przekaza odpowiednie userID
			
			if(DBoperationBasic::Connect() == TRUE)
			{	
				mysql_select_db("kapaDnia", DBoperationBasic::$connection);
				
				$userId = 2; //::TODO 
						
				mysql_query("INSERT INTO comment (
							PhotoID,
							commentText,
							OwnerID,
							AddedDate,
							Rank) VALUES (
							 '".$id."',
							 '".$comment."',
							 '".$userId."',
							 NOW(),
							 '0')");
				
				mysql_close();
				return true;
			}
			else 
			{
				echo "Problem with Database Check later";
			}
			
			
			return false;
		}
	}

?>