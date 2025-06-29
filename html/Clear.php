<?php
class Clear implements CommandInterface {
    public string $command = "clear";
    public array $aliases = ["cls"];
    public string $description = "Clear the screen";
    public string $usage = "clear";
    public function run(array $args = []): void {
        DP->clear();
    }
}
