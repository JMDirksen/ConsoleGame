<?php
require('init.php');

// Get command
$command = htmlspecialchars($_POST['command']);
$split = explode(" ", $command);
$cmd = $split[0];
$args = array_slice($split, 1);

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

// Input command
else {
    DP->write($command, true);
    $commands = new Commands();
    $obj = $commands->get_object($cmd);
    if ($obj) {
        $obj->run($args);
    } else {
        DP->write("Unknown command '$cmd'");
        DP->write("Use 'help' for commands");
    }
}

header('Location: /');
