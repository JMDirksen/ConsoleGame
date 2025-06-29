<?php
require('init.php');
echo "<pre>";

echo "[Session]" . PHP_EOL . PHP_EOL;
foreach ($_SESSION as $key => $value) {
    echo $key . " = " . var_export($value, true) . PHP_EOL;
}

echo PHP_EOL . PHP_EOL . "[Settings]" . PHP_EOL . PHP_EOL;
$results = DB->query('SELECT * FROM setting');
while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    echo $row['name'] . " = " . $row['value'] . PHP_EOL;
}

echo PHP_EOL . PHP_EOL . "[Users]" . PHP_EOL . PHP_EOL;
$results = DB->query('SELECT id, username FROM user');
while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    echo $row['id'] . ": " . $row['username'] . PHP_EOL;
}

echo "</pre>";
