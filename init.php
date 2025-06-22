<?php

session_start();
define("PROMPT", "CON>");
define("DISPLAY_LINES", 32);

$db = new SQLite3("consolegame.db");
$db->exec('DROP TABLE IF EXISTS users');
$db->exec('CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY AUTOINCREMENT, email TEXT, code TEXT)');
$db->exec('INSERT INTO users (email) VALUES ("test@test.com")');
$results = $db->query('SELECT * FROM users');
echo "<pre>";
while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    var_dump($row);
}
echo "</pre>";
