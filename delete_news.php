<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_news'])) {
    $news_id = $_POST['delete_news'];

    // Подготавливаем SQL запрос
    $sql = "DELETE FROM news WHERE id = ?";
    
    // Создаем подготовленное выражение
    $stmt = $conn->prepare($sql);

    // Привязываем параметры
    $stmt->bind_param("i", $news_id);

    // Выполняем запрос
    if ($stmt->execute() === TRUE) {
        echo "Новость успешно удалена!";
    } else {
        echo "Ошибка при удалении новости: " . $conn->error;
    }

    // Закрываем подготовленное выражение
    $stmt->close();
}

$conn->close();
?>
