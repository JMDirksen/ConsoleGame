<?php
class Logout implements CommandInterface {
    public string $command = "logout";
    public array $aliases = ["exit", "quit"];
    public string $description = "Logout from user account";
    public string $usage = "logout";

    public function isAvailable(): bool {
        return isset($_SESSION['userid']);
    }

    public function run(array $args = []): void {
        unset($_SESSION['userid']);
        DP->write("Logged out");
    }
}
