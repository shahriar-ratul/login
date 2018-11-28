<?php

  include 'inc/file/header.php';
  include 'lib/user.php';


?>

<?php
    $user=new User();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
      // code...
      $userReg=$user->userRegistation($_POST);
    }


 ?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h2> User Register</h>
  </div>
  <div class="panel-body">
    <div style="max-width:600px; margin:0 auto">
<?php
      if(isset($userReg)){
        echo $userReg;
      }
 ?>

    <form  action="" method="POST">
      <div class="form-group">
        <label for="name">Your Name</label>
        <input type="text" id="name" name="name" class="form-control"  />
      </div>
      <div class="form-group">
        <label for="name">Username</label>
        <input type="text" id="username" name="username" class="form-control"  />
      </div>
      <div class="form-group">
        <label for="Email">Email Address</label>
        <input type="text" id="email" name="email" class="form-control"  />
      </div>


      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control"  />

      </div>

        <button type="submit" name="register" class="btn btn-success">register</button>

    </form>
      </div>

  </div>
  <div class="panel-footer">

  </div>
</div>

<?php include 'inc/file/footer.php'; ?>
