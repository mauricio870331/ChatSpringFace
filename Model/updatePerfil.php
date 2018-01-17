<?php
date_default_timezone_set('America/Bogota');
$now = date('Y-m-d H:i:s');
include_once '../clases/define.php';
require_once '../clases/BD.class.php';
$con = new BD();
//$ruta = "../archivos";
$id_user = $_POST['idUser'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$direccion = $_POST['direccion'];
$telefonos = $_POST['telefonos'];
$cumple = $_POST['cumple']; //cumpleaños
$foto = "";
if (isset($_FILES['foto']) && !empty($_FILES['foto'])) {
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
    $foto = ", foto = '" . $temp . "'";
}

$sql2 = "update usuarios set nombres = '" . trim($nombres) . "', apellidos = '" . trim($apellidos) . "',"
        . "email = '" . trim($email) . "', direccion = '" . trim($direccion) . "', telefonos = '" . trim($telefonos) . "',"
        . "fecha_nac = '" . trim($cumple) . "', update_at = '".$now."' " . $foto . " where id =" . $id_user;
if ($con->exec($sql2) > 0) {
    echo json_encode("ok");
} else {
    echo json_encode('error');
}
$con->desconectar();
