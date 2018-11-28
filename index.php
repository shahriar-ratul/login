<?php
  include 'lib/user.php';
  include 'inc/file/header.php';
  Session::checkSession();
  $user=new User();
?>




      <div class="panel panel-default">


        <?php
           $loginmsg = Session::get("loginmsg");
            if(isset($loginmsg)){
            echo $loginmsg;
            Session::set("loginmsg",NULL);
          }
        ?>
          <div class="panel-heading">
            <h2>User list <span class="pull-right"> <strong>Welcome! </strong>


              <?php

                  $name =Session::get("username");

                  if(isset($name)){
                      echo $name;
                  }

               ?>


            </span> </h2>
          </div>
          <div class="panel-body">
            <table class="table table-striped">
                <tr>
                  <th width="20%">Serial</th>
                  <th width="20%">Name</th>
                  <th width="20%">Username</th>
                  <th width="20%">Email Address</th>
                  <th width="20%">action </th>
                </tr>

                <?php

                          $user=new User();
                          $userdata=$user->getUserData();
                          if($userdata){
                            $i=0;
                            foreach ($userdata as $sdata) {
                              // code...
                              $i++;

                 ?>

                <tr>
                  <td><?php echo $i ?></td>
                  <td><?php echo $sdata['name'] ?></td>
                  <td><?php echo $sdata['username'] ?></td>
                  <td><?php echo $sdata['email'] ?></td>
                  <td>
                    <a class="btn btn-primary" href="profile.php?id=<?php echo $sdata['id'] ?>">View</a>
                  </td>
                </tr>

            <?php

              }
          } else{?>
            <tr>
              <td colspan="5"><h2>NO user data found .......</h2></td>

      <?php } ?>




            </table>

          </div>
          <div class="panel-footer">

          </div>
      </div>


<?php include 'inc/file/footer.php'; ?>
