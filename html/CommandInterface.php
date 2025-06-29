<?php
interface CommandInterface {
    function __construct(array &$display);
    public string $command { get; }
    public array $aliases { get; }
    public string $description { get; }
    public string $usage { get; }
    public function run(array $args): void;
}
