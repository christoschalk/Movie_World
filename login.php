<?php
include ("up.php");
?>


<div class="container">
  <h2>Log In</h2><br>
  <form action="login1.php" method=post>

    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
    </div>
    
    <button type="submit" class="btn btn-primary">Login</button>
  </form>
<br><br>
</div>



<?php
include "footer.php";
?>