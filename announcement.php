<?php

    require "db.php";

    $q = "SELECT * FROM announcement";
    $list = $con->query($q);
    $fetch = $list->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
    <style>
        .carousel-inner img{
            height: 500px;
            width: auto;
            display: block;
            margin-inline: auto;
        }
    </style>
</head>
<body>

<div class=" text-secondary fw-bold p-2 ps-0 mb-3 w-50 h3">Announcements</div>
    <?php if($list->num_rows){ ?>
<div class="bg-light d-flex align-items-center justify-content-center" style="width: 74vw; height: 68vh;">
    <div style="width: 60vw;" id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
    <!-- <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div> -->
    <div class="carousel-inner">

            
            <div class="carousel-item active" data-bs-interval="5000">
                <img src="https://sdovalenzuelacity.deped.gov.ph/wp-content/uploads/slider3/MATATAG.jpeg" class="" alt="...">
            </div>

            <?php do{ ?>

                <div class="carousel-item" data-bs-interval="5000">
                    <img src="<?php echo $fetch['pic'] ?>" class="" alt="...">
                </div>

            <?php }while($fetch = $list->fetch_assoc()) ?>

        
        
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" title="previous" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
        <span class="carousel-control-next-icon" title="next" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>

    

</div>

<?php }else{ ?>
    <div class="bg-light d-flex align-items-center justify-content-center" style="width: 74vw; height: 68vh;">
        <p>No announcement</p>
    </div>

<?php } ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>