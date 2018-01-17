<?php
session_start();
include_once '../clases/define.php';
require_once '../clases/BD.class.php';
$con = new BD();
$id_user = (isset($_GET['idUser']) && !empty($_GET['idUser'])) ? $_GET['idUser'] : $_SESSION['obj_user'][0]['id'];
$rs = $con->findAll2("SELECT foto_portada FROM usuarios WHERE id = " . $id_user . "");
$foto = $rs[0]['foto_portada'];
header("Content-type: image/jpeg");
if ($foto != null || $foto != "") {
    echo $foto;
} else {
    $img = "../img/photo1.png";
    $dat = file_get_contents($img);    
    echo $dat;
}
?>
