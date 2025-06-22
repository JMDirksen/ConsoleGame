<?php
require('init.php');

$display = $_SESSION['display'] ?? [];
$command = $_POST['command'];
$display[] = PROMPT . " " . $command;

if ($command == "cls") {
    $display = [];
}

$lineCount = count($display);
if ($lineCount > DISPLAY_LINES) {
    array_splice($display, 0, $lineCount - DISPLAY_LINES);
}

$_SESSION['display'] = $display;
header('Location: /');
