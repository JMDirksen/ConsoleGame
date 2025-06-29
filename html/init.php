<?php

// Autoloader
spl_autoload_register(function ($class_name) {
    include $class_name . ".php";
});

// Start session
session_start();

// Global variables
define("VER", "v0.1");
define("DP", new Display());
define("DB", new SQLite3("../consolegame.db"));

// Database setup
DB->exec('CREATE TABLE IF NOT EXISTS setting (name TEXT PRIMARY KEY, value TEXT)');
DB->exec('INSERT OR IGNORE INTO setting (name, value) VALUES ("db_version", "1")');
DB->exec('CREATE TABLE IF NOT EXISTS user (id INTEGER PRIMARY KEY AUTOINCREMENT, username TEXT, password TEXT)');
