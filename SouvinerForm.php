<?php

include('Database/Model/Connection.php');
include('Database/Model/Admin.php'); 
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
<div class="">
    <div class="container">
        <form action="Result.php" method="post">
            <input type="text" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>" hidden>
            <input type="text" name="price" value="<?php echo isset($_GET['price']) ? $_GET['price'] : ''; ?>" hidden>
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
                <button id="cancelBtn" type="button" class="btn btn-danger" onclick="window.location.href='Souviner.php'">Cancel</button>

            </div>
          
        </form>
    </div>
</div>

</section>



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

</body>
</html>
