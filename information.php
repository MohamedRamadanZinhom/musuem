<?php
include 'Views/public/layout.php';
include('Database/Connection.php');
include('Database/Model/Content.php');

$content=new Content($pdo);
$contents=$content->getAllContent();

echo '
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="resources/CSS/information.css">

<div class="container">
';

foreach ($contents as $item) {
    echo '
    <!-- Item 1 -->
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="resources/images/local/'.$item['image'].'" class="img-fluid rounded-start card-img" alt="Item 1 Image">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">'.$item['name'].'</h5>
                    <p class="card-text">'.$item['description'].'.</p>
                </div>
            </div>
        </div>
    </div>
    ';
}

echo '
</div>
';





// echo '

// <link rel="stylesheet" href="resources/CSS/souviner.css">
// <div class="container mt-5">
//     <div class="row row-cols-1 row-cols-md-3 g-4">

//         <!-- Item 1 -->
//         <div class="col">
//             <div class="card">
//                 <img src="resources/images/local/Mask of Tutankhamun.jpg" class="card-img-top" alt="Item 1 Image">
//                 <div class="card-body">
//                     <h5 class="card-title">Item 1</h5>
//                     <p class="card-text">Description for Item 1. Add more details here.</p>
//                 </div>
//             </div>
//         </div>

//         <!-- Item 2 -->
//         <div class="col">
//             <div class="card">
//                 <img src="resources/images/local/Statue of Djoser.jpg" class="card-img-top" alt="Item 2 Image">
//                 <div class="card-body">
//                     <h5 class="card-title">Item 2</h5>
//                     <p class="card-text">Description for Item 2. Add more details here.</p>
//                 </div>
//             </div>
//         </div>

//         <!-- Item 3 -->
//         <div class="col">
//             <div class="card">
//                 <img src="resources/images/local/Statue of Djoser.jpg" class="card-img-top" alt="Item 3 Image">
//                 <div class="card-body">
//                     <h5 class="card-title">Item 3</h5>
//                     <p class="card-text">Description for Item 3. Add more details here.</p>
//                 </div>
//             </div>
//         </div>

//         <!-- Add more items as needed -->
//     </div>
// </div>


// ';

?>

<!-- Bootstrap JS and Popper.js (required for Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
