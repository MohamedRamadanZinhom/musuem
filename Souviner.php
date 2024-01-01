<?php

include('Database/Model/Connection.php');
include('Database/Model/Product.php');

$product=new Product();
$products= $product->getAllProducts();
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
    <link rel="stylesheet" href="CSS/souviner.css">
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

<section class="souvenirs">
     <!-- Souvenirs Section -->
        <div class="container">
            <div class="boxes">
                <?php foreach($products as $item){?>
                <!-- Souvenir Box 1 -->
                <div class="box">
                    <img src="Image/localImage/<?php echo $item['image']; ?>" alt="image">
                    <h4>Anubis</h4>
                    <h4>$<?php echo $item['price']; ?></h4>
                    <p><?php echo $item['name']; ?></p>
                    <a class="btn btn-warning" href="SouvinerForm.php?id=<?php echo $item['id']; ?>&price=<?php echo $item['price']; ?>">Buy Now</a>

                </div>

             <?php }?>
       
            </div>
        </div>
    </section>


<!-- Existing scripts and closing tags below -->


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
