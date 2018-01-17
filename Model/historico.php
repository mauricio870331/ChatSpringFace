<?php

if (isset($_POST['id_conversa'])) {
    include_once '../clases/define.php';
    require_once '../clases/BD.class.php';
    $con = new BD();
    $idConversa = (int) $_POST['id_conversa'];
    $online = (int) $_POST['online'];
    $query = "select * from mensajes where (id_de = " . $online . " and id_para = " . $idConversa . ") or (id_de = " . $idConversa . " "
            . "and id_para = " . $online . ")";
    $rs = $con->findAll2($query);

//    print_r($rs);
//    die;

    foreach ($rs as $value) {
        $fotoUser = '';
        if ($online == $value['id_de']) {
            $ventana_de = $value['id_para'];
        } elseif ($online == $value['id_para']) {
            $ventana_de = $value['id_de'];
            $result = $con->findById("usuarios", "id", $value['id_de'], "single");
            $fotoUser = ($result->foto == '') ? "img/default.jpg" : $result->foto;
        }

        $emoticones = array(':)', ':@', '8)', ':D', ':3', ':(', ';)');
        $imgs = array(
            '<img src="images/emojis/(11).png" width="14"/>',
            '<img src="images/emojis/(15).png" width="14"/>',
            '<img src="images/emojis/(18).png" width="14"/>',
            '<img src="images/emojis/(16).png" width="14"/>',
            '<img src="images/emojis/(1).png" width="14"/>',
            '<img src="images/emojis/(12).png" width="14"/>',
            '<img src="images/emojis/(13).png" width="14"/>'
        );

        $msg = str_replace($emoticones, $imgs, $value['mensaje']);
        $mensajes[] = array(
            'id' => $value['id'],
            'mensaje' => utf8_encode($msg),
            'fotoUser' => $fotoUser,
            'id_de' => $value['id_de'],
            'id_para' => $value['id_para'],
            'ventana_de' => $ventana_de
        ); //        
    }
    die(json_encode($mensajes));
}
