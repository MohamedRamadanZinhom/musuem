<?php

include 'Views/layout.php';


echo '
<link rel="stylesheet" href="CSS/souvinerform.css">

<div class="container">
    <form action="Result.php" method="post">
        <input type="text" name="id" value="' . (isset($_GET['id']) ? $_GET['id'] : '') . '" hidden>
        <input type="text" name="price" value="' . (isset($_GET['price']) ? $_GET['price'] : '') . '" hidden>
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











