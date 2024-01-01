<?php

include 'Views/public/layout.php';


User();


echo '

<link rel="stylesheet" href="resources/CSS/Form.css">




<div class="container">
    <form action="Result.php" method="post">
        <div class="boxes">
            <div class="box">
                <input type="text" name="post-identifire" value="bookticket" hidden>
                <img src="resources/images/logo.png" alt="image">
                <div class="info">
                    <br/>
                    <br/>
                    <br/>
                    <div class="quantity">
                        <label for="itemQuantity">Quantity of Tickets:</label>
                        <input type="number" id="itemQuantity" name="itemQuantity" value="1" min="1" required>
                    </div>
                    <div class="quantity-buttons">
                        <button class="btn btn-success" type="button" onclick="incrementQuantity()">+</button>
                        <button class="btn btn-warning" type="button" onclick="decrementQuantity()">-</button>
                    </div>
                </div>
            </div>
            <p class="description">
            Welcome to the Egyptian Museums exclusive online ticket purchasing page, where history enthusiasts and curious minds can embark on a captivating journey through the treasures of ancient Egypt without the hassle of queues. Immerse yourself in a seamless and user-friendly ticketing experience, ensuring your visit to this cultural haven is as smooth as the Niles waters.</p>
            <label for="visitorType">Visitor Type:</label>
            <select id="visitorType" name="visitorType">
                <option value="2">Regular Visitor</option>
                <option value="1">Student</option>
            </select>
            <div id="sub">
                <button class="btn btn-success" type="submit">Submit</button>
                <button id="cancelBtn" type="button" class="btn btn-danger" onclick="cancelbutton()">Cancel</button>
            </div>
        </div>
    </form>
</div>

';


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

    function cancelbutton() {
        window.location.href="index.php";
    }
</script>





