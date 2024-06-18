
<?php
// Подключение к базе данных
include 'db.php';

// Получаем значение смещения из POST-запроса
$offset = isset($_POST['offset']) ? $_POST['offset'] : 0;

// Запрос на выборку следующих 6 элементов из базы данных, начиная с заданного смещения
$sql = "SELECT * FROM services LIMIT 6 OFFSET $offset";
$result = $conn->query($sql);

// Проверяем, есть ли данные
if ($result->num_rows > 0) {
    // Выводим каждый элемент
    while ($row = $result->fetch_assoc()) {
        // HTML-код для отображения элемента
        echo '
        <div class="grid">
           <div class="inner mk-bg-img">
                <div class="details ">
                   <div class="info">
                        <img src="assets/images/services/'.$row['image'].'" alt class="bg-image">
                        <a href="service-single.html">
                            <h3><i class="fi flaticon-construction"></i> '.$row['title'].'</h3>
                        </a>
                        <p>'.$row['description'].'</p>
                        <a href="service-single.html" class="more">Get Details</a>
                   </div>
                </div>
           </div>
        </div>';
    }
} else {
    // Если нет данных, выводим сообщение
    echo "No more items to load.";
}

// Закрываем соединение с базой данных
$conn->close();
?>






