<?php
include_once 'Session.php';
include 'Database.php';
class User{
    private $db;

    public function __construct(){
        $this->db=new Database();
    }
    public function userRegistation($data){
        $name     =  $data['name'];
        $username =  $data['username'];
        $email    =  $data['email'];
        $pass     =  $data['password'];
        $chk_email=$this->emailCheck($email);

        if($name == "" || $username == "" || $email == "" || $pass == "") {

            $msg = "<div class='alert alert-danger'> <strong> Error !!  </strong> Field must not be Empty </div>";
          return $msg;
        }

        if (strlen($pass)<6 ){
            $msg = "<div class='alert alert-danger'> <strong> Error !!  </strong> Password is too short.<br/>must be 6 characters</div>";

         return $msg;
       }

       $password =  md5($pass);

        if (strlen($username)<3 ){
            $msg = "<div class='alert alert-danger'> <strong> Error !!  </strong> Username is too short</div>";
          return $msg;
        }
        elseif (preg_match('/[^a-z0-9_-]+/i',$username)){
        // code...
            $msg = "<div class='alert alert-danger'> <strong> Error !!  </strong> Username must only contain alphanumarical, dashes and userscores! </div>";
          return $msg;
        }
        if(filter_var($email, FILTER_VALIDATE_EMAIL)=== false){
          $msg = "<div class='alert alert-danger'> <strong> Error !!  </strong> email address not found! </div>";
          return $msg;
        }
        if($chk_email == true){
            $msg = "<div class='alert alert-danger'> <strong> Error !!  </strong> email address already exist! </div>";
          return $msg;
        }

      $sql= "INSERT INTO tbl_user(name,username,email,password)  VALUES(:name, :username, :email, :password)";
      $query=$this->db->pdo->prepare($sql);
      $query->bindvalue(':name',$name);
      $query->bindvalue(':username',$username);
      $query->bindvalue(':email',$email);
      $query->bindvalue(':password',$password);
      $result= $query->execute();
      if($result){
          $msg = "<div class='alert alert-success'> <strong> Success !!  </strong> Thank you, you have been registered! </div>";
          return $msg;

      }else{
        $msg = "<div class='alert alert-danger'> <strong> Error !!  </strong> there is problem try later! </div>";
      return $msg;
      }

    }

    public function emailCheck($email){
        $sql = "SELECT email from tbl_user where email = :email";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':email',$email);
        $query->execute();
        if($query->rowCount() > 0){
          return true;
        }else{
          return false;
        }
    }

    public function getLoginUser($email,$password){
      $sql = "SELECT * from tbl_user where email = :email AND password = :password LIMIT 1";
      $query = $this->db->pdo->prepare($sql);
      $query->bindValue(':email',$email);
      $query->bindValue(':password',$password);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_OBJ);
      return $result;

    }
    public function userLogin($data)
    {
      # code...
      $email    =  $data['email'];
      $pass     =  md5($data['password']);
      $chk_email=$this->emailCheck($email);

      if( $email == "" || $pass == "") {
          $msg = "<div class='alert alert-danger'> <strong> Error !!  </strong> Field must not be Empty </div>";
        return $msg;
      }
      if(filter_var($email, FILTER_VALIDATE_EMAIL)=== false){
        $msg = "<div class='alert alert-danger'> <strong> Error !!  </strong> email address not found! </div>";
        return $msg;
      }
      $result= $this->getLoginUser($email,$pass);

      if($result){
        Session::init();
        Session::set("login",true);
        Session::set("id",$result->id);
        Session::set("name",$result->name);
        Session::set("username",$result->username);
        Session::set("loginmsg","<div class='alert alert-success'> <strong> Success !!  </strong> you are logged in! </div>");

        header("Location: index.php");


      }else{
              $msg = "<div class='alert alert-danger'> <strong> Error !!  </strong> data not found! </div>";

            return $msg;
      }

    }

    public function getUserData(){
      $sql = "SELECT * FROM tbl_user ORDER BY id DESC";
      $query = $this->db->pdo->prepare($sql);
      $query->execute();
      $result = $query->fetchAll();
      return $result;

    }
    public function getUserById($id){
      $sql = "SELECT * FROM tbl_user WHERE id = :id LIMIT 1";
      $query = $this->db->pdo->prepare($sql);
      $query->bindValue(':id',$id);
      $query->execute();
      $result = $query->fetch(PDO::FETCH_OBJ);
      return $result;

    }
    public function updateuser($id,$data)
    {
      // code...
      $name     =  $data['name'];
      $username =  $data['username'];
      $email    =  $data['email'];
      $chk_email=$this->emailCheck($email);

      if($name == "" || $username == "" || $email == "") {

          $msg = "<div class='alert alert-danger'> <strong> Error !!  </strong> Field must not be Empty </div>";
        return $msg;
      }

      if (strlen($username)<3 ){
          $msg = "<div class='alert alert-danger'> <strong> Error !!  </strong> Username is too short</div>";
        return $msg;
      }
      elseif (preg_match('/[^a-z0-9_-]+/i',$username)){
      // code...
          $msg = "<div class='alert alert-danger'> <strong> Error !!  </strong> Username must only contain alphanumarical, dashes and userscores! </div>";
        return $msg;
      }
      if(filter_var($email, FILTER_VALIDATE_EMAIL)=== false){
        $msg = "<div class='alert alert-danger'> <strong> Error !!  </strong> email address not found! </div>";
        return $msg;
      }
    $sql= "UPDATE tbl_user set
                name      = :name,
                username  = :username,
                email     = :email
                where id= :id" ;
    $query=$this->db->pdo->prepare($sql);
    $query->bindvalue(':name',$name);
    $query->bindvalue(':username',$username);
    $query->bindvalue(':email',$email);
    $query->bindvalue(':id',$id);
    $result= $query->execute();
    if($result){
        $msg = "<div class='alert alert-success'> <strong> Success !!  </strong> data updated succuss! </div>";
        return $msg;

    }else{
      $msg = "<div class='alert alert-danger'> <strong> Error !!  </strong> there is problem try later! </div>";
    return $msg;
    }
  }
  private function checkPassword($id,$old_pass)
  {
      $password=md5($old_pass);
      $sql = "SELECT password from tbl_user where id = :id AND password = :password";
      $query = $this->db->pdo->prepare($sql);
      $query->bindValue(':id',$id);
      $query->bindValue(':password',$password);
      $query->execute();
      if($query->rowCount() > 0){
        return true;
      }else{
        return false;
      }
  }

  public function updatepassword($id,$data)
  {
    $old_password     =  $data['old_password'];
    $new_password     =  $data['password'];
    if($old_password == "" || $new_password == "") {

        $msg = "<div class='alert alert-danger'> <strong> Error !!  </strong> Field must not be Empty </div>";
      return $msg;
    }
    $chk_pass = $this->checkPassword($id,$old_password);
    if($chk_pass ==false){
      $msg = "<div class='alert alert-danger'> <strong> Error !!  </strong> Old password does not match </div>";
      return $msg;
    }
    if(strlen($new_password) < 6){
      $msg = "<div class='alert alert-danger'> <strong> Error !!  </strong> password is too short </div>";
      return $msg;
    }
    $password=md5($new_password);
    $sql= "UPDATE tbl_user set
                password  = :password
                where id= :id" ;
    $query=$this->db->pdo->prepare($sql);

    $query->bindvalue(':password',$password);
    $query->bindvalue(':id',$id);
    $result= $query->execute();
    if($result){
        $msg = "<div class='alert alert-success'> <strong> Success !!  </strong> data updated succuss! </div>";
        return $msg;

    }else{
      $msg = "<div class='alert alert-danger'> <strong> Error !!  </strong> there is problem try later! </div>";
    return $msg;
    }

  }

}


 ?>
