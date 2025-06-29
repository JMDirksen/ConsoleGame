<?php
require('init.php');
$display = new Display();
$inputType = "text";
if (isset($_SESSION['input_password'])) {
    $display->prompt = "Password: ";
    $inputType = "password";
}
$inputSize = 80 - strlen($display->prompt);
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
                <?php echo $display->output() ?>
            </div>
            <div class="input"><?php echo $display->prompt ?> <input name="command" type="<?php echo $inputType ?>" autofocus size="<?php echo $inputSize ?>" maxlength="<?php echo $inputSize ?>" onblur="focus()" /></div>
        </div>
        <input type="submit" hidden />
    </form>
</body>
<html>