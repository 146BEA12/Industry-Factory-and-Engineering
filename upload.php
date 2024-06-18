<?php
$target_dir = "uploads/"; // Директория для загруженных видео
$target_file = $target_dir . basename($_FILES["video"]["name"]);
$uploadOk = 1;
$videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Проверка является ли файл видео
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["video"]["tmp_name"]);
    if($check !== false) {
        echo "File is a video - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not a video.";
        $uploadOk = 0;
    }
}

// Проверка размера файла (не более 100MB)
if ($_FILES["video"]["size"] > 100000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Разрешенные форматы файлов (можно добавить другие форматы)
if($videoFileType != "mp4" && $videoFileType != "avi" && $videoFileType != "mov"
&& $videoFileType != "mpeg" ) {
    echo "Sorry, only MP4, AVI, MOV, MPEG files are allowed.";
    $uploadOk = 0;
}

// Проверка на наличие ошибок при загрузке файла
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// Если все в порядке, то загрузить файл
} else {
    if (move_uploaded_file($_FILES["video"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["video"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
