<?php
session_start();

unset($_SESSION['logado']);
unset($_SESSION['usuario']);

header('Location: ../index.php');
?>