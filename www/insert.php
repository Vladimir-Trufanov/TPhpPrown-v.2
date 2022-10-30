<?php

//$temp = $_GET['temp'];                                                 // Создание переменной Температура из URL страницы
//$hum = $_GET['hum'];   

if (IsSet($_GET['temp'])) $temp = $_GET['temp'];
else $temp = -1;                                           

if (IsSet($_GET['hum'])) $hum = $_GET['hum'];
else $hum = -3;                                           


 // Создание переменной ВЛАЖНОСТЬ из URL страницы


/*
$conn = new mysqli("192.168.1.195", "arduino", "arduino", "arduino");   // Хостинг, пароль, логин, база
if ($conn->connect_error) {
die("Ошибка: не удается подключиться: " . $conn->connect_error);        // При невозможности подключения к базе
}
*/
echo 'Подключение к базе данных *** Успешно ***<br>';                  // Успешное подключение к базе
echo '$temp='.$temp.'<br>';
echo '$hum='.$hum.'<br>';


//$sql = "INSERT INTO dht22 (temp_dht22,hum_dht22) VALUES($temp,$hum)";   // Вставка значений в таблицу
//$result = mysqli_query($conn, $sql);

?>
<!-- <meta http-equiv="Refresh" content="1; URL=\index.php"> -->                 <!-- Переход на главную страницу  -->
