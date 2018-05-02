<?php
// 1. Создали подключение
$host = 'localhost';
$user = 'mysql';
$password = 'mysql';
$db_name = 'test';
$connections = mysqli_connect($host, $user, $password, $db_name) or die(mysqli_error($link));
mysqli_query($connections, "SET NAMES 'utf8'");
//
if (!empty($_REQUEST['selectInput'])) {
    $salary = strip_tags($_REQUEST['selectInput']);
// 2. Запросы к базе
    $query = "SELECT * ";
    $query .= "FROM workers ";
    $query .= "WHERE salary = $salary ";
//$query .= "ORDER BY name ASC ";

    $result = mysqli_query($connections, $query) or die(mysqli_error($connections));
} else {
    $query = "SELECT * ";
    $query .= "FROM workers ";
    $result = mysqli_query($connections, $query) or die(mysqli_error($connections));
}
// проверка была ли ошибка запроса к базе
if (!$result) { die("Database query failed");}
?>

    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>Базы</title>
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
    <?php
    // 3. Использование данных
    // Выводим шапку таблицы
    echo "<table>";
    echo "<tr><td>ID</td><td>Name</td><td>Age</td><td>Salary</td><td>Удалить</td><td>Редактировать</td></tr>";
    echo "<tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        // выводим данные из каждого ряда
        echo "<td>$row[id]</td>";
        echo "<td>$row[name]</td>";
        echo "<td>$row[age]</td>";
        echo "<td>$row[salary]</td>";
        echo "<td><a name='del' href=\"del2.php?del=$row[id]\">Удалить</a></td>";
        echo "<td><a name='upd' href=\"updateForm.php?upd=$row[id]\">Редактировать</a></td></tr>";
    }
    ?>
    <form action="insertForm.php" method="get">
    <input  name="insertData" type="submit" value="Добавить сотрудника">
    </form>
    <?php
    // 4. Освобождаем полученные данные
    mysqli_free_result($result);
    ?>
    <form name="selectForm" method="get">
        <input name="selectInput" type="text" placeholder="Отбор по зарплате">
        <input name="selectBottom" type="submit" value="Найти">
    </form>
    </body>
    </html>
<?php
// 5. Закрываем соединение с базой
mysqli_close($connections);
?>