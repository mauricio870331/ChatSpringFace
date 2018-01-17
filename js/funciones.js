$(document).ready(function () {
    var userOnline = Number($('.im_online').attr('id'));
    var cliqueo = [];
    var target = null;
    $('#portada').hover(function (e) {
        target = $(this);
        $(target[0].firstElementChild).fadeIn(200);
    }, function () {
        $(target[0].firstElementChild).fadeOut(200);
    });
    var input = document.querySelectorAll("label.check input");
    if (input !== null) {
        [].forEach.call(input, function (el) {
            if (el.checked) {
                el.parentNode.classList.add('c_on');
            }
            el.addEventListener("click", function (event) {
                event.preventDefault();
                el.parentNode.classList.toggle('c_on');
            }, false);
        });
    }



    function verificar(timestamp, lastid, user) {
        $("#campana").removeClass("move");
        $("#mensajesNotify").removeClass("move");
        var t; //tiempo
        jQuery.ajax({
            type: 'GET',
            url: "Model/stream.php",
            data: 'timestamp=' + timestamp + '&lastid=' + lastid + '&user=' + user,
            dataType: 'json',
            success: function (response) {
                clearInterval(t);
                if (response.status == 'resultados' || response.status == 'vacio') {
                    t = setTimeout(function () {
                        verificar(response.timestamp, response.lastid, userOnline);
                    }, 1000);
                    if (response.status == 'resultados') {
                        $("#mensajesCount").text(response.datos.length);
                        $('#listMensajesNotify').html('');
                        $('#listMensajesNotify').append('<li class="header">Tienes ' + response.datos.length + ' mensajes</li>');
                        $('#listMensajesNotify').append('<li><ul class="menu">');
                        $.each(response.datos, function (i, msg) {
//inicio mensajes
                            var msnNotify = '<li><a href="#" id="' + msg.id + '" class="limensajesN">';
                            msnNotify += '<div class="pull-left">';
                            msnNotify += '<img src="img/default.jpg" class="img-circle" alt="User Image"/>';
                            msnNotify += '</div>';
                            msnNotify += '<h4 class="tittleListmensaje">' + msg.nombre_user + '<small class="totMsn">(' + msg.tot_mensaje + ' mensajes)</small><small class="timemensaje"><i class="fa fa-clock-o"></i> 5 mins</small></h4>';
                            msnNotify += '<p class="parrafoMensaje">' + msg.mensaje + '</p></a></li>';
                            $('#listMensajesNotify').append(msnNotify);

//                            if (msg.id_para == userOnline) {
//                                jQuery.playSound('sounds/notificacion');
//                            }

                            if ($('#ventana_' + msg.ventana_de).length == 0 && msg.id_para == userOnline) {
//                                jQuery('#users_online #' + msg.ventana_de + ' .iniciar').click();
//                                jQuery('#ventana_' + msg.ventana_de + ' .messages').click();
                                cliqueo.push(msg.ventana_de);
                            }


//                            if (!in_array(msg.ventana_de, cliqueo)) {
//                                if (jQuery('.messages ul li#' + msg.id).length == 0 && msg.ventana_de > 0) {
//                                    if (userOnline == msg.id_de) {
//                                        jQuery('#ventana_' + msg.ventana_de + ' .messages ul').append('<li class="yo" id="' + msg.id + '"><p>' + msg.mensaje + '</p></li>');
//                                    } else {
//                                        jQuery('#ventana_' + msg.ventana_de + ' .messages ul').append('<li id="' + msg.id + '"><div class="imgSmall"><img src="' + msg.fotoUser + '" border="0" /></div><p>' + msg.mensaje + '</p></li>');
//                                    }
//                                }
//                            }
                        });
                        $('#listMensajesNotify').append('</ul></li><li class="footer"><a href="#">See All Messages</a></li>');
                        if (response.datos.length > 0) {
                            $("#mensajesNotify").addClass("move");
                        }
                        //fin mensajes
//                        var altura = jQuery('.messages').offset().top * 10;
//                        console.log('altura ' + altura)
//                        jQuery('.messages').animate({scrollTop: altura}, '800');
//                        console.log(cliqueo);

                    }
                    cliqueo = [];

                    $('#users_online ul').html('');
                    $('#users_online ul').append('<li class="header" id="textContacts">Contactos</li>');
                    $.each(response.users, function (index, user) {
                        var list = '<li class="active treeview separated">';
                        list += '<div class="user-panel rightBorder">';
                        list += '<i class="fa fa-gears fapersonalizado" id="' + user.id + '"></i>';
                        list += '<div class="pull-left image">';
                        list += '<img src="Model/imageProfile.php?idUser=' + user.id + '" class="img-circle" alt="User Image" />';
                        list += '</div>';
                        list += '<div class="pull-left info">';
                        list += '<p class="iniciar inip" id="' + userOnline + ':' + user.id + '">' + user.nombres + ' ' + user.apellidos + '</p>';
                        list += '<a href="#"><i class="fa fa-circle ' + user.text_status + ' my_separated"> </i>' + user.status + '</a></div></div></li>';
                        $('#users_online ul').append(list);
                    });

                    //eventos
                    $("#eventosCount").text(response.eventos.length);
                    $('#listNotifycations').html('');
                    $('#listNotifycations').append('<li class="header">Tienes ' + response.eventos.length + ' notificaciones</li>');
                    $('#listNotifycations').append('<li><ul class="menu">');
                    $.each(response.eventos, function (index, notif) {
                        var elNotify = '<li><a href="#" id="' + notif.id_evento + '">';
                        elNotify += '<i class="fa fa-users text-yellow"></i>' + notif.evento_text.length + '';
                        elNotify += '</a>';
                        elNotify += '</li>';
                        $('#listNotifycations').append(elNotify);
                    });
                    $('#listNotifycations').append('<li class="footer"><a href="#">View all</a></li>');
                    if (response.eventos.length > 0) {
                        $("#campana").addClass("move");
                    }

//                    console.log(response.eventos);

                } else if (response.status == 'error') {
                    alert('Ocurrio un error, actualice la pagina');
                }
            },
            error: function (response) {
                clearInterval(t);
                t = setTimeout(function () {
                    verificar(timestamp, lastid, userOnline);
                }, 15000);
            }
        });
    }


    $(".update").mouseenter(function () {
        $(this).css("border", "0.5px solid lightgray");
    });

    $(".update").mouseleave(function () {
        $(this).css("border", "0.5px solid white");
    });

    $(".file").click(function () {
        $("#file").trigger("click");
        $('#file').change(function () {
            var filename = $('#file').val();
            var splitDatos = filename.split('\\');
            $('.file').val("Archivo seleccionado: " + splitDatos[splitDatos.length - 1]);
        });
    });

    $("#changeImage").click(function () {
        $("#filePortada").trigger("click");
        $('#filePortada').change(function () {
            if ($('#filePortada').val().length > 0) {
                var inputFile = document.getElementById("filePortada");
                var file = inputFile.files[0];
                var data = new FormData();
                data.append("foto", file);
                data.append("idUser", userOnline);
                $.ajax({
                    type: 'POST',
                    url: "Model/updatePortada.php",
                    data: data,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function (response) {
                        if (response == "ok") {
                            setTimeout(redireccionarPagina('profile.php'), 3000);
                        } else {
                            showAlert("No se realizo ningun cambio", "error");
                        }
                    }
                });
            } else {
                return;
            }

        });
    });
    $(".cancelfile").click(function () {
        $('#file').val("");
        $(".file").val("Seleccionar..");
    });
    $("#actualizar").click(function () {
        var inputFile = document.getElementById("file");
        var file = inputFile.files[0];
//        var inputFile = $('#file')[0].files[0];
//        var file = inputFile;
//        console.log(file);
        var data = new FormData();
        data.append("foto", file);
        data.append("idUser", userOnline);
        data.append("nombres", $("#u_nombres").val());
        data.append("apellidos", $("#u_apellidos").val());
        data.append("email", $("#u_email").val());
        data.append("direccion", $("#u_direccion").val());
        data.append("telefonos", $("#u_telefonos").val());
        data.append("cumple", $("#u_cumple").val());
        $.ajax({
            type: 'POST',
            url: "Model/updatePerfil.php",
            data: data,
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            success: function (response) {
                if (response == "ok") {
                    setTimeout(redireccionarPagina('profile.php'), 3000);
                } else {
                    showAlert("Ocurrio un error al actualizar la informaciòn", "error");
                }
            }
        });
    });



//style : success,info,warn,error
    function showAlert(text, style) {
        $.notify(text, style);
    }


    function redireccionarPagina(pagina) {
        window.location = pagina;
    }

    $("#edit").click(function () {
        $("#u_nombres").css("border", "0.5px solid lightgray");
    });
    $(".public").click(function () {
        var elemento = $(this);
        var field = elemento.parent(elemento).attr("for");
        var value = elemento.parent(elemento).attr("class");
        $.ajax({
            type: 'POST',
            url: "Model/updatePublicFields.php",
            dataType: 'json',
            data: {"campo": field, "valor": value},
            success: function (response) {
                if (response == "ok") {
                    setTimeout(redireccionarPagina('profile.php'), 3000);
                } else {
                    showAlert("No se pudo cambiar el estado", "error");
                }
            }
        });
    });
    function addVentana(id, nombre, status) {
        var ventanas = Number($("#chats .window").length);
        var pixeles = (260 + 5) * ventanas;
        var style = 'float:right; position:absolute; bottom:0; right:' + pixeles + 'px';
        var splitDatos = id.split(':');
        var id_user = Number(splitDatos[1]);
        var ventana = "<div class='window' id='ventana_" + id_user + "' style='" + style + "'>";
        ventana += "<div class='header_window'><a href='#' class='cerrar' >X</a>";
        ventana += "<span class='name'>" + nombre + "</span>";
        ventana += "<span id='" + id_user + "' class='" + status + "'></span>";
        ventana += "</div><div class='body'><div class='messages'>";
        ventana += "<ul></ul></div><div class='send_messages' id='" + id + "'>";
        ventana += "<input type='text' name='mensaje' class='msg' id='" + splitDatos[1] + "' data-id='" + id + "' />";
        ventana += "</div></div></div>";
        $('#chats').append(ventana);
    }


    $('body').on('click', '#users_online section ul li div div p', function () {
//        console.log('todo bienz');
        var id = $(this).attr('id');
        $(this).removeClass('iniciar');
        var status = $(this).next().attr('class');
        var splitIds = id.split(':');
        var idVentana = Number(splitIds[1]);
        if ($('#ventana_' + idVentana).length == 0) {
            var nombre = $(this).text();
            addVentana(id, nombre, status);
            retorna_history(idVentana);
        } else {
            $(this).removeClass('iniciar');
        }
    });
    function retorna_history(id_conversacion) {
        $.ajax({
            type: 'POST',
            url: "Model/historico.php",
            data: {id_conversa: id_conversacion, online: userOnline},
            dataType: 'json',
            success: function (response) {
                $.each(response, function (i, msg) {
                    if ($('#ventana_' + msg.ventana_de).length > 0) {
                        if (userOnline == msg.id_de) {
                            $('#ventana_' + msg.ventana_de + ' .messages ul').append('<li id="' + msg.id + '" class="yo"><p>' + msg.mensaje + '</p></li>');
                        } else {
                            $('#ventana_' + msg.ventana_de + ' .messages ul').append('<li id="' + msg.id + '"><div class="imgSmall"><img src="' + msg.fotoUser + '" border="0" /></div><p class="remite">' + msg.mensaje + '</p></li>');
                        }
                    }
                });
                [].reverse.call($('#ventana_' + id_conversacion + ' .messages li').appendTo($('#ventana_' + id_conversacion + ' .messages ul')));
                var altura = $('.messages').offset().top * 8;
                $('#ventana_' + id_conversacion + ' .messages').animate({
                    scrollTop: altura}, '1100');
            }
        });
    }

    $('body').on('click', '.header_window', function () {
        var next = $(this).next();
        next.toggle(100);
    });
    $('body').on('click', '.cerrar', function () {
        var parent = $(this).parent().parent();
        var idParent = parent.attr('id');
        var splitParent = idParent.split('_');
        var idVentanaCerrada = Number(splitParent[1]);
        var recuento = Number($('.window').length) - 1;
        var indice = Number($('.cerrar').index(this));
        var ultimasAlFrente = recuento - indice;
        for (var i = 1; i <= ultimasAlFrente;
                i++
                ) {
            $('.window:eq(' + (indice + i) + ')').animate({left: "+=265"}, 200);
        }
        parent.remove();
        $('#users_online li#' + idVentanaCerrada + ' a').addClass('iniciar');
    });
    $('body').on('click', '.fapersonalizado', function () {
        var parent = $(this).parent().parent();
        var posicion = parent.position();
        var elemento = $(this);
        var ventana_ancho = $(window).width();
        var ventana_alto = $(window).height();
        var incluir = '<div class="dropdown-panel" >';
        incluir += '<div id="cn_flecha"><div class="flecha-up"></div></div>';
        incluir += '<div class="header">Información de Contacto<span class="close">X</span></div>';
        incluir += '<div class="body">';
        incluir += '<div class="notify_info" data-id="' + elemento.attr("id") + '">Ver perfil</div>'; //repetir                       
        incluir += '</div>';
        incluir += '<div class="footer-notfi">Spring-face</div>';
        incluir += '</div>';
        if (!$('.dropdown-panel').is(":visible")) {
            $('#cn').append(incluir);
            $('.dropdown-panel').offset({top: posicion.top + 50, left: posicion.right});
            $('.dropdown-panel').css("width", "230");
            $('.dropdown-panel').css("height", "210px");
            $('.dropdown-panel').animate({
                width: "toggle"
            });
        } else {
            $('.dropdown-panel').html("");
            $('.dropdown-panel').animate({
                width: "toggle"
            });
            $('.dropdown-panel').remove();
        }
    });
    $('body').on('click', '.close', function () {
        $('.dropdown-panel').html("");
        $('.dropdown-panel').animate({
            width: "toggle"
        });
        $('.dropdown-panel').remove();
    });
    $('body').on('click', '.notify_info', function () {
        var elemento = $(this);
        console.log(elemento.data('id'))
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = "viewprofile.php";
        var input = document.createElement('input');
        input.type = "hidden";
        input.name = "id_perfil";
        input.value = elemento.data('id');
        form.appendChild(input);
        $('body').append(form);
        form.submit();
    });
    verificar(0, 0, userOnline);
});

