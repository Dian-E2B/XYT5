<?php
include 'connection.php';
session_start();
class Login{




public function setUsername($username){
         $this->username = $username;
    }

public function getUsername(){
  return $this->username;
}

public function setPassword($password){
         $this->password = $password;
    }

public function getPassword(){
  return $this->password;
}

public function insertsingle()
{
     $string = "SELECT *FROM tbl_login where username=? AND password=?";
     $stmt = mysqli_prepare($this->$connection, $string);
     $stmt->bind_param("s",$this->getUserName(), $this->getPassword());
     $rsint = $stmt->execute();
     return $rsint;
}
}





 ?>
