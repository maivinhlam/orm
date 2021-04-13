<?php 
require __DIR__ . '/vendor/autoload.php';

use App\Models\Database;

$dbType = 'mysql';
$dbHost = 'mysql57';
$dbUser = 'root';
$dbPass = 'rootpassword';
$dbName = 'mvl';

$db = new Database($dbType, $dbHost, $dbUser, $dbPass, $dbName);
$sql = 'select * from users LIMIT 5';
echo "<br>";
echo $db->CountNumRowsSQL($sql);
