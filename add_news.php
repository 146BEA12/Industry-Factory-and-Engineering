<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить/Удалить новость</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="my-4">Добавить/Удалить новость</h2>
        <div class="row">
            <div class="col-md-6">
                <h3>Добавить новость</h3>
                <form action="add_news.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Заголовок:</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="author">Дата:</label>
                        <input type="text" class="form-control" id="author" name="author" required>
                    </div>
                    <div class="form-group">
                        <label for="content">Содержание:</label>
                        <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Изображение:</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <label for="video_link">Ссылка на видео:</label>
                        <input type="text" class="form-control" id="video_link" name="video_link">
                    </div>
                    <button type="submit" class="btn btn-primary">Добавить новость</button>
                </form>
            </div>
            <div class="col-md-6">
                <h3>Удалить новость</h3>
                <form action="delete_news.php" method="post">
                    <div class="form-group">
                        <label for="delete_news">Выберите новость для удаления:</label>
                        <select class="form-control" id="delete_news" name="delete_news">
                            <option value="">Выберите новость</option>
                            <?php
                            include('db.php');

                            $sql = "SELECT * FROM news";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['title'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-danger">Удалить выбранную новость</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>




<?php
include('db.php');

// Получение данных из формы
$title = isset($_POST['title']) ? $_POST['title'] : '';
$author = isset($_POST['author']) ? $_POST['author'] : '';
$content = isset($_POST['content']) ? $_POST['content'] : '';
$video_link = isset($_POST['video_link']) ? $_POST['video_link'] : '';

// Проверка наличия данных изображения в массиве $_FILES
if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $image = "uploads/" . basename($_FILES["image"]["name"]);
    $target_file = "uploads/" . basename($_FILES["image"]["name"]);
    
    // Попытка загрузки изображения на сервер
    if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // SQL запрос для добавления новости
        $sql = "INSERT INTO news (title, author, content, image, video_link) VALUES ('$title', '$author', '$content', '$image', '$video_link')";

        if ($conn->query($sql) === TRUE) {
            echo "Новость успешно добавлена";
        } else {
            echo "Ошибка: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Ошибка загрузки изображения";
    }
} else {
    echo "Ошибка: Файл изображения не был загружен или произошла ошибка";
}

$conn->close();
?>


