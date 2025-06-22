<?php
require('init.php');
$display = filter_var_array($_SESSION['display'] ?? [], FILTER_SANITIZE_SPECIAL_CHARS);

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
            <div class="input"><?php echo PROMPT ?> <input name="command" type="text" autofocus size="75" maxlength="75" onblur="focus()" /></div>
        </div>
        <input type="submit" hidden />
    </form>
</body>
<html>