<?php
require('init.php');

// Get command
$command = htmlspecialchars($_POST['command']);
$split = explode(" ", $command);
$cmd = $split[0];
$args = array_slice($split, 1);

// Initalize display
$display = $_SESSION['display'] ?? [];
if (!isset($_SESSION['input_password'])) {
    $display[] = PROMPT . " " . $command;
}

// Input password
if (isset($_SESSION['input_password'])) {
    $type = $_SESSION['input_password'];
    $password = $cmd;
    $display[] = "Password: " . str_repeat("*", 8);

    // Register
    if ($type == "register") {
        // Check if username is set
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            // Check password constraints
            if (strlen($password) >= 3 && strlen($password) <= 50) {
                // Store account
                $stmt = $db->prepare('INSERT INTO user (username, password) VALUES (:username, :password)');
                $stmt->bindValue(':username', $username);
                $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
                $stmt->execute();
                // Login
                $stmt = $db->prepare('SELECT id FROM user WHERE username=:username');
                $stmt->bindValue(':username', $username);
                $result = $stmt->execute();
                $row = $result->fetchArray(SQLITE3_ASSOC);
                $_SESSION['userid'] = $row['id'];
                $display[] = "User registered and logged in";
            } else {
                $display[] = "Password must be between 3 and 50 characters in length";
            }
        } else {
            $display[] = "No username";
        }
    }

    // Login
    elseif ($type == "login") {
        // Check if username is set
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $stmt = $db->prepare('SELECT * FROM user WHERE LOWER(username)=LOWER(:username)');
            $stmt->bindValue(':username', $username);
            $result = $stmt->execute();
            $row = $result->fetchArray(SQLITE3_ASSOC);
            // Validate login
            if ($row && password_verify($password, $row['password'])) {
                $_SESSION['userid'] = $row['id'];
                $display[] = "Login successful";
            } else {
                $display[] = "Login failed";
            }
        } else {
            $display[] = "No username";
        }
    }
    unset($_SESSION['input_password']);
}

// ?
if ($cmd == "?") {
    $help = new Help($display);
    $help->run($args);
}

// cls
if ($cmd == "cls") {
    $display = [];
}

// register
if ($cmd == "register") {
    if (count($args) == 1) {
        // Check for valid username
        $username = $args[0];
        if (preg_match('/^[a-zA-Z0-9]{3,15}$/', $username)) {
            // Check if already exists
            $stmt = $db->prepare('SELECT username FROM user WHERE LOWER(username)=LOWER(:username)');
            $stmt->bindValue(':username', $username);
            $results = $stmt->execute();
            $row = $results->fetchArray(SQLITE3_ASSOC);
            if (!$row) {
                // Set in session
                $_SESSION['username'] = $username;
                // Ask for password
                $_SESSION['input_password'] = "register";
                $display[] = "Enter a password for your account";
            } else {
                $display[] = "This username is already registered";
            }
        } else {
            $display[] = "The username must consist of 3 to 15 alphanumeric characters";
        }
    } else {
        $display[] = "Usage: register <username>";
    }
}

// login
if ($cmd == "login") {
    if (count($args) == 1) {
        $username = $args[0];
        if (preg_match('/^[a-zA-Z0-9]{3,15}$/', $username)) {
            // Set in session
            $_SESSION['username'] = $username;
            // Ask for password
            $_SESSION['input_password'] = "login";
            $display[] = "Enter your password";
        } else {
            $display[] = "The username must consist of 3 to 15 alphanumeric characters";
        }
    } else {
        $display[] = "Usage: login <username>";
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
