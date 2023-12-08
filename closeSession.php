<?php
        session_name("panel");
        session_start();
        session_unset();
        session_destroy();
        header("Location: ./");
?>