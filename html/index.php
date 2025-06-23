<?php
require('init.php');
$display = filter_var_array($_SESSION['display'] ?? [], FILTER_SANITIZE_SPECIAL_CHARS);
$prompt = PROMPT;
$inputType = "text";
if (isset($_SESSION['input_password'])) {
    $prompt = "Password: ";
    $inputType = "password";
}
$inputSize = 80 - strlen($prompt);
?>
<html>

<head>
    <title>Console Game</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form name="console" method="POST" action="command.php" spellcheck="false">
        <div class="console">
            <div class="output">
                <?php echo implode("<br />", $display) ?>
            </div>
            <div class="input"><?php echo $prompt ?> <input name="command" type="<?php echo $inputType ?>" autofocus size="<?php echo $inputSize ?>" maxlength="<?php echo $inputSize ?>" onblur="focus()" /></div>
        </div>
        <input type="submit" hidden />
    </form>
</body>
<html>