<?php
class Help implements CommandInterface {
    public string $command = "help";
    public array $aliases = ["?"];
    public string $description = "Show available commands or command info";
    public string $usage = "help [<command>]";
    public function run(array $args = []): void {
        $output = [];
        if (!count($args)) {
            $output[] = "Available commands: help cls login register ver";
            $output[] = "Use 'help <command>' for more info";
        } elseif ($args[0] == "help") {
            $output[] = $this->description;
            $output[] = $this->usage;
        } elseif ($args[0] == "cls") {
            $output[] = "Clear the screen";
        } elseif ($args[0] == "login") {
            $output[] = "Login to user account";
            $output[] = "Usage: login <username>";
        } elseif ($args[0] == "register") {
            $output[] = "Register new user account";
            $output[] = "Usage: register <username>";
        } elseif ($args[0] == "ver") {
            $output[] = "Show Console Game version";
        }

        DP->write($output);
    }
}
