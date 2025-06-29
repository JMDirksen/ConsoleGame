<?php
interface CommandInterface {
    function __construct(array &$display);
    public string $command { get; }
    public array $aliases { get; }
    public function run(array $args);
}
