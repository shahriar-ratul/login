<?php

  include 'inc/file/header.php';
  include 'lib/user.php';
  Session::checkLogin();
?>
<?php
    $user=new User();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
      // code...
      $userLogin=$user->userLogin($_POST);
    }


 ?>

<div class="panel panel-default">
  <div class="panel-heading">
    <h2> User Login</h>
  </div>
  <div class="panel-body">
    <div style="max-width:600px; margin:0 auto">

      <?php
            if(isset($userLogin)){
              echo $userLogin;
            }
       ?>

    <form  action="" method="post">
      <div class="form-group">
        <label for="Email">Email Address</label>
        <input type="text" id="email" name="email" class="form-control"  />
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control"/>

      </div>

        <button type="submit" name="login" class="btn btn-success">Login</button>

    </form>
      </div>

  </div>
  <div class="panel-footer">

  </div>
</div>

<?php include 'inc/file/footer.php'; ?>
