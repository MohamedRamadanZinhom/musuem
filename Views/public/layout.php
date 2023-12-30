<?php
include 'Authentication.php';
$isAdmin=false;
if(isset($_SESSION["ISauthenticated"]))
 {
    if($_SESSION["ISauthenticated"]=="true"){
      ($_SESSION["Role"]=="admin")?$isAdmin=true :$isAdmin=false;
    } 
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/CSS/index.css">
    <link rel="stylesheet" href="resources/CSS/login.css">
  
    
    <title>Egyption Musuem</title>
</head>
<body>

<?php require_once('NavBar.php'); ?>

<div id="content">
  <!-- page content -->
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


</body>
</html>
