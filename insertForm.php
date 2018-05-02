<?php
// 1. Создали подключение
$host = 'localhost';
$user = 'mysql';
$password = 'mysql';
$db_name = 'test';
$connections = mysqli_connect($host, $user, $password, $db_name) or die(mysqli_error($connections));
mysqli_query($connections, "SET NAMES 'utf8'");
?>
    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>Добавление сотрудника</title>
        <!--<link href="style.css" rel="stylesheet">-->
    </head>
    <body>
    <form action="" method="get">
        <input name="name" placeholder="Имя"><br><br>
        <input name="age" placeholder="Возраст"><br><br>
        <input name="salary" placeholder="Зарплата"><br><br>
        <input name="submit" type="submit" value="Вставить запись">
    </form>
    <form action="index.php" method="get">
        <input name="submit2" type="submit" value="вернутся в базу">
    </form>
    </body>
<?php
// 2. Обработка данных из формы
if ((!empty($_REQUEST['name'])) and
    !empty($_REQUEST['age']) and
    !empty($_REQUEST['salary']))
{
    $name = ($_REQUEST['name']);
    $age = strip_tags($_REQUEST['age']);
    $salary = strip_tags($_REQUEST['salary']);

    $name = mysqli_real_escape_string($connections, $name);
//3. Запрос на добавление
    $query = "INSERT INTO workers SET name='$name', age=$age , salary=$salary ,del='', upd='' ";
    $result = mysqli_query($connections, $query) or die(mysqli_error($connections));
// проверка была ли ошибка запроса к базе
    if (!$result) {
        die("Database query failed");
    }
}

?>
