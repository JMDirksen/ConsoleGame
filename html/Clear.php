<?php
class Clear implements CommandInterface {
    function __construct(Display $display) {
        $this->display = $display;
    }
    public string $command = "clear";
    public array $aliases = ["cls"];
    public string $description = "Clear the screen";
    public string $usage = "clear";
    private Display $display;
    public function run(array $args = []): void {
        $this->display->clear();
    }
}
