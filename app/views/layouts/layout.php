<?php


require APPROOT . '/views/includes/head.php';

?>
<div class="navbar">
    <?php
    require APPROOT . '/views/includes/navigation.php';
    ?>
</div>

<div class="app">
    <?php
        require APPROOT . '/views/' . $path . '.php';

    ?>
</div>
