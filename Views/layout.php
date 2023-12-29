<?php

include('Database/Model/Connection.php');
include('Database/Model/Admin.php'); 
session_start();
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
    <script src="../JS/index.js"></script>
    <title>Egyption Musuem</title>
</head>
<body>


<?php require_once('Views/NavBar.php'); ?>

<div id="content">
  <!-- page content -->
</div>


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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


</body>
</html>
