<?php
include "up.php";
$redirect=1;

if (isset($_POST['year']))
{
	

	$output='';



	$getMovies="SELECT * from movies ORDER BY movie_upload_date DESC ;";
	$getMoviesResult=mysqli_query($conn,$getMovies);

	while($movieRows=mysqli_fetch_array($getMoviesResult))
	{
	   $movieId=$movieRows['movie_id'] ;
	   $movieTitle =$movieRows['movie_title'] ;
	   $movieDescription=$movieRows['movie_description'] ;
	   $movieUserId=$movieRows['movie_user_id']; 
	   $insertDate=$movieRows['movie_upload_date'] ;
	   $movieLikes=$movieRows['movie_likes'];
	   $movieHates=$movieRows['movie_hates'];


	   $getMovieUser="SELECT user_id, user_name , user_surname FROM users WHERE user_id= $movieUserId;";
	   $getMovieUserResult=mysqli_query($conn,$getMovieUser);
	   $userRows=mysqli_fetch_array($getMovieUserResult);

	   $userId=$userRows['user_id'];
	   $userFirstName=$userRows['user_name'];
	   $userLastName=$userRows['user_surname'];
			

	  
		
	    if (isset ($_SESSION['logged_in']))
	    {
		if($userId == $_SESSION['id'])
		{
		  $userFullName='You';
		}
		else
		{
		  $userFullName=$userFirstName.' '. $userLastName ;
		}
					
	    }
	    else
	    {
		$userFullName=$userFirstName.' '. $userLastName ;
	    }
				
	    $output.='
	   <div class="movie-box">



	      <div class="row"><!--row for title & date -->

	         <div class="col-md-8"><!--column for title -->
		    <h4> '.$movieTitle.' </h4>
	         </div>

		 <div class="col-md-4"><!--column for date -->
		    <p> Inserted at : '.$insertDate.' </p>
		 </div>

	      </div><!-- end of row for title & date -->



	         <div class="movie-description">
	            <p> '.$movieDescription.' </p>
	         </div>

	      <div class="row"><!--row for likes , likes actions & posted by -->

		  <div class="col-md-4"><!--column for title -->
		      <span> '.$movieLikes.' (Likes) </span>|<span> '.$movieHates.' (Hates)</span>
	          </div>';

			if (isset ($_SESSION['logged_in']))
			{
			  if($userId == $_SESSION['id'])
			  {
			   $output.='	
				<div class="col-md-4">
		   			<span class= "like-link"> <a href="#" style="color:#858585;">Like</a></span> | <span class="hate-link"><a href="" style="color:#858585;">Hate</a> </span>
				</div>';
			   }
			   else
			   {
									
			    $checkUserVote="SELECT * FROM user_votes WHERE movie_id = $movieId AND user_id = $_SESSION[id];";
			    $checkUserVoteResult=mysqli_query($conn,$checkUserVote);
			    $UserVoteResultRows=mysqli_fetch_array($checkUserVoteResult);


			    if (mysqli_num_rows($checkUserVoteResult) > 0) //if the loggin user has voted for the movie
			    {

		              $voteAction=$UserVoteResultRows['rating_action'];

		               //we want to see if he liked or hated the movie

				if ($voteAction=='Like')//if he has liked the movie
				{
				   //Show That he has Liked The Movie
				  $output.='
				<div class="col-md-4">
					<span style="background-color:#2377cc; padding:9px; border-radius:20px;"> 
						<a href="user_vote.php?vote=1&redirect='.$redirect.'&movieId='.$movieId.'" style="color:#fff;">Like</a>
					</span> |

					<span hate-btn>
						<a href="user_vote.php?vote=2&redirect='.$redirect.'&movieId='.$movieId.'">Hate</a> 
					</span>
				</div>
				';					

				}
				else //if he has hated the movie
				{
				  //Show That he has Disliked The Movie
				   $output.='	
				   <div class="col-md-4">
				      <span> 
				      	<a href="user_vote.php?vote=1&redirect='.$redirect.'&movieId='.$movieId.'" >Like</a>
				      </span> | 

				      <span hate-btn style="background-color:#2377cc; padding:9px; border-radius:20px;">
				      	<a href="user_vote.php?vote=2&redirect='.$redirect.'&movieId='.$movieId.'" style="color:#fff;">Hate</a> 
				      </span>
				    </div> ';
				}


			     }// end of if the loggin user has voted for the movie
			     else //if he has not voted yet
			     { 
				// let him vote
				$output.='	
				<div class="col-md-4">
				   <span like-btn> 
				   	<a href="user_vote.php?vote=1&redirect='.$redirect.'&movieId='.$movieId.'">Like</a>
				   </span> | 
				   <span hate-btn>
				   	<a href="user_vote.php?vote=2&redirect='.$redirect.'&movieId='.$movieId.'">Hate</a> 
				   </span>
				</div>';

			      }							

			    }

			}//end if isset session log in
			$output.='

			<div class="col-md-4">
				<p>Posted By:<a href="user_movies.php?movieSelectedUserId='.$movieUserId.'"> '.$userFullName.' </a></p>
			</div>


		</div><!-- row for likes , likes actions & posted by -->


	     </div><!-- movie box div end--> ';
				
	}  

echo $output;

}


//////////////////////////////////////// ORDER BY LIKES //////////////////////////////////////////////


if (isset($_POST['likes']))
{
	

	$output='';



	$getMovies="SELECT * from movies ORDER BY movie_likes DESC ;";
	$getMoviesResult=mysqli_query($conn,$getMovies);

	while($movieRows=mysqli_fetch_array($getMoviesResult))
	{
	   $movieId=$movieRows['movie_id'] ;
	   $movieTitle =$movieRows['movie_title'] ;
	   $movieDescription=$movieRows['movie_description'] ;
	   $movieUserId=$movieRows['movie_user_id']; 
	   $insertDate=$movieRows['movie_upload_date'] ;
	   $movieLikes=$movieRows['movie_likes'];
	   $movieHates=$movieRows['movie_hates'];


	   $getMovieUser="SELECT user_id, user_name , user_surname FROM users WHERE user_id= $movieUserId;";
	   $getMovieUserResult=mysqli_query($conn,$getMovieUser);
	   $userRows=mysqli_fetch_array($getMovieUserResult);

	   $userId=$userRows['user_id'];
	   $userFirstName=$userRows['user_name'];
	   $userLastName=$userRows['user_surname'];
			

	  
		
	    if (isset ($_SESSION['logged_in']))
	    {
		if($userId == $_SESSION['id'])
		{
		  $userFullName='You';
		}
		else
		{
		  $userFullName=$userFirstName.' '. $userLastName ;
		}
					
	    }
	    else
	    {
		$userFullName=$userFirstName.' '. $userLastName ;
	    }
				
	    $output.='
	   <div class="movie-box">



	      <div class="row"><!--row for title & date -->

	         <div class="col-md-8"><!--column for title -->
		    <h4> '.$movieTitle.' </h4>
	         </div>

		 <div class="col-md-4">
		    <p> Inserted at : '.$insertDate.' </p>
		 </div>

	      </div><!-- end of row for title & date -->



	         <div class="movie-description">
	            <p> '.$movieDescription.' </p>
	         </div>

	      <div class="row"><!--row for likes , likes actions & posted by -->

		  <div class="col-md-4"><!--column for title -->
		      <span> '.$movieLikes.' (Likes) </span>|<span> '.$movieHates.' (Hates)</span>
	          </div>';

			if (isset ($_SESSION['logged_in']))
			{
			  if($userId == $_SESSION['id'])
			  {
			   $output.='	
		<div class="col-md-4">
		   <span class= "like-link"> <a href="#" style="color:#858585;">Like</a></span> | <span class="hate-link"><a href="" style="color:#858585;">Hate</a> </span>
		</div>';
			   }
			   else
			   {
									
			    $checkUserVote="SELECT * FROM user_votes WHERE movie_id = $movieId AND user_id = $_SESSION[id];";
			    $checkUserVoteResult=mysqli_query($conn,$checkUserVote);
			    $UserVoteResultRows=mysqli_fetch_array($checkUserVoteResult);


			    if (mysqli_num_rows($checkUserVoteResult) > 0) //if the loggin user has voted for the movie
			    {

		              $voteAction=$UserVoteResultRows['rating_action'];

		               //we want to see if he liked or hated the movie

				if ($voteAction=='Like')//if he has liked the movie
				{
				   //Show That he has Liked The Movie
				  $output.='
				<div class="col-md-4">
					<span style="background-color:#2377cc; padding:9px; border-radius:20px;"> 
						<a href="user_vote.php?vote=1&redirect='.$redirect.'&movieId='.$movieId.'" style="color:#fff;">Like</a>
					</span> |

					<span hate-btn>
						<a href="user_vote.php?vote=2&redirect='.$redirect.'&movieId='.$movieId.'">Hate</a> 
					</span>
				</div>
				';					

				}
				else //if he has hated the movie
				{
				  //Show That he has Disliked The Movie
				   $output.='	
				   <div class="col-md-4">
				      <span> 
				      	<a href="user_vote.php?vote=1&redirect='.$redirect.'&movieId='.$movieId.'" >Like</a>
				      </span> | 

				      <span hate-btn style="background-color:#2377cc; padding:9px; border-radius:20px;">
				      	<a href="user_vote.php?vote=2&redirect='.$redirect.'&movieId='.$movieId.'" style="color:#fff;">Hate</a> 
				      </span>
				    </div> ';
				}


			     }// end of if the loggin user has voted for the movie
			     else //if he has not voted yet
			     { 
				// let him vote
				$output.='	
				<div class="col-md-4">
				   <span like-btn> 
				   	<a href="user_vote.php?vote=1&redirect='.$redirect.'&movieId='.$movieId.'">Like</a>
				   </span> | 
				   <span hate-btn>
				   	<a href="user_vote.php?vote=2&redirect='.$redirect.'&movieId='.$movieId.'">Hate</a> 
				   </span>
				</div>';

			      }							

			    }

			}//end if isset session log in
			$output.='

			<div class="col-md-4">
				<p>Posted By:<a href="user_movies.php?movieSelectedUserId='.$movieUserId.'"> '.$userFullName.' </a></p>
			</div>


		</div><!-- row for likes , likes actions & posted by -->


	     </div><!-- movie box div end--> ';
				
	}  

echo $output;

}




//////////////////////////////////////// ORDER BY HATES //////////////////////////////////////////////


if (isset($_POST['hates']))
{
	

	$output='';



	$getMovies="SELECT * from movies ORDER BY movie_hates DESC ;";
	$getMoviesResult=mysqli_query($conn,$getMovies);

	while($movieRows=mysqli_fetch_array($getMoviesResult))
	{
	   $movieId=$movieRows['movie_id'] ;
	   $movieTitle =$movieRows['movie_title'] ;
	   $movieDescription=$movieRows['movie_description'] ;
	   $movieUserId=$movieRows['movie_user_id']; 
	   $insertDate=$movieRows['movie_upload_date'] ;
	   $movieLikes=$movieRows['movie_likes'];
	   $movieHates=$movieRows['movie_hates'];


	   $getMovieUser="SELECT user_id, user_name , user_surname FROM users WHERE user_id= $movieUserId;";
	   $getMovieUserResult=mysqli_query($conn,$getMovieUser);
	   $userRows=mysqli_fetch_array($getMovieUserResult);

	   $userId=$userRows['user_id'];
	   $userFirstName=$userRows['user_name'];
	   $userLastName=$userRows['user_surname'];
			

	  
		
	    if (isset ($_SESSION['logged_in']))
	    {
		if($userId == $_SESSION['id'])
		{
		  $userFullName='You';
		}
		else
		{
		  $userFullName=$userFirstName.' '. $userLastName ;
		}
					
	    }
	    else
	    {
		$userFullName=$userFirstName.' '. $userLastName ;
	    }
				
	    $output.='
	   <div class="movie-box">



	      <div class="row"><!--row for title & date -->

	         <div class="col-md-8"><!--column for title -->
		    <h4> '.$movieTitle.' </h4>
	         </div>

		 <div class="col-md-4">
		    <p> Inserted at : '.$insertDate.' </p>
		 </div>

	      </div><!-- end of row for title & date -->



	         <div class="movie-description">
	            <p> '.$movieDescription.' </p>
	         </div>

	      <div class="row"><!--row for likes , likes actions & posted by -->

		  <div class="col-md-4"><!--column for title -->
		      <span> '.$movieLikes.' (Likes) </span>|<span> '.$movieHates.' (Hates)</span>
	          </div>';

			if (isset ($_SESSION['logged_in']))
			{
			  if($userId == $_SESSION['id'])
			  {
			   $output.='	
		<div class="col-md-4">
		   <span class= "like-link"> <a href="#" style="color:#858585;">Like</a></span> | <span class="hate-link"><a href="" style="color:#858585;">Hate</a> </span>
		</div>';
			   }
			   else
			   {
									
			    $checkUserVote="SELECT * FROM user_votes WHERE movie_id = $movieId AND user_id = $_SESSION[id];";
			    $checkUserVoteResult=mysqli_query($conn,$checkUserVote);
			    $UserVoteResultRows=mysqli_fetch_array($checkUserVoteResult);


			    if (mysqli_num_rows($checkUserVoteResult) > 0) //if the loggin user has voted for the movie
			    {

		              $voteAction=$UserVoteResultRows['rating_action'];

		               //we want to see if he liked or hated the movie

				if ($voteAction=='Like')//if he has liked the movie
				{
				   //Show That he has Liked The Movie
				  $output.='
				<div class="col-md-4">
					<span style="background-color:#2377cc; padding:9px; border-radius:20px;"> 
						<a href="user_vote.php?vote=1&redirect='.$redirect.'&movieId='.$movieId.'" style="color:#fff;">Like</a>
					</span> |

					<span hate-btn>
						<a href="user_vote.php?vote=2&redirect='.$redirect.'&movieId='.$movieId.'">Hate</a> 
					</span>
				</div>
				';					

				}
				else //if he has hated the movie
				{
				  //Show That he has Disliked The Movie
				   $output.='	
				   <div class="col-md-4">
				      <span> 
				      	<a href="user_vote.php?vote=1&redirect='.$redirect.'&movieId='.$movieId.'" >Like</a>
				      </span> | 

				      <span hate-btn style="background-color:#2377cc; padding:9px; border-radius:20px;">
				      	<a href="user_vote.php?vote=2&redirect='.$redirect.'&movieId='.$movieId.'" style="color:#fff;">Hate</a> 
				      </span>
				    </div> ';
				}


			     }// end of if the loggin user has voted for the movie
			     else //if he has not voted yet
			     { 
				// let him vote
				$output.='	
				<div class="col-md-4">
				   <span like-btn> 
				   	<a href="user_vote.php?vote=1&redirect='.$redirect.'&movieId='.$movieId.'">Like</a>
				   </span> | 
				   <span hate-btn>
				   	<a href="user_vote.php?vote=2&redirect='.$redirect.'&movieId='.$movieId.'">Hate</a> 
				   </span>
				</div>';

			      }							

			    }

			}//end if isset session log in
			$output.='

			<div class="col-md-4">
				<p>Posted By:<a href="user_movies.php?movieSelectedUserId='.$movieUserId.'"> '.$userFullName.' </a></p>
			</div>


		</div><!-- row for likes , likes actions & posted by -->


	     </div><!-- movie box div end--> ';
				
	}  

echo $output;

}





//////////////////////////////////////// ORDER BY DATE FROM user_movies.php //////////////////////////////////////////////

if (isset($_POST['userId1']))
{

	$output='';
	$movieSelectedUserId=$_POST['userId1'];

	$getMovies="SELECT * from movies WHERE movie_user_id = '".$_POST['userId1']."' ORDER BY movie_upload_date DESC  ;";
	$getMoviesResult=mysqli_query($conn,$getMovies);

	while($movieRows=mysqli_fetch_array($getMoviesResult))
	{
	   $movieId=$movieRows['movie_id'] ;
	   $movieTitle =$movieRows['movie_title'] ;
	   $movieDescription=$movieRows['movie_description'] ;
	   $movieUserId=$movieRows['movie_user_id']; 
	   $insertDate=$movieRows['movie_upload_date'] ;
	   $movieLikes=$movieRows['movie_likes'];
	   $movieHates=$movieRows['movie_hates'];


	   $getMovieUser="SELECT user_id, user_name , user_surname FROM users WHERE user_id= $movieUserId;";
	   $getMovieUserResult=mysqli_query($conn,$getMovieUser);
	   $userRows=mysqli_fetch_array($getMovieUserResult);

	   $userId=$userRows['user_id'];
	   $userFirstName=$userRows['user_name'];
	   $userLastName=$userRows['user_surname'];
			
?>





<?php
	  
		
	    if (isset ($_SESSION['logged_in']))
	    {
		if($userId == $_SESSION['id'])
		{
		  $userFullName='You';
		}
		else
		{
		  $userFullName=$userFirstName.' '. $userLastName ;
		}
					
	    }
	    else
	    {
		$userFullName=$userFirstName.' '. $userLastName ;
	    }
				
	   $output.='
	   <div class="movie-box">



	      <div class="row"><!--row for title & date -->

	         <div class="col-md-8"><!--column for title -->
		    <h4> '.$movieTitle.' </h4>
	         </div>

		 <div class="col-md-4">
		    <p> Inserted at : '.$insertDate.' </p>
		 </div>

	      </div><!-- end of row for title & date -->



	         <div class="movie-description">
	            <p> '.$movieDescription.' </p>
	         </div>

	      <div class="row"><!--row for likes , likes actions & posted by -->

		  <div class="col-md-4"><!--column for title -->
		      <span> '.$movieLikes.' (Likes) </span>|<span> '.$movieHates.' (Hates)</span>
	          </div>';

			if (isset ($_SESSION['logged_in']))
			{
			  if($userId == $_SESSION['id'])
			  {
			   $output.='	
		<div class="col-md-4">
		   <span class= "like-link"> <a href="#" style="color:#858585;">Like</a></span> | <span class="hate-link"><a href="" style="color:#858585;">Hate</a> </span>
		</div>';
			   }
			   else
			   {
									
			    $checkUserVote="SELECT * FROM user_votes WHERE movie_id = $movieId AND user_id = $_SESSION[id];";
			    $checkUserVoteResult=mysqli_query($conn,$checkUserVote);
			    $UserVoteResultRows=mysqli_fetch_array($checkUserVoteResult);


			    if (mysqli_num_rows($checkUserVoteResult) > 0) //if the loggin user has voted for the movie
			    {

		              $voteAction=$UserVoteResultRows['rating_action'];

		               //we want to see if he liked or hated the movie

				if ($voteAction=='Like')//if he has liked the movie
				{
				   //Show That he has Liked The Movie
				  $output.='
				<div class="col-md-4">
					<span style="background-color:#2377cc; padding:9px; border-radius:20px;"> 
						<a href="user_vote.php?vote=1&redirect='.$redirect.'&movieSelectedUserId='.$movieSelectedUserId.'&movieId='.$movieId.'" style="color:#fff;">Like</a>
					</span> |

					<span hate-btn>
						<a href="user_vote.php?vote=2&redirect='.$redirect.'&movieSelectedUserId='.$movieSelectedUserId.'&movieId='.$movieId.'">Hate</a> 
					</span>
				</div>
				';					

				}
				else //if he has hated the movie
				{
				  //Show That he has Disliked The Movie
				   $output.='	
				   <div class="col-md-4">
				      <span> 
				      	<a href="user_vote.php?vote=1&redirect='.$redirect.'&movieSelectedUserId='.$movieSelectedUserId.'&movieId='.$movieId.'" >Like</a>
				      </span> | 

				      <span hate-btn style="background-color:#2377cc; padding:9px; border-radius:20px;">
				      	<a href="user_vote.php?vote=2&redirect='.$redirect.'&movieSelectedUserId='.$movieSelectedUserId.'&movieId='.$movieId.'" style="color:#fff;">Hate</a> 
				      </span>
				    </div> ';
				}


			     }// end of if the loggin user has voted for the movie
			     else //if he has not voted yet
			     { 
				// let him vote
				$output.='	
				<div class="col-md-4">
				   <span like-btn> 
				   	<a href="user_vote.php?vote=1&redirect='.$redirect.'&movieSelectedUserId='.$movieSelectedUserId.'&movieId='.$movieId.'">Like</a>
				   </span> | 
				   <span hate-btn>
				   	<a href="user_vote.php?vote=2&redirect='.$redirect.'&movieSelectedUserId='.$movieSelectedUserId.'&movieId='.$movieId.'">Hate</a> 
				   </span>
				</div>';

			      }							

			    }

			}//end if isset session log in

			$output.='

			<div class="col-md-4">
				<p>Posted By:<a href="user_movies.php?movieSelectedUserId='.$movieUserId.'"> '.$userFullName.' </a></p>
			</div>


		</div><!-- row for likes , likes actions & posted by -->


	     </div><!-- movie box div end--> ';
				
	}  

      
	echo $output;
}



//////////////////////////////////////// ORDER BY LIKES FROM user_movies.php //////////////////////////////////////////////

if (isset($_POST['userId2']))
{

	$output='';
	$movieSelectedUserId=$_POST['userId2'];

	$getMovies="SELECT * from movies WHERE movie_user_id = '".$_POST['userId2']."' ORDER BY movie_likes DESC  ;";
	$getMoviesResult=mysqli_query($conn,$getMovies);

	while($movieRows=mysqli_fetch_array($getMoviesResult))
	{
	   $movieId=$movieRows['movie_id'] ;
	   $movieTitle =$movieRows['movie_title'] ;
	   $movieDescription=$movieRows['movie_description'] ;
	   $movieUserId=$movieRows['movie_user_id']; 
	   $insertDate=$movieRows['movie_upload_date'] ;
	   $movieLikes=$movieRows['movie_likes'];
	   $movieHates=$movieRows['movie_hates'];


	   $getMovieUser="SELECT user_id, user_name , user_surname FROM users WHERE user_id= $movieUserId;";
	   $getMovieUserResult=mysqli_query($conn,$getMovieUser);
	   $userRows=mysqli_fetch_array($getMovieUserResult);

	   $userId=$userRows['user_id'];
	   $userFirstName=$userRows['user_name'];
	   $userLastName=$userRows['user_surname'];
			
?>





<?php
	  
		
	    if (isset ($_SESSION['logged_in']))
	    {
		if($userId == $_SESSION['id'])
		{
		  $userFullName='You';
		}
		else
		{
		  $userFullName=$userFirstName.' '. $userLastName ;
		}
					
	    }
	    else
	    {
		$userFullName=$userFirstName.' '. $userLastName ;
	    }
				
	   $output.='
	   <div class="movie-box">



	      <div class="row"><!--row for title & date -->

	         <div class="col-md-8"><!--column for title -->
		    <h4> '.$movieTitle.' </h4>
	         </div>

		 <div class="col-md-4">
		    <p> Inserted at : '.$insertDate.' </p>
		 </div>

	      </div><!-- end of row for title & date -->



	         <div class="movie-description">
	            <p> '.$movieDescription.' </p>
	         </div>

	      <div class="row"><!--row for likes , likes actions & posted by -->

		  <div class="col-md-4"><!--column for title -->
		      <span> '.$movieLikes.' (Likes) </span>|<span> '.$movieHates.' (Hates)</span>
	          </div>';

			if (isset ($_SESSION['logged_in']))
			{
			  if($userId == $_SESSION['id'])
			  {
			   $output.='	
		<div class="col-md-4">
		   <span class= "like-link"> <a href="#" style="color:#858585;">Like</a></span> | <span class="hate-link"><a href="" style="color:#858585;">Hate</a> </span>
		</div>';
			   }
			   else
			   {
									
			    $checkUserVote="SELECT * FROM user_votes WHERE movie_id = $movieId AND user_id = $_SESSION[id];";
			    $checkUserVoteResult=mysqli_query($conn,$checkUserVote);
			    $UserVoteResultRows=mysqli_fetch_array($checkUserVoteResult);


			    if (mysqli_num_rows($checkUserVoteResult) > 0) //if the loggin user has voted for the movie
			    {

		              $voteAction=$UserVoteResultRows['rating_action'];

		               //we want to see if he liked or hated the movie

				if ($voteAction=='Like')//if he has liked the movie
				{
				   //Show That he has Liked The Movie
				  $output.='
				<div class="col-md-4">
					<span style="background-color:#2377cc; padding:9px; border-radius:20px;"> 
						<a href="user_vote.php?vote=1&redirect='.$redirect.'&movieSelectedUserId='.$movieSelectedUserId.'&movieId='.$movieId.'" style="color:#fff;">Like</a>
					</span> |

					<span hate-btn>
						<a href="user_vote.php?vote=2&redirect='.$redirect.'&movieSelectedUserId='.$movieSelectedUserId.'&movieId='.$movieId.'">Hate</a> 
					</span>
				</div>
				';					

				}
				else //if he has hated the movie
				{
				  //Show That he has Disliked The Movie
				   $output.='	
				   <div class="col-md-4">
				      <span> 
				      	<a href="user_vote.php?vote=1&redirect='.$redirect.'&movieSelectedUserId='.$movieSelectedUserId.'&movieId='.$movieId.'" >Like</a>
				      </span> | 

				      <span hate-btn style="background-color:#2377cc; padding:9px; border-radius:20px;">
				      	<a href="user_vote.php?vote=2&redirect='.$redirect.'&movieSelectedUserId='.$movieSelectedUserId.'&movieId='.$movieId.'" style="color:#fff;">Hate</a> 
				      </span>
				    </div> ';
				}


			     }// end of if the loggin user has voted for the movie
			     else //if he has not voted yet
			     { 
				// let him vote
				$output.='	
				<div class="col-md-4">
				   <span like-btn> 
				   	<a href="user_vote.php?vote=1&redirect='.$redirect.'&movieSelectedUserId='.$movieSelectedUserId.'&movieId='.$movieId.'">Like</a>
				   </span> | 
				   <span hate-btn>
				   	<a href="user_vote.php?vote=2&redirect='.$redirect.'&movieSelectedUserId='.$movieSelectedUserId.'&movieId='.$movieId.'">Hate</a> 
				   </span>
				</div>';

			      }							

			    }

			}//end if isset session log in

			$output.='

			<div class="col-md-4">
				<p>Posted By:<a href="user_movies.php?movieSelectedUserId='.$movieUserId.'"> '.$userFullName.' </a></p>
			</div>


		</div><!-- row for likes , likes actions & posted by -->


	     </div><!-- movie box div end--> ';
				
	}  

      
	echo $output;
}


//////////////////////////////////////// ORDER BY HATES FROM user_movies.php //////////////////////////////////////////////

if (isset($_POST['userId3']))
{

	$output='';
	$movieSelectedUserId=$_POST['userId3'];

	$getMovies="SELECT * from movies WHERE movie_user_id = '".$_POST['userId3']."' ORDER BY movie_hates DESC  ;";
	$getMoviesResult=mysqli_query($conn,$getMovies);

	while($movieRows=mysqli_fetch_array($getMoviesResult))
	{
	   $movieId=$movieRows['movie_id'] ;
	   $movieTitle =$movieRows['movie_title'] ;
	   $movieDescription=$movieRows['movie_description'] ;
	   $movieUserId=$movieRows['movie_user_id']; 
	   $insertDate=$movieRows['movie_upload_date'] ;
	   $movieLikes=$movieRows['movie_likes'];
	   $movieHates=$movieRows['movie_hates'];


	   $getMovieUser="SELECT user_id, user_name , user_surname FROM users WHERE user_id= $movieUserId;";
	   $getMovieUserResult=mysqli_query($conn,$getMovieUser);
	   $userRows=mysqli_fetch_array($getMovieUserResult);

	   $userId=$userRows['user_id'];
	   $userFirstName=$userRows['user_name'];
	   $userLastName=$userRows['user_surname'];
			
?>





<?php
	  
		
	    if (isset ($_SESSION['logged_in']))
	    {
		if($userId == $_SESSION['id'])
		{
		  $userFullName='You';
		}
		else
		{
		  $userFullName=$userFirstName.' '. $userLastName ;
		}
					
	    }
	    else
	    {
		$userFullName=$userFirstName.' '. $userLastName ;
	    }
				
	   $output.='
	   <div class="movie-box">



	      <div class="row"><!--row for title & date -->

	         <div class="col-md-8"><!--column for title -->
		    <h4> '.$movieTitle.' </h4>
	         </div>

		 <div class="col-md-4">
		    <p> Inserted at : '.$insertDate.' </p>
		 </div>

	      </div><!-- end of row for title & date -->



	         <div class="movie-description">
	            <p> '.$movieDescription.' </p>
	         </div>

	      <div class="row"><!--row for likes , likes actions & posted by -->

		  <div class="col-md-4"><!--column for title -->
		      <span> '.$movieLikes.' (Likes) </span>|<span> '.$movieHates.' (Hates)</span>
	          </div>';

			if (isset ($_SESSION['logged_in']))
			{
			  if($userId == $_SESSION['id'])
			  {
			   $output.='	
		<div class="col-md-4">
		   <span class= "like-link"> <a href="#" style="color:#858585;">Like</a></span> | <span class="hate-link"><a href="" style="color:#858585;">Hate</a> </span>
		</div>';
			   }
			   else
			   {
									
			    $checkUserVote="SELECT * FROM user_votes WHERE movie_id = $movieId AND user_id = $_SESSION[id];";
			    $checkUserVoteResult=mysqli_query($conn,$checkUserVote);
			    $UserVoteResultRows=mysqli_fetch_array($checkUserVoteResult);


			    if (mysqli_num_rows($checkUserVoteResult) > 0) //if the loggin user has voted for the movie
			    {

		              $voteAction=$UserVoteResultRows['rating_action'];

		               //we want to see if he liked or hated the movie

				if ($voteAction=='Like')//if he has liked the movie
				{
				   //Show That he has Liked The Movie
				  $output.='
				<div class="col-md-4">
					<span style="background-color:#2377cc; padding:9px; border-radius:20px;"> 
						<a href="user_vote.php?vote=1&redirect='.$redirect.'&movieSelectedUserId='.$movieSelectedUserId.'&movieId='.$movieId.'" style="color:#fff;">Like</a>
					</span> |

					<span hate-btn>
						<a href="user_vote.php?vote=2&redirect='.$redirect.'&movieSelectedUserId='.$movieSelectedUserId.'&movieId='.$movieId.'">Hate</a> 
					</span>
				</div>
				';					

				}
				else //if he has hated the movie
				{
				  //Show That he has Disliked The Movie
				   $output.='	
				   <div class="col-md-4">
				      <span> 
				      	<a href="user_vote.php?vote=1&redirect='.$redirect.'&movieSelectedUserId='.$movieSelectedUserId.'&movieId='.$movieId.'" >Like</a>
				      </span> | 

				      <span hate-btn style="background-color:#2377cc; padding:9px; border-radius:20px;">
				      	<a href="user_vote.php?vote=2&redirect='.$redirect.'&movieSelectedUserId='.$movieSelectedUserId.'&movieId='.$movieId.'" style="color:#fff;">Hate</a> 
				      </span>
				    </div> ';
				}


			     }// end of if the loggin user has voted for the movie
			     else //if he has not voted yet
			     { 
				// let him vote
				$output.='	
				<div class="col-md-4">
				   <span like-btn> 
				   	<a href="user_vote.php?vote=1&redirect='.$redirect.'&movieSelectedUserId='.$movieSelectedUserId.'&movieId='.$movieId.'">Like</a>
				   </span> | 
				   <span hate-btn>
				   	<a href="user_vote.php?vote=2&redirect='.$redirect.'&movieSelectedUserId='.$movieSelectedUserId.'&movieId='.$movieId.'">Hate</a> 
				   </span>
				</div>';

			      }							

			    }

			}//end if isset session log in

			$output.='

			<div class="col-md-4">
				<p>Posted By:<a href="user_movies.php?movieSelectedUserId='.$movieUserId.'"> '.$userFullName.' </a></p>
			</div>


		</div><!-- row for likes , likes actions & posted by -->


	     </div><!-- movie box div end--> ';
				
	}  

      
	echo $output;
}