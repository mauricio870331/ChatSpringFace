<?php

date_default_timezone_set('America/Bogota');
$now = date('Y-m-d H:i:s');
include_once '../clases/define.php';
require_once '../clases/BD.class.php';
$con = new BD();
$id_user = $_POST['idUser'];
$archivo = $_FILES['foto']['tmp_name'];
$nombre_archivo = $_FILES['foto']['name'];
$tamanio = $_FILES["foto"]["size"];
$ext = pathinfo($nombre_archivo);
//$subir = move_uploaded_file($archivo, $ruta . "/" . $nombre);
$fp = fopen($archivo, 'rb');
$contenido = fread($fp, $tamanio);
$temp = addslashes($contenido);
//    $data = fread($fp, filesize($ruta . "/" . $nombre . "." . $ext['extension']));
fclose($fp);

$sql2 = "update usuarios set foto_portada = '" . $temp . "', update_at = '" . $now . "'  where id =" . $id_user;

if ($con->exec($sql2) > 0) {
    $sql = "select * from eventos where id_usuario =" . $id_user . " and accion = 'CP'";

    if (count($con->findAll2($sql)) > 0) {
        $query = "update eventos set update_at = '" . $now . "' where id_usuario =" . $id_user . " and accion = 'CP'";
    } else {
        $query = "insert into eventos values (null," . $id_user . ",'CP',null,'" . $now . "')";
    }
    $con->exec($query);
    echo json_encode("ok");
} else {
    echo json_encode('error');
}
$con->desconectar();
