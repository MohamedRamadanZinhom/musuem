<?php

include 'Views/public/layout.php';
include('Database/Connection.php');
include('Database/Model/Souvenir.php');




$id =(isset($_GET['id']) ? $_GET['id'] : '') ;
$price =(isset($_GET['price']) ? $_GET['price'] : '') ;
$souviner= new Souvenir($pdo);
$item =$souviner->getSouvenirById($id);
echo '

<link rel="stylesheet" href="resources/CSS/Form.css">




<div class="container">
    <form action="Result.php" method="post">
        <div class="boxes">
            <div class="box">
                <input type="text" name="id" value="' . $id . '" hidden>
                <input type="text" name="post-identifire" value="buysouviner" hidden>
                <input type="text" name="price" value="' . $price . '" hidden>
                <img src="resources/images/local/'.$item['image'].'" alt="image">
                <div class="info">
                    <h4>'.$item['name'].'</h4>
                    <br/>
                    <br/>
                    <br/>
                    <div class="quantity">
                        <label for="itemQuantity">Quantity of Items:</label>
                        <input type="number" id="itemQuantity" name="itemQuantity" value="1" min="1" required>
                    </div>
                    <div class="quantity-buttons">
                        <button class="btn btn-success" type="button" onclick="incrementQuantity()">+</button>
                        <button class="btn btn-warning" type="button" onclick="decrementQuantity()">-</button>
                    </div>
                </div>
            </div>
            <p class="description">'.$item['description'].'</p>
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
        window.location.href="Souviner.php";
    }
</script>







