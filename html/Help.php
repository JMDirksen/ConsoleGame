<?php
class Help implements CommandInterface {
    public string $command = "help";
    public array $aliases = ["?"];
    public string $description = "Show available commands or command info";
    public string $usage = "help [<command>]";

    public function isAvailable(): bool {
        return true;
    }

    public function run(array $args = []): void {
        $output = [];
        $commands = new Commands();
        if (!count($args)) {
            $available = implode(" ", $commands->available());
            $output[] = "Available commands: $available";
            $output[] = "Use 'help <command>' for more info";
        } else {
            $obj = $commands->get_object($args[0]);
            if ($obj) {
                $output[] = $obj->description;
                $output[] = "Usage: $obj->usage";
                if (count($obj->aliases) == 1) $output[] = "Alias: " . $obj->aliases[0];
                elseif (count($obj->aliases) > 1) $output[] = "Aliases: " . implode(", ", $obj->aliases);
            } else {
                $output[] = "Unknown command";
            }
        }
        DP->write($output);
    }
}
