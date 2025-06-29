<?php
require('init.php');
$inputType = "text";
if (isset($_SESSION['input_password'])) {
    DP->set_prompt("Password: ");
    $inputType = "password";
}
$inputSize = 80 - strlen(DP->prompt);
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
                <?php echo DP->output() ?>
            </div>
            <div class="input"><?php echo DP->prompt ?> <input name="command" type="<?php echo $inputType ?>" autofocus size="<?php echo $inputSize ?>" maxlength="<?php echo $inputSize ?>" onblur="focus()" /></div>
        </div>
        <input type="submit" hidden />
    </form>
</body>
<html>