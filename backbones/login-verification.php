<?php
session_start();
if(isset($_POST['submit'])){
  include('includes/global.php');
  if(!empty($_POST['username'])&&!empty($_POST['password'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $userInDatabase = $myPDO->prepare('SELECT * FROM Users WHERE username = :username');
    $userInDatabase->bindParam(':username', $username);
    $userInDatabase->execute();
    $results = $userInDatabase->fetch(PDO::FETCH_ASSOC);
    if(count($results)>0 && password_verify($password,$results['Password'])){
      $_SESSION['Role']=$results['Role'];
      $_SESSION['First_Name']=$results['First_Name'];
      $_SESSION['Last_Name']=$results['Last_Name'];
      redirect('../index.php');
    }
    else{
      $_SESSION['error']="true";
      redirect('../login.php');
    }
    //$hashedPassword=password_hash($password, PASSWORD_BCRYPT);
    //echo($hashedPassword);
    die();
  }else{
    $_SESSION['error']="true";
    redirect('../login.php');
  }
  // $verifyLoginQuery = $myPDO->prepare
  // $userName = $_POST['username']
  // $password = $_POST
}
else{
  $_SESSION['error']="true";
  redirect('../login.php');
}
?>
