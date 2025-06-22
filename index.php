<?php
require('init.php');
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
                <pre><?php echo implode("\n", $_SESSION['display'] ?? []) ?></pre>
            </div>
            <div class="input"><?php echo PROMPT ?> <input name="command" type="text" autofocus size="75" maxlength="75" onblur="focus()" /></div>
        </div>
        <input type="submit" hidden />
    </form>
</body>
<html>