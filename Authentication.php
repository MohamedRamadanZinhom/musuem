<?php

require_once 'Database/Model/User.php';
require_once 'Database/Connection.php';


session_start();
$user =new User($pdo);
$isAuthenticated=false;

if($_SERVER["REQUEST_METHOD"]=="POST")
{
   
    $user =new User($pdo);

    if(isset($_POST["Login"]))
    {
        
      
        $username=isset($_POST["username"])? $_POST["username"]:"";
        $password=isset($_POST["password"])? $_POST["password"]:"";
       
       
        if($user->authenticateUser($username,$password)){
        
            $userdata=$user->authenticateUser($username,$password);

            $isAuthenticated=true;
            $_SESSION["authenticationMessage"]="";
            $_SESSION["ISauthenticated"] ="true";
            $_SESSION['user_id'] = $userdata['id'];
            $_SESSION['admin_name']=$username;
            echo 'Welcome ';
            header("Location: index.php");
            exit();
        }
        else
        {
            $_SESSION["authenticationMessage"] ="your username or password was incorrect please try again";
            $_SESSION["ISauthenticated"] ="false";
            $_SESSION['admin_name']="";
            header("Location: Login.php");
            exit();
        }
    }
    else if(isset($_POST["Register"]))
    {
        $first_name=isset($_POST["first_name"])? $_POST["first_name"]:"";
        $last_name=isset($_POST["last_name"])? $_POST["last_name"]:"";   
        $username   =isset($_POST["username"])? $_POST["username"]:"";   
        $password=isset($_POST["password"])? $_POST["password"]:"";
        $email=isset($_POST["email"])? $_POST["email"]:"";   
        $role   =isset($_POST["role"])? $_POST["role"]:"";
        $user->Register($firstName, $lastName, $username, $email, $password,$role);
    }

}



function User()
{
    include('Database/Connection.php');
  
    if (isset($_SESSION['user_id'])) {
        $user =new User($pdo);
        return $user->getUserById($_SESSION['user_id']);
    } else {
        // User is not authenticated, redirect to the login page
        header("Location: login.php");
        exit();
    }
}

