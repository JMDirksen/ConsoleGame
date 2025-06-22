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
