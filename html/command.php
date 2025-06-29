<?php
require('init.php');

// Get command
$command = htmlspecialchars($_POST['command']);
$split = explode(" ", $command);
$cmd = $split[0];
$args = array_slice($split, 1);

// Show command on display
if (!isset($_SESSION['input_password'])) {
    DP->write($command, true);
}

// Input password
if (isset($_SESSION['input_password'])) {
    $type = $_SESSION['input_password'];
    $password = $cmd;
    DP->write("Password: " . str_repeat("*", 8));

    // Register
    if ($type == "register") {
        $register = new Register();
        $register->password($password);
    }

    // Login
    elseif ($type == "login") {
        $login = new Login();
        $login->password($password);
    }

    unset($_SESSION['input_password']);
}

// help
if ($cmd == "help") {
    $help = new Help();
    $help->run($args);
}

// clear
if ($cmd == "clear") {
    $clear = new Clear();
    $clear->run();
}

// register
if ($cmd == "register") {
    $register = new Register();
    $register->run($args);
}

// login
if ($cmd == "login") {
    $login = new Login();
    $login->run($args);
}

// version
if ($cmd == "version") {
    $version = new Version();
    $version->run();
}

header('Location: /');
