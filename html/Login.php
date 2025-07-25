<?php
class Login implements CommandInterface {
    public string $command = "login";
    public array $aliases = [];
    public string $description = "Login to user account";
    public string $usage = "login <username>";

    public function isAvailable(): bool {
        return !isset($_SESSION['userid']);
    }

    public function run(array $args = []): void {
        $output = [];

        if (count($args) == 1) {
            $username = $args[0];
            if (preg_match('/^[a-zA-Z0-9]{3,15}$/', $username)) {
                // Set in session
                $_SESSION['username'] = $username;
                // Ask for password
                $_SESSION['input_password'] = "login";
                $output[] = "Enter your password";
            } else {
                $output[] = "The username must consist of 3 to 15 alphanumeric characters";
            }
        } else {
            $output[] = "Usage: $this->usage";
        }

        DP->write($output);
    }

    public function password(string $password): void {
        $output = [];

        // Check if username is set
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $stmt = DB->prepare('SELECT * FROM user WHERE LOWER(username)=LOWER(:username)');
            $stmt->bindValue(':username', $username);
            $result = $stmt->execute();
            $row = $result->fetchArray(SQLITE3_ASSOC);
            // Validate login
            if ($row && password_verify($password, $row['password'])) {
                $_SESSION['userid'] = $row['id'];
                $output[] = "Login successful";
            } else {
                $output[] = "Login failed";
            }
        } else {
            $output[] = "No username";
        }

        DP->write($output);
    }
}
