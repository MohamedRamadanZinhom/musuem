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
    <script src="JS/index.js"></script>
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
        <h2>Welcome to Our Museum</h2>
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

<!-- Existing content (header, about, and statistics) above -->

<!-- Footer with transparent boxes -->
<footer class="bottom-section">
    <div class="container">
        <div class="boxes">
        <div class="box">
                <h4>More Than</h4>
                <br />
                <h5> 100,000</h5>
                <p>Masterpieces</p>
            </div>  
            <div class="box">
                <h4>More Than</h4>
                <br />
                <h5>100,000,000</h5>
                <p>Visitors since opening</p>
            </div>
            <div class="box">
                <h4>More Than</h4>
                <br />
                <h5>10,000</h5>
                <p>Sq. Meter Area</p>
            </div>
        </div>
        <div class="text">
            <p><h1>More than just a Museum</h1></p>
        </div>
    </div>
</footer>

<!-- Existing scripts and closing tags below -->


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</body>
</html>
