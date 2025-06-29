<?php
class Display {
    public function __construct() {
        $this->prompt = $this->default_prompt;
        $this->lines = $_SESSION['display'] ?? [];
    }
    private int $number_of_lines = 32;
    private string $default_prompt = "CON>";
    public string $prompt = "";
    public array $lines = [];

    public function set_prompt(string $prompt) {
        $this->prompt = $prompt;
    }

    public function reset_prompt() {
        $this->prompt = $this->default_prompt;
    }

    public function output(): string {
        $output = filter_var_array($this->lines, FILTER_SANITIZE_SPECIAL_CHARS);
        return implode("<br />", $output);
    }

    public function write(mixed $lines, bool $with_prompt = false): void {
        if (gettype($lines) == "string") {
            $lines = [$with_prompt ? $this->prompt . " " . $lines : $lines];
        }

        // Add lines
        $this->lines = array_merge($this->lines, $lines);

        // Limit display lines
        $lineCount = count($this->lines);
        if ($lineCount > $this->number_of_lines) {
            array_splice($this->lines, 0, $lineCount - $this->number_of_lines);
        }

        // Store in session
        $_SESSION['display'] = $this->lines;
    }

    public function clear(): void {
        $this->lines = [];
        $_SESSION['display'] = $this->lines;
    }
}
