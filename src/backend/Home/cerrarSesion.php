<?php
    session_start();
    session_unset();
    session_destroy();

    header("Location: ../../frontend/Index/index.php");
?>