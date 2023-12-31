<?php

include 'Views/public/layout.php';
include('Database/Connection.php');
include('Database/Model/Souvenir.php');

$Message ="Sorry ! there Are a problem" ;
    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if(isset($_POST["post-identifire"]))
    {
        switch($_POST["post-identifire"])
        {
            case "buysouviner":
                $id =(isset($_POST['id']) ? $_POST['id'] : '') ;
                $price =(isset($_POST['price']) ? $_POST['price'] : '') ;
                $souviner= new Souvenir($pdo);
                $item =$souviner->getSouvenirById($id);
                $user_id=$_SESSION['user_id'];
                $itemQuantity = isset($_POST['itemQuantity']) ? $_POST['itemQuantity'] : '';    
                $souviner->buySouvenir($user_id,$id,$itemQuantity);
                $Message ="Process Complete Successfuly" ;
                break;
            case "bookticket":

                break;
            default : 
                $Message ="Sorry ! there Are a problem" ;
                break;
        }
    }


} 


echo '

<div class="description">
    <div class="container">
        <h2>'. ($Message).'</h2>
        <br/>
        <p>
            Explore the rich history and artistry that our museum has to offer. 
            Immerse yourself in a journey through time and culture as you discover 
            more than just a museum. Enjoy the vast exhibition galleries, 
            the expansive square meter area, and over a hundred thousand masterpieces.
            Join the millions of visitors who have experienced the magic since our opening.
        </p>
    </div>
</div>

';




