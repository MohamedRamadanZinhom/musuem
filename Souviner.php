<?php
include 'Views/public/layout.php';
include('Database/Connection.php');
include('Database/Model/Souvenir.php');


$souviner=new Souvenir($pdo);
$souviners=$souviner->getAllSouvenirs();
//$products= $product->getAllProducts();

 User();

echo '

<link rel="stylesheet" href="resources/CSS/souviner.css">


<div class="container">
    <div class="boxes">';
    
foreach ($souviners as $item) {
    echo '
        <div class="box">
            <img src="resources/images/local/' . $item['image'] . '" alt="image">
            <h4>' . $item['name'] . '</h4>
            <h4>$' . $item['price'] . '</h4>
            <p>' . $item['description'] . '</p>
            <a class="btn btn-warning" href="SouvinerForm.php?id=' . $item['id'] . '&price=' . $item['price'] . '">Buy Now</a>
        </div>';
}
echo '
    </div>
</div>';
