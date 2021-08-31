<?php
include "up.php";

$movieSelectedUserId=$_GET['movieSelectedUserId'];
$redirect=2;

?>

<div class="header">
   <div class="row">
     <div class="col-md-8">
	<h1><a href="index.php">Movie World</a></h1>
	   <?php

	     $query = "SELECT movie_id FROM movies WHERE movie_user_id = $movieSelectedUserId ORDER BY movie_id";  
	     $query_run = mysqli_query($conn, $query);
	     $row1 = mysqli_num_rows($query_run);
	     echo '<h5> Found: '.$row1.' Movies</h5>';
            ?>
       </div> 


       <div class="col-md-4">
       	  <div class="row">
	     	<div class="col-md-8">
		<?php

	
			   $getMovies="SELECT * from movies WHERE movie_user_id = $movieSelectedUserId ;";
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
			   $userFullName=$userFirstName.' '. $userLastName;	
		





		}


				if (isset ($_SESSION['logged_in']))
				{
					$loggedUserId=$_SESSION['id'];
					$getLoggedUser="SELECT * FROM users WHERE user_id= $loggedUserId;";
					$LoggedUserResult=mysqli_query($conn,$getLoggedUser);
					$LoggedUserRow=mysqli_fetch_array($LoggedUserResult);


					$logginUserFirstName=$LoggedUserRow['user_name'];
					$logginUserLastName=$LoggedUserRow['user_surname'];
					$logginUserFullName	=$logginUserFirstName.' '.$logginUserLastName;

				  echo '<br>Welcome Back:<a href="user_movies.php?movieSelectedUserId='.$movieUserId.'"> '.$logginUserFullName.'</a>';
				}
				else
				{
				  echo'<h3> <a href="login.php">Login</a><h3>';
				}

				?>

		</div>

		<div class="col-md-4">
		<?php

		if (isset ($_SESSION['logged_in']))
		{
		  echo'<h2><a href="logout.php">Logout</a> <h2>';
		}
		else
		{
		  echo'<button type="button" class="btn btn-primary btn-lg" ><a style= "color:#fff;" href="signupview.php">Sign Up</a></button>';
		}
		?>

		
		</div>
       	  </div><!-- row end -->
       </div><!-- col-4 end -->
   </div><!-- row end -->

<!-------------------------------------------------------------------------------------------->


<div class="row">
   <div class="col-md-8" id="movie-box-1">
			
	<?php

	$getMovies="SELECT * from movies WHERE movie_user_id = $movieSelectedUserId;";
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
				
	    echo'
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
			   echo'	
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
				  echo'	
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
				   echo'	
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
				echo'	
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

			echo'

			<div class="col-md-4">
				<p>Posted By:<a href="user_movies.php?movieSelectedUserId='.$movieUserId.'"> '.$userFullName.' </a></p>
			</div>


		</div><!-- row for likes , likes actions & posted by -->


	     </div><!-- movie box div end--> ';
				
	}  ?>

      </div><!-- first main column div end -->


     <div class="col-md-4">

	<?php

	 if (isset ($_SESSION['logged_in']))
	 {
	   echo'	
	   <div class="col-md-12">				
	     <button type="button" class="btn btn-success btn-lg">
	     	<a style= "color:#fff;" href="insertmoviesview.php">New Movie</a>
	     </button>
	     <br><br>
	    </div>';
	  }  ?>




	  <div class="filter-box">
							
		<u>Sort By</u><br><br>
	
	     <input type="checkbox" id="date1" name="date-box" value="Date">
	      <label for="date1"> Date</label><br><br>
	     <input type="checkbox" id="likes1" name="like-box" value="Likes">
	      <label for="likes1"> Likes</label><br><br>
	     <input type="checkbox" id="hates1" name="hate-box" value="Dislikes">
		<label for="dislikes1"> Dislikes</label><br><br>

		
		<a href="user_movies.php?movieSelectedUserId=<?php  echo $movieSelectedUserId; ?>"><button type="submit" class="btn btn-primary btn-sm">Reset</button></a>
       
	   </div>

	</div>
			
</div><!--row end -->

</div>




<script>

 $(document).ready(function(){  
      $('#date1').click(function(){  
      	
           var userId1 = '<?php echo $movieSelectedUserId ;?>';  
            
           $.ajax({  
                url:"short_movies.php",  
                method:"POST",  
                data:{userId1:userId1},  
                success:function(data){  
                     $('#movie-box-1').html(data);  
                }  
           });  
      });  
 }); 



 $(document).ready(function(){  
      $('#likes1').change(function(){  
      	
           var userId2 = '<?php echo $movieSelectedUserId ;?>';            
           $.ajax({  
                url:"short_movies.php",  
                method:"POST",  
                data:{userId2:userId2},  
                success:function(data){  
                     $('#movie-box-1').html(data);  
                }  
           });  
      });  
 }); 



 $(document).ready(function(){  
      $('#hates1').change(function(){  
      	
           var userId3 = '<?php echo $movieSelectedUserId ;?>';          
           $.ajax({  
                url:"short_movies.php",  
                method:"POST",  
                data:{userId3:userId3},  
                success:function(data){  
                     $('#movie-box-1').html(data);  
                }  
           });  
      });  
 }); 

swal("Hello world!");
</script>

<?php
include "footer.php";
?>
