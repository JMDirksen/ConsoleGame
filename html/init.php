<?php

// Autoloader
spl_autoload_register(function ($class_name) {
    include $class_name . ".php";
});

// Start session
session_start();

// Global variables
define("VER", "v0.1");

// Database setup
define("DB", new SQLite3("../consolegame.db"));
DB->exec('CREATE TABLE IF NOT EXISTS user (id INTEGER PRIMARY KEY AUTOINCREMENT, username TEXT, password TEXT)');
