<!DOCTYPE html>
<html lang="en">

<!-- blog 19:58:47 GMT -->
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="themexriver">

    <!-- Page Title -->
    <title> Industrial - Industry, Factory and Engineering Template </title>

    <!-- Favicon and Touch Icons -->
    <link href="assets/images/favicon/favicon.png" rel="shortcut icon" type="image/png">
    <link href="assets/images/favicon/apple-touch-icon-57x57.png" rel="apple-touch-icon" sizes="57x57">
    <link href="assets/images/favicon/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
    <link href="assets/images/favicon/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
    <link href="assets/images/favicon/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">

    <!-- Icon fonts -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/flaticon.css" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    

    <!-- Plugins for this template -->
    <link href="assets/css/animate.css" rel="stylesheet">
    <link href="assets/css/owl.carousel.css" rel="stylesheet">
    <link href="assets/css/owl.theme.css" rel="stylesheet">
    <link href="assets/css/slick.css" rel="stylesheet">
    <link href="assets/css/slick-theme.css" rel="stylesheet">
    <link href="assets/css/owl.transitions.css" rel="stylesheet">
    <link href="assets/css/jquery.fancybox.css" rel="stylesheet">
    <link href="assets/css/jquery.mCustomScrollbar.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .news-description {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .card {
            height: 100%;
        }

        .card-img-top {
            object-fit: cover;
            height: 250px; /* Выберите высоту, которая вам подходит */
        }
        .modal-dialog {
            margin-top: 70px;
        }
        .modal-title {
            font-size:large;
        }
        .card-title {
            font-size: 10 px;
        }
        .custom-video-style {
            height: 180px;
            width: 100%; /* Пример: установка ширины видео на 75% */
        }
        .custom-video-style1 {
            width: 100%; /* Пример: установка ширины видео на 75% */
        }
        .custom-image-style {
            
            height: 200px;
            width: auto;
        }
        .grid {
            height: 350px;
        }

        .entry-media {
            width: auto;
            height: 350px;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
        }
        .entry-details {
            margin-top: 20px;
            text-align: left;
        }
    </style>
</head>

<body>

    <!-- start page-wrapper -->
    <div class="page-wrapper">

        <!-- start preloader -->
        <div class="preloader">
            <div class="preloader-inner">
                <img src="assets/images/preloader.gif" alt>
            </div>
        </div>
        <!-- end preloader -->


        <!-- Start header -->
        <?php
            include 'header.php';
        ?>
        <!-- end of header -->
        <!-- start page-title -->
        <section class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col col-xs-12">
                        <h2>News</h2>
                        <ol class="breadcrumb">
                            <li><a href="index.php">Home</a></li>
                            <li>News</li>
                        </ol>
                    </div>
                </div> <!-- end row -->
            </div> <!-- end container -->
        </section>        
        <!-- end page-title -->


        <!-- start blog-grid-section -->
        <section class="blog-grid-section section-padding">
            <div class="container">
                <div class="news-grids">
                <?php
                    include('db.php');

                    $sql = "SELECT * FROM news ORDER BY created_at DESC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                ?>
                    <div class="grid">
                        <div class="entry-media">
                            <?php if (!empty($row['video_link'])): ?>
                                <video controls class="custom-video-style">
                                    <source src="<?php echo $row['video_link']; ?>" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            <?php else: ?>
                                <img src="<?php echo $row['image']; ?>" class="custom-image-style"  role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                            <?php endif; ?>
                            
                            <div class="entry-details">
                            <a href="#" data-toggle="modal" data-target="#newsModal<?php echo $row['id']; ?>">
                                <h5 class="card-title">
                                    <p class="" style="color: black;" ><?php echo $row['title']; ?></p>
                                </h5>
                                <h6 class="entry-meta"><?php echo $row['author']; ?></h6>
                                <p class="card-text news-description"><?php echo $row['content']; ?></p>
                                </a>
                            </div>
                            </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="newsModal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="newsModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="newsModalLabel"><?php echo $row['title']; ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <?php if (!empty($row['video_link'])): ?>
                                        <video controls class="custom-video-style1">
                                            <source src="<?php echo $row['video_link']; ?>" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    <?php endif; ?>
                                    <img src="<?php echo $row['image']; ?>" class="img-fluid mb-2" alt="News Image">
                                    <p><?php echo $row['content']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    } else {
                        echo "<p>Новостей нет.</p>";
                    }
                    $conn->close();
                    ?>
                </div> <!-- end news-grids -->
            </div> <!-- end container -->
        </section>
        <!-- end blog-grid-section     -->
        
        <!-- end site-footer -->
    </div>
    <!-- end of page-wrapper -->
    <?php include 'footer.php';?>


    <!-- All JavaScript files
    ================================================== -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Plugins for this template -->
    <script src="assets/js/jquery-plugin-collection.js"></script>
    <script src="assets/js/jquery.mCustomScrollbar.js"></script>

    <!-- Custom script for this template -->
    <script src="assets/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

<!-- blog 19:58:47 GMT -->
</html>
