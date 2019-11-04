<?php

$user='olga';
$pass='67cfirf876';
$db="taskforce";

$files = array(
    'categories.sql',
    'cities.sql');
try {
    $db = new PDO("mysql:host=localhost;dbname=taskforce", $user, $pass);

    $dir = __DIR__.'/sql/sql_data/';

    foreach($files as $file){
        $sql = file_get_contents($dir.$file);
        $db->exec($sql) or die(print_r($db->errorInfo(), true));
    }

} catch (PDOException $e) {
    die("DB ERROR: ". $e->getMessage());
}