<?php
include ("up.php");
?>


<div class="container">
  <h2>Sign Up</h2><br>


  <form action="signup.php" method=post>

    <div class="form-group">
      <label for="fname1">First Name:</label>
      <input type="text" class="form-control" id="fname1" placeholder="Enter Your First Name" name="fname">
    </div>

    <div class="form-group">
      <label for="lname1">Last Name:</label>
      <input type="text" class="form-control" id="lname1" placeholder="Enter Your Last Name" name="lname">
    </div>


      <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email1" placeholder="Enter Email" name="email">
    </div>

    <div class="form-group">
      <label for="pwd1">Password:</label>
      <input type="password" class="form-control" id="pwd1" placeholder="Enter password" name="pwd">
    </div>

    <div class="form-group">
      <label for="rpwd1"> Re-Enter Password</label>
      <input type="password" class="form-control" id="rpwd1" placeholder="Enter password" name="rpwd">
    </div>


    <div class="form-group">
        <button type="submit" class="btn btn-danger">Sign Up</button>
    </div>

<div class="container">




  </form>
<br><br>
</div>



<?php
include "footer.php";
?>