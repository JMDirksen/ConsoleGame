<?php
require('init.php');

// Get command
$command = htmlspecialchars($_POST['command']);
$split = explode(" ", $command);
$cmd = $split[0];
$args = array_slice($split, 1);

// Initalize display
$display = new Display();
if (!isset($_SESSION['input_password'])) {
    $display->write($command, true);
}

// Input password
if (isset($_SESSION['input_password'])) {
    $type = $_SESSION['input_password'];
    $password = $cmd;
    $display->write("Password: " . str_repeat("*", 8));

    // Register
    if ($type == "register") {
        $register = new Register($display);
        $register->password($password);
    }

    // Login
    elseif ($type == "login") {
        $login = new Login($display);
        $login->password($password);
    }

    unset($_SESSION['input_password']);
}

// help
if ($cmd == "help") {
    $help = new Help($display);
    $help->run($args);
}

// clear
if ($cmd == "clear") {
    $clear = new Clear($display);
    $clear->run();
}

// register
if ($cmd == "register") {
    $register = new Register($display);
    $register->run($args);
}

// login
if ($cmd == "login") {
    $login = new Login($display);
    $login->run($args);
}

// version
if ($cmd == "version") {
    $version = new Version($display);
    $version->run();
}

header('Location: /');
