<?php
require('init.php');

// Get command
$command = htmlspecialchars($_POST['command']);
$split = explode(" ", $command);
$cmd = $split[0];
$args = array_slice($split, 1);

// Initalize display
$display = $_SESSION['display'] ?? [];
$display[] = PROMPT . " " . $command;

// ?
if ($cmd == "?") {
    if (!count($args)) {
        $display[] = "Available commands: ? cls login register ver";
        $display[] = "Use '? <command>' for more info";
    } elseif ($args[0] == "?") {
        $display[] = "Show available commands";
    } elseif ($args[0] == "cls") {
        $display[] = "Clear the screen";
    } elseif ($args[0] == "login") {
        $display[] = "Login user with email address";
        $display[] = "Usage: login <emailaddress>";
    } elseif ($args[0] == "register") {
        $display[] = "Register new user with email address";
        $display[] = "Usage: register <emailaddress>";
    } elseif ($args[0] == "ver") {
        $display[] = "Show Console Game version";
    }
}

// cls
if ($cmd == "cls") {
    $display = [];
}

// register
if ($cmd == "register") {
    if (filter_var($args[0], FILTER_VALIDATE_EMAIL)) {
        $stmt = $db->prepare('INSERT INTO users (email, code) VALUES (:email, :code)');
        $stmt->bindValue(':email', $args[0], SQLITE3_TEXT);
        $stmt->bindValue(':code', rand(100000, 999999), SQLITE3_INTEGER);
        $stmt->execute();
        $_SESSION['email'] = $args[0];
        $display[] = "User registered";
    } else {
        $display[] = "Usage: register <email>";
    }
}

// login
if ($cmd == "login") {
    if (filter_var($args[0], FILTER_VALIDATE_EMAIL)) {
        $stmt = $db->prepare('INSERT INTO users (email, code) VALUES (:email, :code)');
        $stmt->bindValue(':email', $args[0], SQLITE3_TEXT);
        $stmt->bindValue(':code', rand(100000, 999999), SQLITE3_INTEGER);
        $stmt->execute();
        $display[] = "User registered";
    } elseif (is_numeric($args[0]) && $args[0] > 100000 && $args[0] < 999999) {
        $stmt = $db->prepare('SELECT * FROM users WHERE email=:email AND code=:code');
        $stmt->bindValue(':email', $_SESSION['email'] ?? "", SQLITE3_TEXT);
        $stmt->bindValue(':code', $args[0], SQLITE3_INTEGER);
        $results = $stmt->execute();
        $row = $results->fetchArray(SQLITE3_ASSOC);
        if ($row) {
            $_SESSION['user_id'] = $row['id'];
            $display[] = "Login successful";
        } else {
            $display[] = "Login failed";
        }
    } else {
        $display[] = "Usage: login <email>";
        $display[] = "Usage: login <code>";
    }
}

// ver
if ($cmd == "ver") {
    $display[] = "Console Game version " . VER;
}

// Limit display lines
$lineCount = count($display);
if ($lineCount > DISPLAY_LINES) {
    array_splice($display, 0, $lineCount - DISPLAY_LINES);
}

// Output
$_SESSION['display'] = $display;
header('Location: /');
