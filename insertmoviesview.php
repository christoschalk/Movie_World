<?php
include ("up.php");
?>

<div class="container">
  <h2>Insert Your Movie Here!</h2><br>
  <form action="insertmovie.php" method=post>

    <div class="form-group">
      <label for="title">Title:</label>
      <input type="text" class="form-control" required placeholder="Enter Title" name="title">
    </div>

    <div class="form-group">
      <label for="description">Description:</label>
      <textarea name=description  class="form-control" required placeholder="Enter Description" name="description"></textarea>
    </div>
    
    <div class="form-group">
        <button type="submit" name='submit-movie' class="btn btn-danger">Save Movie</button>
    </div>

  </form>
    <br><br>
</div>


<?php
include "footer.php";
?>