<?php
$host = 'localhost';
$user = 'mysql';
$password = 'mysql';
$db_name = 'test';
$connections = mysqli_connect($host, $user, $password, $db_name) or die(mysqli_error($connections));
mysqli_query($connections, "SET NAMES 'utf8'");
if(isset($_GET['del'])) {
    $del = (int)$_GET['del'];
    $query = "DELETE FROM workers WHERE id=$del";
    $result = mysqli_query($connections, $query) or die(mysqli_error($connections));
    if (!$result) {
        die("Database query failed");
    }
}
header("Location:index.php");
exit;
