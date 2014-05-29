<?php
$fio = $_POST['fio'];

if (isset ($fio)){
   $fio = substr($fio,0,50); //Не может быть более 50 символов
	if (empty($fio))
	{
		echo "<center><b>Не указана ФИО<p>";
		echo "<a href=\"/cart2\">Вернуться и правильно заполнить форму.</a>";
		exit;
	}
}
else {
 $fio = "не указано";
}

$phone_number = $_POST['phone_number'];
if (isset ($phone_number))
{
	$email = substr($phone_number,0,20); //Не может быть более 20 символов
	if (empty($phone_number))
	{
		echo "<center><b>Не указан телефонный номер <p>";
		echo "<a href=\"/cart2\">Вернуться и правильно заполнить форму.</a>";
		exit;
	}
}
else {
  $phone_number = "не указано";
}


$address = $_POST['address'];
if (isset ($address))
{
$mess = substr($address,0,100); //Не может быть более 100 символов
	if (empty($address))
	{
		echo "<center><b>Не указан адрес<p>";
		echo "<a href=\"/cart2\">Вернуться и правильно заполнить форму.</a>";
		exit;
	}
}
else {
$address = "не указано";
}


$i = "не указано";

if ($fio == $i AND $phone_number == $i AND $address == $i )
{
	echo "Ошибка ! Скрипту не были переданы параметры !";
	exit;	
}

$to = "goldmagnat@mail.ru";  
$subject = "Сообщение с вашего интернет-сайта";
$message = "Имя пославшего:$name::::::::::Электронный адрес:$email::::::::::Сообщение:$mess:::::::::IP-адрес:$REMOTE_ADDR";
mail ($to,$subject,$message) or print "Не могу отправить письмо !!!";
echo "<center><b>Спасибо за доверие, наши специалисты свяжутся с вами в самое ближайшее время
<a href=http://shop.loc>Нажмите</a>, что бы вернуться на главную...>";
exit;
?>