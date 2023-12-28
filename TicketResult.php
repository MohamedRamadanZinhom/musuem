<?php

include 'Views/layout.php';
include('Database/Model/Connection.php');
include('Database/Model/Product.php'); 
include('Database/Model/Ticket.php'); 
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
    $visitor = new Visitor();
    $visitor->createVisitor($first_name, $last_name, $country,$email, $mobile, $address, $type);
    $visitor_id=$visitor->getLastInsertedId();
    $dateTimeObject = new DateTime();
    $dateTimeString = $dateTimeObject->format("Y-m-d H:i:s");
    $cost = ($type=="Student")? 50 :100 ;
    $ticket =new Ticket();
    $ticket->createTicket($visitor_id, $dateTimeString, $cost*floatval($itemQuantity));

    $Message ="Process Complete Successfuly" ;
} 

echo '
<div class="description">
    <div class="container">
        <h2>' . $Message . '</h2>
        <br/>
        <p>
            Explore the rich history and artistry that our museum has to offer. 
            Immerse yourself in a journey through time and culture as you discover 
            more than just a museum. Enjoy the vast exhibition galleries, 
            the expansive square meter area, and over a hundred thousand masterpieces.
            Join the millions of visitors who have experienced the magic since our opening.
        </p>
    </div>
</div>';




