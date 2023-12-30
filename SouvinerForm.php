<?php

include 'Views/public/layout.php';
include('Database/Connection.php');
include('Database/Model/Souvenir.php');




$id =(isset($_GET['id']) ? $_GET['id'] : '') ;
$price =(isset($_GET['price']) ? $_GET['price'] : '') ;
echo '

<link rel="stylesheet" href="resources/CSS/souvinerForm.css">

<div class="container">
    <form action="SouvinerForm.php" method="post">
        <input type="text" name="id" value="' . $id . '" hidden>
        <input type="text" name="price" value="' . $price . '" hidden>
        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" required>

        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="mobile">Mobile:</label>
        <input type="tel" id="mobile" name="mobile" required>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>

        <label for="country">Country:</label>
        <input type="text" id="country" name="country" required>

        <label for="itemQuantity">Quantity of Items:</label>

        <div class="quantity">
            <input type="number" id="itemQuantity" name="itemQuantity" value="1" min="1" required>
            <button type="button" class="btn btn-warning" onclick="decrementQuantity()">-</button>
            <button class="btn btn-success" type="button" onclick="incrementQuantity()">+</button>
        </div>
        
        <label for="visitorType">Visitor Type:</label>
        <select id="visitorType" name="visitorType">
            <option value="regular">Regular Visitor</option>
            <option value="student">Student</option>
        </select>

        <div id="sub">
            <button class="btn btn-success" type="submit">Submit</button>
            <button id="cancelBtn" type="button" class="btn btn-danger" onclick="window.location.href=\'Souviner.php\'">Cancel</button>
        </div>
  
    </form>
</div>';
?>
<script>
    document.getElementById('cancelBtn').classList.add('cancel');
</script>

<script>
    function incrementQuantity() {
        const quantityInput = document.getElementById('itemQuantity');
        quantityInput.value = parseInt(quantityInput.value) + 1;
    }

    function decrementQuantity() {
        const quantityInput = document.getElementById('itemQuantity');
        if (parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
        }
    }
</script>



<?php 





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





