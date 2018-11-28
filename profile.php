<?php
  include 'lib/user.php';
  include 'inc/file/header.php';
  Session::checkSession();
?>

  <?php

    if(isset($_GET['id'])){
      $userid = (int)$_GET['id'];
    }
    $user =new User();
   ?>
   <?php
       $user=new User();
       if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
         // code...
         $updateusr=$user->updateuser($userid, $_POST);
       }


    ?>
<div class="panel panel-default">
    <div class="panel-heading">
      <h2>User Profile <span class="pull-right"><a href="index.php" class="btn btn-success"> back</a></span> </h2>
    </div>

      <div class="panel-body">
        <div style="max-width:600px; margin:0 auto">
          <?php
                if(isset($updateusr)){
                  echo $updateusr;
                }
           ?>

        <?php
          $userdata=$user->getUserById($userid);
          if($userdata){

         ?>
        <form  action="" method="POST">
          <div class="form-group">
            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" class="form-control" value="<?php  echo $userdata->name;  ?>" />
          </div>
          <div class="form-group">
            <label for="name">Username</label>
            <input type="text" id="username" name="username" class="form-control" value="<?php  echo $userdata->username;  ?>" />
          </div>
          <div class="form-group">
            <label for="Email">Email Address</label>
            <input type="text" id="email" name="email" class="form-control"  value="<?php  echo $userdata->email;  ?>" />
          </div>

            <?php
                $sesID = Session::get("id");
                if($userid == $sesID){
                  ?>

                    <button type="submit" name="update" class="btn btn-success">update</button>

                    <a class="btn btn-info" href="changepass.php?id=<?php echo $userid;?> ">change Password</a>

                <?php
                }
             ?>




        </form>

        <?php
              }
       ?>
          </div>

      </div>
      <div class="panel-footer">

      </div>
    </div>




<?php include 'inc/file/footer.php'; ?>
