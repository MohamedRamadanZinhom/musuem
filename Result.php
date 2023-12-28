<?php

include('Database/Model/Connection.php');
include('Database/Model/Product.php'); 
include('Database/Model/Order.php'); 
include('Database/Model/Visitor.php'); 

$Message ="Sorry ! there Are a problem" ;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data here
    // Example: Get data from form
    $first_name = isset($_POST['firstName']) ? $_POST['firstName'] : '';
    $last_name = isset($_POST['lastName']) ? $_POST['lastName'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $country = isset($_POST['country']) ? $_POST['country'] : '';
    $itemQuantity = isset($_POST['itemQuantity']) ? $_POST['itemQuantity'] : '';
    $type = isset($_POST['visitorType']) ? $_POST['visitorType'] : '';
    $product_id= isset($_POST['id']) ? $_POST['id'] : '';
    $product_price= isset($_POST['price']) ? $_POST['price'] : '';
    $visitor = new Visitor();
    $visitor->createVisitor($first_name, $last_name, $country,$email, $mobile, $address, $type);
    $visitor_id=$visitor->getLastInsertedId();

    $cost =floatval($itemQuantity)*floatval($product_price);
    $order =new Order();
    $order->createOrder($visitor_id, $product_id, $itemQuantity,$cost) ;

    $Message ="Process Complete Successfuly" ;
} 
$isAdmin=false;
if (isset($_SESSION['admin_name'])) {
   $isAdmin=true;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/index.css">
  
    <link rel="stylesheet" href="CSS/souvinerform.css">
    <title>Egyption Musuem</title>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
        <img src="Image/logo.png" width="30" height="30" class="d-inline-block align-top" alt="Your Logo">
        Egyption Musuem
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Services
                </a>
                <div class="dropdown-menu" aria-labelledby="adminDropdown">
                    <a class="dropdown-item" href="TicketForm.php">Book Ticket</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="Souviner.php ">Buy Souvenir</a>
                </div>
            </li>
            <?php if($isAdmin){ ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Administrator
                </a>
                <div class="dropdown-menu" aria-labelledby="adminDropdown">
                    <a class="dropdown-item" href="#">Admin Dashboard</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Logout</a>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
   
    <ul class="navbar-nav ml-auto">
        <?php if($isAdmin){ ?>
        <li class="nav-item">
            <span class="nav-link"><?php $_SESSION['admin_name']?></span>
        </li>
        <li class="nav-item">
        <a id="logout-link" class="nav-link" href="#">Logout</a>
        </li>
        <?php }else { ?>
        <li class="nav-item">
            <a class="nav-link" href="Login.php">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="Register.php">Register</a>
        </li>
        <?php } ?>
    </ul>
</nav>



<section>
<div class="description">
    <div class="container">
        <h2><?php echo($Message) ?></h2>
        <br/>
        <p>
            Explore the rich history and artistry that our museum has to offer. 
            Immerse yourself in a journey through time and culture as you discover 
            more than just a museum. Enjoy the vast exhibition galleries, 
            the expansive square meter area, and over a hundred thousand masterpieces.
            Join the millions of visitors who have experienced the magic since our opening.
        </p>
    </div>
</div>

</section>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
