<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новости</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
                            <img src="<?php echo $row['image']; ?>" class="bd-placeholder-img card-img-top" width="100%" height="225" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['title']; ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo $row['author']; ?></h6>
                                <p class="card-text"><?php echo $row['content']; ?></p>
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
</body>
</html>
