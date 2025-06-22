<?php

// Start session
session_start();

// Global variables
define("PROMPT", "CON>");
define("DISPLAY_LINES", 32);
define("VER", "v0.0.1");

// Database setup
$db = new SQLite3("../consolegame.db");
$db->exec('CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY AUTOINCREMENT, email TEXT, code TEXT)');
