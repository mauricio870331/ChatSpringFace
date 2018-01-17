<?php

session_start();
date_default_timezone_set('America/Bogota');
if (isset($_POST)) {
    include_once '../clases/define.php';
    require_once '../clases/BD.class.php';
    $con = new BD();
    $usuario = $_POST['usuario'];
    $pass = (int) $_POST['pass'];
    $resultado = $con->findAll2("SELECT * FROM usuarios WHERE email = '" . $usuario . "' and secret = '" . $pass . "'");
    if (count($resultado) == 0) {
        echo "error";
    } else {
        $now = date('Y-m-d H:i:s');
        $limit = date('Y-m-d H:i:s', strtotime('+2 min'));
        $update = "UPDATE usuarios SET fecha_hora = '" . $now . "', limite = '" . $limit . "' WHERE id = " . $resultado[0]['id'] . "";
        if ($con->exec($update)) {
            $_SESSION['obj_user'] = $resultado;
        }
        echo "ok";
    }
}