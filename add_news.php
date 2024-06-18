<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить/Удалить новость</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div id="notification" style="display: none;" class="alert alert-success" role="alert">
    Новость успешно добавлена!
</div>

    <div class="container">
        <h2 class="my-4">Добавить/Удалить новость</h2>
        <div class="row">
            <div class="col-md-6">
                <h3>Добавить новость</h3>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
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
                        <label for="video">Видео:</label>
                        <input type="file" class="form-control-file" id="video" name="video">
                    </div>
                    <button type="submit" name="add_news_submit" class="btn btn-primary">Добавить новость</button>
                </form>
            </div>
            <div class="col-md-6">
                <h3>Удалить новость</h3>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
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
                    <button type="submit" name="delete_news_submit" class="btn btn-danger">Удалить выбранную новость</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<script>
document.addEventListener('DOMContentLoaded', function() {
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_news_submit'])) { ?>
        document.getElementById('notification').style.display = 'block';
        setTimeout(function() {
            window.location.href = window.location.href;
        }, 8000);
    <?php } ?>
});
</script>
<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверяем, была ли отправлена форма добавления новости
    if (isset($_POST['add_news_submit'])) {
        // Получение данных из формы
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $author = isset($_POST['author']) ? $_POST['author'] : '';
        $content = isset($_POST['content']) ? $_POST['content'] : '';

        // Проверка наличия данных изображения в массиве $_FILES
        if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = "uploads/" . basename($_FILES["image"]["name"]);
            $target_file = "uploads/" . basename($_FILES["image"]["name"]);
            
            // Попытка загрузки изображения на сервер
            if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Проверка наличия данных видео в массиве $_FILES
                if(isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
                    $video_link = "uploads/" . basename($_FILES["video"]["name"]);
                    $video_target_file = "uploads/" . basename($_FILES["video"]["name"]);
                    
                    // Попытка загрузки видео на сервер
                    if(move_uploaded_file($_FILES["video"]["tmp_name"], $video_target_file)) {
                        // SQL запрос для добавления новости с изображением и видео
                        $sql = "INSERT INTO news (title, author, content, image, video_link) VALUES ('$title', '$author', '$content', '$image', '$video_link')";
                    } else {
                        echo "Ошибка загрузки видео";
                    }
                } else {
                    // SQL запрос для добавления новости только с изображением
                    $sql = "INSERT INTO news (title, author, content, image) VALUES ('$title', '$author', '$content', '$image')";
                }

                // Выполнение SQL запроса
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Новость успешно добавлена!');</script>";
                    echo "<script>window.setTimeout(function(){ window.location.href = window.location.href; }, 2000);</script>";
                } else {
                    echo "Ошибка: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Ошибка загрузки изображения";
            }
        } else {
            echo "Ошибка: Файл изображения не был загружен или произошла ошибка";
        }
    }

    // Проверяем, была ли отправлена форма удаления новости
    if (isset($_POST['delete_news'])) {
        $news_id = $_POST['delete_news'];

        // Подготавливаем SQL запрос
        $sql = "DELETE FROM news WHERE id = ?";
        
        // Создаем подготовленное выражение
        $stmt = $conn->prepare($sql);

        // Привязываем параметры
        $stmt->bind_param("i", $news_id);

        // Выполняем запрос
        if ($stmt->execute() === TRUE) {
            echo "<script>alert('Новость успешно удалена!');</script>";
            echo "<script>window.setTimeout(function(){ window.location.href = window.location.href; }, 1000);</script>";
        } else {
            echo "Ошибка при удалении новости: " . $conn->error;
        }

        // Закрываем подготовленное выражение
        $stmt->close();
    }
}

$conn->close();
?>

