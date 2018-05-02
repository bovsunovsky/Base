<?php
$host = 'localhost';
$user = 'mysql';
$password = 'mysql';
$db_name = 'test';
$connections = mysqli_connect($host, $user, $password, $db_name) or die(mysqli_error($connections));
mysqli_query($connections, "SET NAMES 'utf8'");
if ((!empty($_REQUEST['name'])) and
    !empty($_REQUEST['age']) and
    !empty($_REQUEST['salary'])) {
    $names = ($_REQUEST['name']);
    $age = strip_tags($_REQUEST['age']);
    $salary = strip_tags($_REQUEST['salary']);
    $name = mysqli_real_escape_string($connections, $names);
    if (isset($_REQUEST['upd'])) {
        if (!empty($_REQUEST)) {
            $upd = $_REQUEST['upd'];
        }
        $query = "UPDATE workers SET name='$name', age=$age , salary=$salary  WHERE id=$upd ";
        $result = mysqli_query($connections, $query) or die(mysqli_error($connections));
        if (!$result) {
            die("Database query failed");
        }
    }
    header("Location:index.php");
    exit;
}
?>
 <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="utf-8">
        <title>Обновление информации о сотруднике</title>
        <!--<link href="style.css" rel="stylesheet">-->
    </head>
    <body>
<form>
    <input name="name" placeholder="Имя"><br><br>
    <input name="age" placeholder="Возраст"><br><br>
    <input name="salary" placeholder="Зарплата"><br><br>
    <input name="submit" type="submit" value="Обновить">
</form>
</body>
