<?php
    session_start();

    echo "Welcome to page #1";
    $_SESSION['model'] = 'BMW';
    $_SESSION['color'] = 'Black'; 
    $_SESSION['time'] = time();

    echo '<br><a href="S2.php">Page 2</a>';
?>