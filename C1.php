<?php
    
    $inTwoMonths = 60 * 60 * 24 * 60 + time();
    setcookie('lastVisit', date("H:i:s - m/d/y"), $inTwoMonths);
?>