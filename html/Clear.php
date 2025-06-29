<?php
class Clear implements CommandInterface {
    function __construct(&$display) {
        $this->display = &$display;
    }
    public string $command = "clear";
    public array $aliases = ["cls"];
    public string $description = "Clear the screen";
    public string $usage = "clear";
    private array $display;
    public function run(array $args = []): void {
        $this->display = [];
    }
}
