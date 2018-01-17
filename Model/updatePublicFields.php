<?php

session_start();
date_default_timezone_set('America/Bogota');
$now = date('Y-m-d H:i:s');
include_once '../clases/define.php';
require_once '../clases/BD.class.php';
$con = new BD();
$field = "";
$val = ($_POST['valor'] == "check c_on") ? 1 : 0;
switch ($_POST['campo']) {
    case "check1":
        $field = "show_name";
        break;
    case "check2":
        $field = "show_email";
        break;
    case "check3":
        $field = "show_direccion";
        break;
    case "check4":
        $field = "show_telefono";
        break;
    case "check5":
        $field = "show_nac";
        break;
    case "check6":
        $field = "show_foto_portada";
        break;
}
$query = "update usuarios set " . $field . " = " . $val . ", update_at = '" . $now . "' where id = " . $_SESSION['obj_user'][0]['id'];
if ($con->exec($query) > 0) {
    echo json_encode("ok");
} else {
    echo json_encode('error');
}
$con->desconectar();
