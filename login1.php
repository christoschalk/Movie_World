<?php
include ("up.php");
?>


  
	
<?php
if(isset($_POST['email']))
{
	function decryptthis($data, $key) {
	$encryption_key = base64_decode($key);
	list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
	return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
	}



	$email=htmlspecialchars($_POST['email'],ENT_QUOTES, 'UTF-8');
	$password=htmlspecialchars($_POST['pwd'],ENT_QUOTES, 'UTF-8');

		If (empty($email) || empty($password))

		{

			$_SESSION['status']= "Email or password fields are not filled out. Please try again";
          	$_SESSION['status_code']="error";  
          header("Location:index.php");
			
			header("Location:login.php");

		}
		else
		{

			$getUser="SELECT * FROM users WHERE user_email='$email';";
			echo $getUser;
			$getUserResult=mysqli_query($conn,$getUser);

			if(mysqli_num_rows($getUserResult) > 0 )
			{
				while ($rowUser=mysqli_fetch_array($getUserResult))
				{
					$userId=$rowUser['user_id'];
					$userFirstName=$rowUser['user_name'];
					$userLastName=$rowUser['user_surname'];
					$userEmail=$rowUser['user_email'];


					$decryptedPassword=decryptthis($rowUser['user_password'],$key);

					if($password != $decryptedPassword )
					{
						$_SESSION['status']= "Your credentials were not correct. Please try again";
          				$_SESSION['status_code']="success";  
						
						header("Location:login.php");
					}
					else
					{
						session_start();
						$_SESSION['logged_in']=1;
						$_SESSION['id']=$userId;
						$_SESSION['email']=$userEmail;
						$_SESSION['firstName']=$row['user_name'];
						$_SESSION['surName']=$row['user_surname'];


						$_SESSION['status']= "You are now logged in";
          				$_SESSION['status_code']="success";  
						header("Location:index.php?loggedIn");
					}
				}
			}			
			else
			{			

				$_SESSION['status']= "There is no user with these credentials";
          		$_SESSION['status_code']="error";  
				header("Location:login.php");

			}



	
		}

}