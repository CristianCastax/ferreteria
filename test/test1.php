<?php
session_start();
$_SESSION['x'] = 'Hola Mundo';
print_r($_SESSION);
?>