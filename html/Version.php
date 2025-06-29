<?php
class Version implements CommandInterface {
    function __construct(Display $display) {
        $this->display = $display;
    }
    public string $command = "version";
    public array $aliases = ["ver"];
    public string $description = "Show Console Game version";
    public string $usage = "version";
    private Display $display;
    public function run(array $args = []): void {
        $output = [];

        $output[] = "Console Game version " . VER;

        $this->display->write($output);
    }
}
