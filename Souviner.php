<?php
include 'Views/layout.php';
include('Database/Model/Connection.php');
include('Database/Model/Product.php');

//$product=new Product();
//$products= $product->getAllProducts();

echo '

<link rel="stylesheet" href="CSS/souviner.css">

<div class="container">
    <div class="boxes">';
    
foreach ($products as $item) {
    echo '
        <div class="box">
            <img src="Image/localImage/' . $item['image'] . '" alt="image">
            <h4>Anubis</h4>
            <h4>$' . $item['price'] . '</h4>
            <p>' . $item['name'] . '</p>
            <a class="btn btn-warning" href="SouvinerForm.php?id=' . $item['id'] . '&price=' . $item['price'] . '">Buy Now</a>
        </div>';
}
echo '
    </div>
</div>';
