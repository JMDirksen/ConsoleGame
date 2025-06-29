<?php
class Version implements CommandInterface {
    public string $command = "version";
    public array $aliases = ["ver"];
    public string $description = "Show Console Game version";
    public string $usage = "version";
    public function run(array $args = []): void {
        $output = [];

        $output[] = "Console Game version " . VER;

        DP->write($output);
    }
}
