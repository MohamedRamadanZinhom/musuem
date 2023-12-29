<?php
session_start();
$isAuthenticated=false;
$authenticationMessage="";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $admin =new Admin();

    if(isset($_POST["Login"]))
    {
        $username=isset($_POST["username"])? $_POST["username"]:"";
        $password=isset($_POST["password"])? $_POST["password"]:"";
        if($admin->login($username,$password)){
            header("Location: index.php");
            $isAuthenticated=true;
            $authenticationMessage="";
        }
        else
        {
            header("Location: Login.php");
            $isAuthenticated=false;
            $authenticationMessage="your username or password was incorrect please try again";

        }
    }
    else if(isset($_POST["Register"]))
    {
        $username=isset($_POST["name"])? $_POST["name"]:"";
        $password=isset($_POST["password"])? $_POST["password"]:"";   
        $email   =isset($_POST["email"])? $_POST["email"]:"";   
    }

}