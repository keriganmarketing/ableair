
<?php
$image1 = get_field('image_1', 4);
$image2 = get_field('image_2', 4);
$image3 = get_field('image_3', 4);
$image4 = get_field('image_4', 4);
$image5 = get_field('image_5', 4);
$image6 = get_field('image_6', 4);
?>

<div class="carousel-div">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php if($image1 != ''){ ?>
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li> 
            <?php } ?>
            <?php if($image2 != ''){ ?>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <?php } ?>
            <?php if($image3 != ''){ ?>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <?php } ?>
            <?php if($image4 != ''){ ?>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            <?php } ?>
            <?php if($image5 != ''){ ?>
            <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
            <?php } ?>
            <?php if($image6 != ''){ ?>
            <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
            <?php } ?>
        </ol>
        <div class="carousel-inner" role="listbox">
            <?php if($image1 != ''){ ?>
            <div class="carousel-item carousel-item-1 active">
                <img class="d-block" src="<?php echo $image1; ?>" alt="First slide">
            </div>
            <?php } ?>
            <?php if($image2 != ''){ ?>
            <div class="carousel-item">
                <img class="d-block" src="<?php echo $image2; ?>" alt="Second slide">
            </div>
            <?php } ?>
            <?php if($image3 != ''){ ?>
            <div class="carousel-item">
                <img class="d-block" src="<?php echo $image3; ?>" alt="Third slide">
            </div>
            <?php } ?>
            <?php if($image4 != ''){ ?>
            <div class="carousel-item">
                <img class="d-block" src="<?php echo $image4; ?>" alt="Fourth slide">
            </div>
            <?php } ?>
            <?php if($image5 != ''){ ?>
            <div class="carousel-item">
                <img class="d-block" src="<?php echo $image5; ?>" alt="Fifth slide">
            </div>
            <?php } ?>
            <?php if($image6 != ''){ ?>
            <div class="carousel-item">
                <img class="d-block" src="<?php echo $image6; ?>" alt="Sixth slide">
            </div>
            <?php } ?>
        </div>
    </div>
</div>
