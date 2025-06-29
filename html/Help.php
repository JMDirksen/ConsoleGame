<?php
class Help implements CommandInterface {
    function __construct(&$display) {
        $this->display = &$display;
    }
    public string $command = "help";
    public array $aliases = ["?"];
    private array $display;
    public function run(array $args = []) {
        $output = [];
        if (!count($args)) {
            $output[] = "Available commands: ? cls login register ver";
            $output[] = "Use '? <command>' for more info";
        } elseif ($args[0] == "?") {
            $output[] = "Show available commands";
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

        $this->display = array_merge($this->display, $output);
    }
}
