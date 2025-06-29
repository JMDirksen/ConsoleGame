<?php
interface CommandInterface {
    public string $command { get; }
    public array $aliases { get; }
    public string $description { get; }
    public string $usage { get; }
    public function run(array $args): void;
    public function isAvailable(): bool;
}
