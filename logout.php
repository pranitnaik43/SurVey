<?php
    session_start();

    unset($_SESSION['user_id']);
    unset($_SESSION['Name']);
    unset($_SESSION['username']);

    echo '<script>
        window.location="home.php";
        </script>';

?>