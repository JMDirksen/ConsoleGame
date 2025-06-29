<?php
class Version implements CommandInterface {
    function __construct(&$display) {
        $this->display = &$display;
    }
    public string $command = "version";
    public array $aliases = ["ver"];
    public string $description = "Show Console Game version";
    public string $usage = "version";
    private array $display;
    public function run(array $args = []): void {
        $output = [];

        $output[] = "Console Game version " . VER;

        $this->display = array_merge($this->display, $output);
    }
}
