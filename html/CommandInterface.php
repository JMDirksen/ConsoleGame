<?php
interface CommandInterface {
    function __construct(array &$display);
    public string $command;
    public array $aliases;
    public string $description;
    public string $usage;
    public function run(array $args): void;
}
