<?php require_once("../includes/initialize.php"); ?>
<?php

    // 1. the current page number ($current_page)
    $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

    // 2. records per page ($per_page)
    $per_page = 9;

    // 3. total record count ($total_count)
    $total_count = Photograph::count_all();


    // Find all photos
    // use pagination instead
    //$photos = Photograph::find_all();

    $pagination = new Pagination($page, $per_page, $total_count);

    // Instead of finding all records, just find the records
    // for this page
    $sql = "SELECT * FROM photographs ";
    $sql .= "ORDER BY id DESC ";
    $sql .= "LIMIT {$per_page} ";
    $sql .= "OFFSET {$pagination->offset()}";

    $photos = Photograph::find_by_sql($sql);

    //echo count($photos);
    // Need to add ?page=$page to all links we want to
    // maintain the current page (or store $page in $session)

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
        <link rel="stylesheet" type="text/css" href="vendors/css/normalize.css">
        <link rel="stylesheet" type="text/css" href="vendors/css/grid.css">
        <link rel="stylesheet" type="text/css" href="vendors/css/ionicons.min.css">
        <link rel="stylesheet" type="text/css" href="vendors/css/ihover.css">
        <link rel="stylesheet" type="text/css" href="vendors/css/animate.css">
        <link rel="stylesheet" type="text/css" href="resources/css/style.css">
        <link rel="stylesheet" type="text/css" href="resources/css/queries.css">
        <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,300italic' rel='stylesheet' type='text/css'>
        <title>GaoHouse</title>

        <link rel="apple-touch-icon" sizes="180x180" href="/resources/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" href="/resources/favicons/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="/resources/favicons/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="/resources/favicons/manifest.json">
        <link rel="mask-icon" href="/resources/favicons/safari-pinned-tab.svg">
        <link rel="shortcut icon" href="/resources/favicons/favicon.ico">
        <meta name="msapplication-config" content="/resources/favicons/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">
    </head>
    <body>
        <header class="section-header-product">
            <nav>
                <div class="row">
                    <a href="index.html">
                        <img src="resources/img/gao-logo.png" alt="Omnifood logo" class="logo">
                        <img src="resources/img/gao-logo.png" alt="Omnifood logo" class="logo-black">
                    </a>
                    <ul class="main-nav js--main-nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.html">About us</a></li>
                        <li><a href="Menus.html">Our menu</a></li>
                        <li><a href="#cities">Contact us</a></li>
                        <li><a href="products.php">Our gallery</a></li>
                    </ul>
                    <a class="mobile-nav-icon js--nav-icon"><i class="ion-navicon-round"></i></a>
                </div>
            </nav>
            <div class="hero-text-box">
                <h1>Hello from our kitchen.</h1>
                <a class="btn btn-ghost js--scroll-to-start" href="#">Show me more</a>
            </div>

        </header>

        <section class="wrapper js--section-features" id="features">
            <div class="row">
                <h2>Menus</h2>
            </div>
            <?php
                $result = "";
                $tmp = "<div class=\"row js--wp-3\">";
                for ($i = 0; $i < count($photos); $i++){
                    $tmp .= display_img($photos[$i]);
                    if ($i % 3 == 2){
                        $tmp .= "</div>";
                        $result .= $tmp;
                        $tmp = "<div class=\"row js--wp-3\">";
                    }
                }
                //echo $i;
                if ($i % 3 != 0){
                        $tmp .= "</div>";
                        $result .= $tmp;
                        $tmp = "";
                }
                echo $result;

                // for ($i = 0; $i < count($photos); $i++){
                //     echo get_class($photos[$i]);
                // }
                // echo 'test <hr>';
                // echo display_img($photos[0]);


            ?>
         <!-- img insert done here -->
        <div class="row btn-box">
            <?php
                if($pagination->has_previous_page()){
                  echo "<a href=\"products.php?page=";
                  echo $pagination->previous_page();
                  echo "\"><i class=\"ion-ios-arrow-left previous-btn\"></i></a>";
                } else {
                  echo "<a class=\"disabled\" href=\"products.php?page=";
                  echo $pagination->previous_page();
                  echo "\"><i class=\"ion-ios-arrow-left previous-btn\"></i></a>";
                }

                if($pagination->has_next_page()){
                  echo "<a href=\"products.php?page=";
                  echo $pagination->next_page();
                  echo "\"><i class=\"ion-ios-arrow-right next-btn\"></i></a>";
                } else {
                  echo "<a class=\"disabled\"  href=\"products.php?page=";
                  echo $pagination->next_page();
                  echo "\"><i class=\"ion-ios-arrow-right next-btn\"></i></a>";
                }



            // <a href="#"><i class="ion-arrow-left-b previous-btn"></i></a>
            // <a href="#"><i class="ion-arrow-right-b next-btn"></i></a>
            ?>
            </div>

        </section>
        <footer>
            <div class="row">
                <div class="arrow-up"></div>
            </div>
            <div class="row">
                <div class="col span-1-of-2">
                    <ul class="footer-nav">
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Menus</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Location</a></li>
                    </ul>
                </div>
                <div class="col span-1-of-2">
                    <ul class="social-links">
                        <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                        <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                        <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                        <li><a href="#"><i class="ion-social-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <p>
                    This webpage is for Bunny Team!.
                </p>
                <p>
                    Build with <i class="ion-ios-heart" style="color: #ea0000; padding: 0 3px;"></i> in the beautiful city of HCMC, Vietnam, December 2016.
                </p>
            </div>
        </footer>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/respond/1.4.2/respond.min.js"></script>
    <script src="//cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.jsdelivr.net/selectivizr/1.0.3b/selectivizr.min.js"></script>
    <script src="vendors/js/jquery.waypoints.min.js"></script>
    <script src="resources/js/script.js"></script>
    </body>

</html>
