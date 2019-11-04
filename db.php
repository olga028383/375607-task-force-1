<?

$user='olga';
$pass='67cfirf876';
$db="taskforce";

try {
    $dbh = new PDO("mysql:host=localhost", $user, $pass);
    var_dump(111);
} catch (PDOException $e) {
    die("DB ERROR: ". $e->getMessage());
}