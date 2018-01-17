<?php

if (isset($_GET)) {
    include_once '../clases/define.php';
    require_once '../clases/BD.class.php';
    $con = new BD();

    $userOnline = (int) $_GET['user'];
    $timestamp = ($_GET['timestamp'] == 0) ? time() : strip_tags(trim($_GET['timestamp']));
    $lastId = (isset($_GET['lastid']) && !empty($_GET['lastid'])) ? $_GET['lastid'] : 0;

    $usersOn = array();
    $ahora = date('Y-m-d H:i:s');
    $expira = date('Y-m-d H:i:s', strtotime('+2 min'));

    $update = "update usuarios set limite = '" . $expira . "' where id = " . $userOnline . " order by id desc";
    $con->exec($update);

    $friends = "SELECT * FROM friends where id_usuario = " . $userOnline;
    $rsF = $con->findAll2($friends);
    $rsUsersOn = array();
    if (count($rsF) > 0) {
        $sql = "select * from usuarios where id in (" . $rsF[0]['listFriends'] . ")";
        $rsUsersOn = $con->findAll2($sql);
    }



    $sqlEventos = "SELECT e.id_evento, concat_ws(' ',u.nombres,u.apellidos,ae.texto) evento_text, e.texto FROM eventos e " .
            "inner join eventos_users_see es on e.id_evento = es.id_evento " .
            "inner join friends f on f.id_usuario = e.id_usuario " .
            "inner join accion_evento ae on e.accion = ae.id_evento " .
            "inner JOIN usuarios u on e.id_usuario = u.id " .
            "WHERE f.listFriends like '%" . $userOnline . "%' and (es.users_see not like '%" . $userOnline . "%' or es.users_see is null)";
    $eventos = $con->findAll2($sqlEventos);


//     
    foreach ($rsUsersOn as $value) {
        $foto = ($value['foto'] == "") ? "img/default.png" : $value['foto'];
        $bloqueados = explode(',', $value['blocks']);
        if (!in_array($userOnline, $bloqueados)) {
            if ($ahora >= $value['limite']) {
                $usersOn[] = array(
                    'id' => $value['id'],
                    'nombres' => $value['nombres'],
                    'apellidos' => $value['apellidos'],
                    'text_status' => 'text-gray',
                    'status' => 'Desconectado'
                );
            } else {
                $usersOn[] = array(
                    'id' => $value['id'],
                    'nombres' => $value['nombres'],
                    'apellidos' => $value['apellidos'],
                    'text_status' => 'text-success',
                    'status' => 'Conectado'
                );
            }
        }
    }

    if (empty($timestamp)) {
        die(json_encode(array('status' => 'error')));
    }

    $tiempoTranscurrido = 0;
    $lastIdQuery = '';

    if (!empty($lastId)) {
        $lastIdQuery = " AND id > " . $lastId;
    }


    if ($_GET['timestamp'] == 0) {
        $query = "select mn.*,(select count(*) from mensajes m where m.id_de = mn.id_de and m.id_para = mn.id_para and m.leido = 0) tot_mensaje 
                  from mensajes mn where mn.leido = 0 and mn.id_para = $userOnline order by mn.id desc limit 1";
    } else {
        $query = "select * from mensajes where time >= $timestamp" . $lastIdQuery . " and leido = 0 order by id desc";
    }
    $rs = $con->findAll2($query);

    if (count($rs) <= 0) {
        while (count($rs) <= 0) {
            if (count($rs) <= 0) {
                //durar 30 segundos verificando
                if ($tiempoTranscurrido >= 30) {
                    die(json_encode(array('status' => 'vacio', 'lastid' => 0, 'timestamp' => time(), 'users' => $usersOn, 'eventos' => $eventos)));
                    exit;
                }
                sleep(1);
                $query = "select * from mensajes where time >= $timestamp" . $lastIdQuery . " and leido = 0 order by id desc";
                $rs = $con->findAll2($query);
                $tiempoTranscurrido += 1;
            }
        }
    }

    $nuevosensajes = array();
    if (count($rs) >= 1) {
        foreach ($rs as $value) {
            $fotoUser = '';
            $nombre_user = '';
            $ventana_de = 0;
            if ($userOnline == $value['id_de']) {
                $ventana_de = $value['id_para'];
            } elseif ($userOnline == $value['id_para']) {
                $ventana_de = $value['id_de'];
                $result = $con->findById("usuarios", "id", $value['id_de'], "single");
                $fotoUser = ($result->foto == '') ? "img/default.png" : $result->foto;
                $nombre_user = $result->nombres . " " . $result->apellidos;
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
            $nuevosensajes[] = array(
                'id' => $value['id'],
                'mensaje' => utf8_encode($msg),
                'fotoUser' => $fotoUser,
                'id_de' => $value['id_de'],
                'id_para' => $value['id_para'],
                'ventana_de' => $ventana_de,
                'nombre_user' => $nombre_user,
                'tot_mensaje' => $value['tot_mensaje']
            ); //     
        }
    }

    $ultimoMensaje = end($nuevosensajes);
    $ultimoId = $ultimoMensaje['id'];
    die(json_encode(array('status' => 'resultados', 'timestamp' => time(), 'lastid' => $ultimoId, 'datos' => $nuevosensajes, 'users' => $usersOn, 'eventos' => $eventos)));
}
?>