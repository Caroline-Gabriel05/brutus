<?php
session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usuario'] != 1) {
    header('Location: login.php');
    exit;
}

include_once "painel.html";

?>