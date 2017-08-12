<?php
//destroy session and redirect
session_start();
session_destroy();
header('Location: ../common/index.php');
?>