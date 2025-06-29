<?php
require('init.php');
echo "<pre>";

print(PHP_EOL . "Session" . PHP_EOL);
var_dump($_SESSION);

print(PHP_EOL . "Users" . PHP_EOL);
$results = DB->query('SELECT * FROM user');
while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    var_dump($row);
}

echo "</pre>";
