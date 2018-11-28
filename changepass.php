<?php
  include 'lib/user.php';
  include 'inc/file/header.php';
  Session::checkSession();
?>

  <?php

    if(isset($_GET['id'])){
      $userid = (int)$_GET['id'];
      $sesID = Session::get("id");
      if($userid != $sesID){
        header("Location: index.php");
    }
  }
    $user =new User();
   ?>
   <?php
       $user=new User();
       if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updatepass'])) {
         // code...
         $updatepass=$user->updatepassword($userid, $_POST);
       }


    ?>
<div class="panel panel-default">
    <div class="panel-heading">
      <h2>User Profile <span class="pull-right"><a href="profile.php?id=<?php echo $userid;?>" class="btn btn-success"> back</a></span> </h2>
    </div>

      <div class="panel-body">
        <div style="max-width:600px; margin:0 auto">
          <?php
                if(isset($updatepass)){
                  echo $updatepass;
                }
           ?>

        <form  action="" method="POST">

          <div class="form-group">
            <label for="old_password">Old Password</label>
            <input type="password" id="old_password" name="old_password" class="form-control"  />
          </div>
          <div class="form-group">
            <label for="new_password">New Password</label>
            <input type="password" id="password" name="password" class="form-control"  />
          </div>

            <?php
                $sesID = Session::get("id");
                if($userid == $sesID){
                  ?>

                    <button type="submit" name="updatepass" class="btn btn-success">update password</button>


                <?php
                }
             ?>




        </form>


          </div>

      </div>
      <div class="panel-footer">

      </div>
    </div>




<?php include 'inc/file/footer.php'; ?>
