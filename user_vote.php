
<?php
include "up.php";


$vote=$_GET['vote']; //if 1 ->Like  / If 2 -> Hate
$movieId=$_GET['movieId'];
$redirect=$_GET['redirect'];
$movieSelectedUserId=$_GET['movieSelectedUserId'];
$userId=$_SESSION[id];

$checkUserVote="SELECT * FROM user_votes WHERE movie_id = $movieId AND user_id = $_SESSION[id];";
$checkUserVoteResult=mysqli_query($conn,$checkUserVote);

$UserVoteResultRows=mysqli_fetch_array($checkUserVoteResult);

$UserVote=$UserVoteResultRows['rating_action'];


if (mysqli_num_rows($checkUserVoteResult) > 0) //if the loggin user has voted for the movie
{

	if ($UserVote=="Like")//if he has already liked 
	{
		if($vote==1)// if he presses again like(checked by $vote variable)
		{
				

			// 1) substract 1 value from movies table from movie likes column 

			$substractMovieLike="UPDATE movies SET movie_likes=movie_likes -1 WHERE movie_id=$movieId ;";
			$substractMovieLikesResult=mysqli_query($conn,$substractMovieLike);

			if($redirect==1)
			{
				header("Location:index.php");
			}
			else
			{
				header("Location:user_movies.php?movieSelectedUserId=$movieSelectedUserId");
			}
			

			// 2) DELETE the whole record from user_votes table

			$deleteVote="DELETE FROM user_votes WHERE movie_id = $movieId AND user_id = $userId ;";
			$deleteVoteResult=mysqli_query($conn,$deleteVote);

			if($redirect==1)
			{
				header("Location:index.php");
			}
			else
			{
				header("Location:user_movies.php?movieSelectedUserId=$movieSelectedUserId");
			}
			
		}



		if ($vote==2) // if initially pressed like and now pressed hate
		{

			// 1) substract 1 value from movies table from movie Likes column

			$updateMovieLike="UPDATE movies SET movie_likes=movie_likes -1 WHERE movie_id=$movieId ;";
			$updateMovieLikesResult=mysqli_query($conn,$updateMovieLike);

			if($redirect==1)
			{
				header("Location:index.php");
			}
			else
			{
				header("Location:user_movies.php?movieSelectedUserId=$movieSelectedUserId");
			}
			

			// 2) add 1 value from movies table from movie Hates column

			$updateMovieHates="UPDATE movies SET movie_hates=movie_hates +1 WHERE movie_id=$movieId ;";
			$updateMovieHatesResult=mysqli_query($conn,$updateMovieHates);

			if($redirect==1)
			{
				header("Location:index.php");
			}
			else
			{
				header("Location:user_movies.php?movieSelectedUserId=$movieSelectedUserId");
			}
			


			// 3) Update user_votes table From Liked to Hate

			$updateUserVote="UPDATE user_votes SET rating_action = 'Hate' WHERE movie_id=$movieId AND user_id=$userId ;";
			$updateUserVoteResult=mysqli_query($conn,$updateUserVote);

			if($redirect==1)
			{
				header("Location:index.php");
			}
			else
			{
				header("Location:user_movies.php?movieSelectedUserId=$movieSelectedUserId");
			}
			

		}



	}

	else //if he has disliked

	{

		if($vote==2)  
		{
			// 1) substract 1 value from movies table from movie hates column

			$substractMovieHates="UPDATE movies SET movie_hates=movie_hates -1 WHERE movie_id=$movieId ;";
			$substractMovieHatesResult=mysqli_query($conn,$substractMovieHates);

			if($redirect==1)
			{
				header("Location:index.php");
			}
			else
			{
				header("Location:user_movies.php?movieSelectedUserId=$movieSelectedUserId");
			}
			


			// 2) DELETE the whole record from user_votes table

			$deleteVote="DELETE FROM user_votes WHERE movie_id = $movieId AND user_id = $userId ;";
			$deleteVoteResult=mysqli_query($conn,$deleteVote);

			if($redirect==1)
			{
				header("Location:index.php");
			}
			else
			{
				header("Location:user_movies.php?movieSelectedUserId=$movieSelectedUserId");
			}
			

		}


		if ($vote==1)
		{
			// 1) substract 1 value from movies table from movie Hates column

			$substractMovieHates="UPDATE movies SET movie_hates=movie_hates -1 WHERE movie_id=$movieId ;";
			$substractMovieHatesResult=mysqli_query($conn,$substractMovieHates);

			if($redirect==1)
			{
				header("Location:index.php");
			}
			else
			{
				header("Location:user_movies.php?movieSelectedUserId=$movieSelectedUserId");
			}
			


			// 2) add 1 value from movies table from movie Likes column

			$updateMovieLike="UPDATE movies SET movie_likes = movie_likes + 1 WHERE movie_id=$movieId ;";
			$updateMovieLikeResult=mysqli_query($conn,$updateMovieLike);

			if($redirect==1)
			{
				header("Location:index.php");
			}
			else
			{
				header("Location:user_movies.php?movieSelectedUserId=$movieSelectedUserId");
			}
			


			// 3) Update user_votes table From Hate to Liked

			$updateUserVote="UPDATE user_votes SET rating_action = 'Like' WHERE movie_id=$movieId AND user_id=$userId ;";
			$updateUserVoteResult=mysqli_query($conn,$updateUserVote);

			if($redirect==1)
			{
				header("Location:index.php");
			}
			else
			{
				header("Location:user_movies.php?movieSelectedUserId=$movieSelectedUserId");
			}
			
		}


	}






}
else // if he has not voted before:
{
	if ($vote==1 ) // if the user liked the movie 
	{
		$voteLike="Like";

		// 1) update movies table -> in likes column +1
		$updateMovieLike="UPDATE movies SET movie_likes=movie_likes + 1 WHERE movie_id=$movieId;"; 
		$updateMovieLikeResult=mysqli_query($conn,$updateMovieLike);



		// 2) INSERT to user votes table

		$insertVote= "INSERT INTO user_votes(
		user_id,
		movie_id,
		rating_action )
		VALUES (?,?,?) ;";

		$stmt=mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$insertVote))
        {
          if($redirect==1)
			{
				header("Location:index.php");
			}
			else
			{
				header("Location:user_movies.php?movieSelectedUserId=$movieSelectedUserId");
			}
			
          ?>

          <script>alert('There Was An Error Whilr Inserting Your Movie.')</script>

          <?php 
                  
        }   
        else
        {
          mysqli_stmt_bind_param
          ($stmt,"iis",
          $userId,
          $movieId,
          $voteLike);

          mysqli_stmt_execute($stmt);

          if($redirect==1)
			{
				header("Location:index.php");
			}
			else
			{
				header("Location:user_movies.php?movieSelectedUserId=$movieSelectedUserId");
			}
			

          ?>
         
            <script>alert('Your Movie Was Succesfully Inserted.')</script>

          <?php          

          
         
            
        }



	}
	else // if the user Hated the movie
	{
			$voteHate="Hate";

		// 1) update movies table -> in hates column +1

		$updateMovieHates="UPDATE movies SET movie_hates=movie_hates + 1 WHERE movie_id=$movieId;"; 
		$updateMovieHatesResult=mysqli_query($conn,$updateMovieHates);


		// 2) INSERT to user votes table


		$insertVote= "INSERT INTO user_votes(
		user_id,
		movie_id,
		rating_action )
		VALUES (?,?,?) ;";

		$stmt=mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$insertVote))
        {
          if($redirect==1)
			{
				header("Location:index.php");
			}
			else
			{
				header("Location:user_movies.php?movieSelectedUserId=$movieSelectedUserId");
			}
			
          ?>

          <script>alert('There Was An Error Whilr Inserting Your Movie.')</script>

          <?php 
                  
        }   
        else
        {
          mysqli_stmt_bind_param
          ($stmt,"iis",
          $userId,
          $movieId,
          $voteHate);

          mysqli_stmt_execute($stmt);

          if($redirect==1)
			{
				header("Location:index.php");
			}
			else
			{
				header("Location:user_movies.php?movieSelectedUserId=$movieSelectedUserId");
			}
			

          ?>
         
            <script>alert('Your Movie Was Succesfully Inserted.')</script>

          <?php          

          
         
            
        }

	}


}
