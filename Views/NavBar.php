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