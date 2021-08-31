<?php
include ("up.php");
?>



<?php 
if(isset($_POST['email']))
{
  

        function encryptthis($data, $key) {
        $encryption_key = base64_decode($key);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
        return base64_encode($encrypted . '::' . $iv);
        }
   
        $firstName = htmlspecialchars($_POST['fname'],ENT_QUOTES, 'UTF-8');
        $lastName = htmlspecialchars($_POST['lname'],ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars($_POST['email'],ENT_QUOTES, 'UTF-8');
        $password = htmlspecialchars($_POST['pwd'],ENT_QUOTES, 'UTF-8');
        $reEnterPassword = htmlspecialchars($_POST['rpwd'],ENT_QUOTES, 'UTF-8');
        $encryptedPassword= encryptthis( $password ,$key);

   

       $insertUser="insert into users (
        user_name,
        user_surname,
        user_email,
        user_password  )

        values(?,?,?,?);";

        $stmt=mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt,$insertUser))
        {
          $_SESSION['status']= "There was a problem with Inserting the user in Database.";
          $_SESSION['status_code']="error";  
          header("Location:index.php");
        }   
        else
        {
          mysqli_stmt_bind_param
          ($stmt,"ssss",
          $firstName,
          $lastName,
          $email,
          $encryptedPassword
          );

          mysqli_stmt_execute($stmt);

          $_SESSION['status']= "Welcome to our system. You are ready to Log in.";
          $_SESSION['status_code']="success";  
          header("Location:index.php");

        }
 
}

?>

<?php
include "footer.php";
?>