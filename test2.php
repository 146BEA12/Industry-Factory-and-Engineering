<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новости</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
            height: 225px; /* Выберите высоту, которая вам подходит */
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
    </style>
</head>
<body>
    <div class="container">
        <h2 class="my-4">Последние новости</h2>
        <div class="row">
            <?php
                include('db.php');

                $sql = "SELECT * FROM news ORDER BY created_at DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <?php if (!empty($row['video_link'])): ?>
                                <video controls class="card-img-top">
                                    <source src="<?php echo $row['video_link']; ?>" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            <?php else: ?>
                                <img src="<?php echo $row['image']; ?>" class="bd-placeholder-img card-img-top" width="100%" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="#" class="news-title" data-toggle="modal" data-target="#newsModal<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a>
                                </h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo $row['author']; ?></h6>
                                <p class="card-text news-description"><?php echo $row['content']; ?></p>
                                <?php if (str_word_count($row['content']) > 30): ?>
                                    <a href="#" class="btn btn-link toggle-description">Показать полностью</a>
                                <?php endif; ?>
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
                                        <video controls class="img-fluid mb-2">
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
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
