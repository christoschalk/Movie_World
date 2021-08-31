<?php
include ("up.php");
?>

<?php


if(isset($_POST['submit-movie']))
{
     
    $movieTitle = htmlspecialchars($_POST['title'],ENT_QUOTES, 'UTF-8');
    $movieDescription= htmlspecialchars($_POST['description'],ENT_QUOTES, 'UTF-8');

    $userId=$_SESSION['id']; 
    $insertDate= date("Y/m/d");
    $movieLikes=0;
    $movieHates=0;
  
  $insertMovie="insert into movies (movie_title,
   movie_description ,
   movie_upload_date,
   movie_user_id,
   movie_likes,
   movie_hates)
  values(?,?,?,?,?,?);";
    
     $stmt=mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$insertMovie))
        {
          $_SESSION['status']= "There was a problem with Inserting the movie in Database.";
          $_SESSION['status_code']="error";  
          header("Location:index.php");

          
        }   
        else
        {
          mysqli_stmt_bind_param
          ($stmt,"sssiii",
          $movieTitle,
          $movieDescription,
          $insertDate,
          $userId,
          $movieLikes,
          $movieHates);

          mysqli_stmt_execute($stmt);


          $_SESSION['status']= "Your Movie Was Inserted.";
          $_SESSION['status_code']="success";  
       
          header("Location:index.php");

             

          
         
            
        }
}
  
 