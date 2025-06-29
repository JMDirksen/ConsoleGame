<?php
interface CommandInterface {
    public string $command { get; }
    public array $aliases { get; }
    public function run(array $args);
}
