<?php

class Commands {
    public array $list = ['clear', 'help', 'login', 'logout', 'register', 'version'];
    public array $objects = [];

    public function __construct() {
        foreach ($this->list as $cmd) {
            $className = ucfirst($cmd);
            $this->objects[$cmd] = new $className();
        }
    }

    public function available(): array {
        $available = [];
        foreach ($this->objects as $obj) {
            if ($obj->isAvailable()) $available[] = $obj->command;
        }
        return $available;
    }

    public function get_object(string $command) {
        $cmd = strtolower($command);
        foreach ($this->objects as $obj) {
            if ($obj->command == $cmd || in_array($cmd, $obj->aliases)) return $obj;
        }
        return false;
    }
}
