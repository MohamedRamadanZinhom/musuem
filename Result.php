<?php

include 'Views/layout.php';
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

echo '

<div class="description">
    <div class="container">
        <h2>'. ($Message).'</h2>
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

';




