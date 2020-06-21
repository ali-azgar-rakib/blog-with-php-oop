<?php
require_once "config/config.php";
require_once "lib/Database.php";
require_once "helpers/Helpers.php";
$query = new Database();

?>
<!DOCTYPE html>
<html>

<head>

    <!-- php code for dynamic title start here  -->

    <?php

    if (isset($_GET['pageid'])) {
        $pageIdForDynamicTitle  = $_GET['pageid'];
        $sqlForDynamicTitle     = "SELECT * FROM pages WHERE id=$pageIdForDynamicTitle";
        $queryForDaynamicTitle  = $query->select($sqlForDynamicTitle);
        $dataForTitle           = $queryForDaynamicTitle->fetch_assoc();
        $titleData              = $dataForTitle['title'];
    } elseif (isset($_GET['id'])) {
        $postIdForTitle         = $_GET['id'];
        $postSqlForTitle        = "SELECT * FROM posts WHERE id=$postIdForTitle";
        $postQueryForTitle      = $query->select($postSqlForTitle);
        $postDataForTitle       = $postQueryForTitle->fetch_assoc();
        $titleData              = $postDataForTitle['title'];
    } else {
        $titleData              = Helpers::title();
    }

    ?>
    <title><?= $titleData ?>-<?= TITLE ?></title>

    <!-- php code for dynamic title end here  -->


    <!-- php code for tag start here  -->
    <?php
    if (isset($postDataForTitle)) {

        $postTags = $postDataForTitle['tags'];
    } else {
        $postTags = TAGS;
    }

    ?>

    <!-- php code for tag end here  -->


    <meta name="language" content="English">
    <meta name="description" content="It is a website about education">
    <meta name="keywords" content="<?= $postTags ?>">
    <meta name="author" content="Delowar">
    <link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">
    <link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="style.css">
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/jquery.nivo.slider.js" type="text/javascript"></script>

    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider({
            effect: 'random',
            slices: 10,
            animSpeed: 500,
            pauseTime: 5000,
            startSlide: 0, //Set starting Slide (0 index)
            directionNav: false,
            directionNavHide: false, //Only show on hover
            controlNav: false, //1,2,3...
            controlNavThumbs: false, //Use thumbnails for Control Nav
            pauseOnHover: true, //Stop animation while hovering
            manualAdvance: false, //Force manual transitions
            captionOpacity: 0.8, //Universal caption opacity
            beforeChange: function() {},
            afterChange: function() {},
            slideshowEnd: function() {} //Triggers after all slides have been shown
        });
    });
    </script>
</head>

<body>


    <!-- data from db for title,subttle and logo start here  -->
    <?php
    $titleQuery     = $query->readAll('title');
    $dataForTitle     = $titleQuery->fetch_assoc();
    ?>

    <!-- data from db for title,subttle and logo end here  -->




    <div class="headersection templete clear">
        <a href="#">
            <div class="logo">
                <img src="admin/<?= $dataForTitle['logo'] ?>" alt="Logo" />
                <h2><?= $dataForTitle['title'] ?></h2>
                <p><?= $dataForTitle['sub_title'] ?></p>
            </div>
        </a>
        <div class="social clear">

            <!-- code for socail links start here  -->
            <?php
            $socialQuery    = $query->readAll('social_links');
            $socail_links   = $socialQuery->fetch_assoc();
            ?>
            <!-- code for socail links end here  -->



            <div class="icon clear">
                <a href="<?= $socail_links['facebook'] ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                <a href="<?= $socail_links['github'] ?>" target="_blank"><i class="fa fa-github"></i></a>
                <a href="<?= $socail_links['twitter'] ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                <a href="<?= $socail_links['linkedin'] ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
            </div>
            <div class="searchbtn clear">
                <form action="search.php" method="get">
                    <input type="text" name="search" placeholder="Search keyword..." />
                    <input type="submit" name="submit" value="Search" />
                </form>
            </div>
        </div>
    </div>
    <div class="navsection templete">
        <ul>

            <!-- highlight current page  -->
            <?php

            $path = $_SERVER['SCRIPT_FILENAME'];
            $path_name = basename($path, '.php');

            ?>

            <li><a <?= $path_name == 'index' ? "id='active'" : '' ?> href="index.php">Home</a></li>

            <!-- highlight current dynamic page  -->
            <?php
            if (isset($_GET['pageid'])) {
                $currentPageId = $_GET['pageid'];
            }

            ?>



            <!-- dynamic pages code start here  -->

            <?php
            foreach ($query->readAll('pages') as $dynamicPage) {
            ?>
            <!-- dynamic pages code end here  -->
            <li><a <?php
                        // code for page highlight  
                        if (isset($currentPageId) && $currentPageId == $dynamicPage['id']) {
                            echo "id='active'";
                        }
                        ?> href="page.php?pageid=<?= $dynamicPage['id'] ?>"><?= $dynamicPage['title'] ?></a></li>
            <!-- foreach end bracket  -->
            <?php } ?>
            <li><a <?= $path_name == 'contact' ? "id='active'" : '' ?> href="contact.php">Contact</a></li>
        </ul>
    </div>