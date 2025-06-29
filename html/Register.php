<?php
class Register implements CommandInterface {
    function __construct(Display $display) {
        $this->display = $display;
    }
    public string $command = "register";
    public array $aliases = [];
    public string $description = "Register new user account";
    public string $usage = "register <username>";
    private Display $display;
    public function run(array $args = []): void {
        $output = [];
        if (count($args) == 1) {
            // Check for valid username
            $username = $args[0];
            if (preg_match('/^[a-zA-Z0-9]{3,15}$/', $username)) {
                // Check if already exists
                $stmt = DB->prepare('SELECT username FROM user WHERE LOWER(username)=LOWER(:username)');
                $stmt->bindValue(':username', $username);
                $results = $stmt->execute();
                $row = $results->fetchArray(SQLITE3_ASSOC);
                if (!$row) {
                    // Set in session
                    $_SESSION['username'] = $username;
                    // Ask for password
                    $_SESSION['input_password'] = "register";
                    $output[] = "Enter a password for your account";
                } else {
                    $output[] = "This username is already registered";
                }
            } else {
                $output[] = "The username must consist of 3 to 15 alphanumeric characters";
            }
        } else {
            $output[] = "Usage: register <username>";
        }
        $this->display->write($output);
    }
    public function password(string $password): void {
        $output = [];

        // Check if username is set
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            // Check password constraints
            if (strlen($password) >= 3 && strlen($password) <= 50) {
                // Store account
                $stmt = DB->prepare('INSERT INTO user (username, password) VALUES (:username, :password)');
                $stmt->bindValue(':username', $username);
                $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
                $stmt->execute();
                // Login
                $stmt = DB->prepare('SELECT id FROM user WHERE username=:username');
                $stmt->bindValue(':username', $username);
                $result = $stmt->execute();
                $row = $result->fetchArray(SQLITE3_ASSOC);
                $_SESSION['userid'] = $row['id'];
                $output[] = "User registered and logged in";
            } else {
                $output[] = "Password must be between 3 and 50 characters in length";
            }
        } else {
            $output[] = "No username";
        }

        $this->display->write($output);
    }
}
