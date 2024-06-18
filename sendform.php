<?php
$name = trim($_POST['name']);
$phone = trim($_POST['phone']);
$email = trim($_POST['email']);
$fromMail = 'info@site.ru'; //Почта отправителя (в домене почты должен быть адрес вашего сайта)
$fromName = 'Поступила заявка с сайта'; //Заголовок письма
$emailTo = 'info@marines.kz'; //Ваша почта
$subject = 'Форма обратной связи marines.kz';
$subject = '=?utf-8?b?'. base64_encode($subject) .'?=';
$headers = "Content-type: text/plain; charset=\"utf-8\"\r\n";
$headers .= "From: ". $fromName ." <". $fromMail ."> \r\n";
// Содержимое письма
$body = "Получено письмо с сайта \n Имя: $name\nТелефон: $phone\Почта: $email";
// сообщение будет отправлено в случае, если поле с номером телефона не пустое
if (strlen($phone) > 0) {
$mail = mail($emailTo, $subject, $body, $headers, '-f'. $fromMail );
}
?>