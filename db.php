<?php

$user='mysql';
$pass='mysql';
$db="taskforce";

$files = array(
    'categories',
    'cities',
    'users',
    'profiles',
    'user_specialization_category',
    'favourite_users',
    'notifications',
    'tasks',
    'reviews',
    'chats',
    'chat_messages',
    'responses'
);

try {
    $db = new PDO("mysql:host=127.0.0.1;port=3307;dbname=taskforce", $user, $pass);

    $dir = __DIR__ . '/htmlacademy/sql/sql_data/';

    foreach($files as $file){
        $sql = file_get_contents($dir.$file.'.sql');
        $db->exec($sql) or die(print_r($db->errorInfo(), true));
    }

} catch (PDOException $e) {
    die("DB ERROR: ". $e->getMessage());
}