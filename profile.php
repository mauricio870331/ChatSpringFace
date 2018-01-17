<?php
session_start();
include_once 'clases/define.php';
require_once 'clases/BD.class.php';
$con = new BD();
$objUser = $con->findAll2("SELECT * FROM usuarios WHERE id = " . $_SESSION['obj_user'][0]['id'] . "");
$_SESSION['obj_user'] = $objUser;
$con->desconectar();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>My Profile</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />   
        <!-- FontAwesome 4.3.0 -->
        <link href="css/fa-icons.css" rel="stylesheet" type="text/css"/>    
        <!-- Theme style -->
        <link href="css/AdminLTE.min.css" rel="stylesheet" type="text/css" />      
        <!-- AdminLTE Skins. Choose a skin from the css/skins 
             folder instead of downloading all of them to reduce the load. -->
        <link href="css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <link href="css/estilo.css" rel="stylesheet" type="text/css"/>
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-red">
        <div class="wrapper">
            <!--header include -->
            <?php include_once './header.php'; ?>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="Model/imageProfile.php" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p><?php echo ucwords($objUser[0]['nombres'] . " " . $objUser[0]['apellidos']) ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="header">MAIN NAVIGATION</li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                                <li><a href="../../index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-files-o"></i>
                                <span>Layout Options</span>
                                <span class="label label-primary pull-right">4</span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                                <li><a href="../layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                                <li><a href="../layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                                <li><a href="../layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="../widgets.html">
                                <i class="fa fa-th"></i> <span>Widgets</span> <small class="label pull-right bg-green">new</small>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-pie-chart"></i>
                                <span>Charts</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                                <li><a href="../charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                                <li><a href="../charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
                            </ul>
                        </li>
                        <li class="treeview active">
                            <a href="#">
                                <i class="fa fa-laptop"></i>
                                <span>UI Elements</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="general.html"><i class="fa fa-circle-o"></i> General</a></li>
                                <li><a href="icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                                <li><a href="buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                                <li><a href="sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                                <li class="active"><a href="timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                                <li><a href="modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-edit"></i> <span>Forms</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
                                <li><a href="../forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
                                <li><a href="../forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>Tables</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                                <li><a href="../tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="../calendar.html">
                                <i class="fa fa-calendar"></i> <span>Calendar</span>
                                <small class="label pull-right bg-red">3</small>
                            </a>
                        </li>
                        <li>
                            <a href="../mailbox/mailbox.html">
                                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                                <small class="label pull-right bg-yellow">12</small>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-folder"></i> <span>Examples</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                                <li><a href="../examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                                <li><a href="../examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                                <li><a href="../examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                                <li><a href="../examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                                <li><a href="../examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                                <li><a href="../examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-share"></i> <span>Multilevel</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                                <li>
                                    <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                                    <ul class="treeview-menu">
                                        <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                                        <li>
                                            <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                                            <ul class="treeview-menu">
                                                <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                                <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                            </ul>
                        </li>
                        <li><a href="../../documentation/index.html"><i class="fa fa-book"></i> Documentation</a></li>
                        <li class="header">LABELS</li>
                        <li><a href="#"><i class="fa fa-circle-o text-danger"></i> Important</a></li>
                        <li><a href="#"><i class="fa fa-circle-o text-warning"></i> Warning</a></li>
                        <li><a href="#"><i class="fa fa-circle-o text-info"></i> Information</a></li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Mi Perfil                        
                    </h1>                    
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- row -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- The time line -->
                            <ul class="timeline">
                                <!-- timeline time label -->
                                <li class="time-label">
                                    <span class="bg-red">
                                        Ultima Modificacion: <?php echo $_SESSION['obj_user'][0]['update_at'] ?>
                                    </span>
                                </li>
                                <!-- /.timeline-label -->
                                <li>
                                    <i class="fa fa-video-camera bg-maroon"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 5 days ago</span>
                                        <h3 class="timeline-header"><a href="#">Mr. Doe</a> shared a video</h3>
                                        <div class="timeline-body" id="portada">  
                                            <div id="changeImage">
                                                <p>Cambiar Imagen</p>                                                
                                            </div>
                                            <img src="Model/imagePortada.php" />                                            
                                        </div>
                                        <div class="timeline-footer">
                                            <a href="#" class="btn btn-xs bg-maroon">See comments</a>
                                        </div>
                                    </div>
                                </li>                                
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-user bg-red"></i>
                                    <div class="timeline-item">

                                        <div class="nav-tabs-custom">
                                            <!-- Tabs within a box -->
                                            <ul class="nav nav-tabs pull-right">
                                                <li id="edit"><a  href="#revenue-chart" data-toggle="tab"><span  class="time" data-toggle="tooltip" title="Editar"><i class="fa fa-edit"></i></span></a></li>
                                                <li class="active"><a href="#datos_personales" data-toggle="tab"><span data-toggle="tooltip" title="Ver" class="time"><i class="fa fa-list-alt"></i></span></a></li>
                                                <li class="pull-left header"><h3 class="timeline-header"><a href="javascript:void(0)">Datos Personales</a></h3></li>
                                            </ul>
                                            <div class="tab-content no-padding">  
                                                <div class="tab-pane active" id="datos_personales" style="position: relative; height: 300px;">
                                                    <div class="timeline-body">                                                        
                                                        <div class="box-body">                                                            
                                                            <table class="table mytable">                                                                
                                                                <tr>                                                            
                                                                    <td>Nombres:</td>                                                  
                                                                    <td><?php echo "  " . ucwords($objUser[0]['nombres'] . " " . $objUser[0]['apellidos']); ?></td>
                                                                    <td >                                                                        
                                                                        <label data-toggle="tooltip" title="¿Publico? <?php echo ($objUser[0]['show_name'] == 1) ? 'Si' : 'No'; ?>"  class="check" for="check1">
                                                                            <input class="public" type="checkbox" <?php echo ($objUser[0]['show_name'] == 1) ? 'checked' : ''; ?>  id="check1" >                                                                
                                                                        </label>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Email:</td>
                                                                    <td><?php echo "  " . $objUser[0]['email']; ?></td>
                                                                    <td>
                                                                        <label data-toggle="tooltip" title="¿Publico? <?php echo ($objUser[0]['show_email'] == 1) ? 'Si' : 'No'; ?>"  class="check" for="check2">
                                                                            <input class="public" type="checkbox" <?php echo ($objUser[0]['show_email'] == 1) ? 'checked' : ''; ?> id="check2">                                                                
                                                                        </label>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Direccion:</td>
                                                                    <td><?php echo "  " . $objUser[0]['direccion']; ?></td>
                                                                    <td>
                                                                        <label data-toggle="tooltip" title="¿Publico? <?php echo ($objUser[0]['show_direccion'] == 1) ? 'Si' : 'No'; ?>"  class="check" for="check3">
                                                                            <input class="public" type="checkbox" <?php echo ($objUser[0]['show_direccion'] == 1) ? 'checked' : ''; ?> id="check3">                                                                
                                                                        </label>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Telefonos:</td>
                                                                    <td><?php echo "  " . $objUser[0]['telefonos']; ?></td>
                                                                    <td>
                                                                        <label data-toggle="tooltip" title="¿Publico?  <?php echo ($objUser[0]['show_telefono'] == 1) ? 'Si' : 'No'; ?>" class="check" for="check4">
                                                                            <input class="public" type="checkbox" <?php echo ($objUser[0]['show_telefono'] == 1) ? 'checked' : ''; ?> id="check4">                                                                
                                                                        </label>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Cumpleaños:</td>
                                                                    <td><?php echo "  " . $objUser[0]['fecha_nac']; ?></td>
                                                                    <td>
                                                                        <label data-toggle="tooltip" title="¿Publico? <?php echo ($objUser[0]['show_nac'] == 1) ? 'Si' : 'No'; ?>"  class="check" for="check5">
                                                                            <input class="public" type="checkbox" <?php echo ($objUser[0]['show_nac'] == 1) ? 'checked' : ''; ?> id="check5">                                                                
                                                                        </label>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Imagen de portada:</td>
                                                                    <td><img class="fotoPortada" src="Model/imagePortada.php"></td>
                                                                    <td>                                                                         
                                                                        <label data-toggle="tooltip" title="¿Publico?  <?php echo ($objUser[0]['show_foto_portada'] == 1) ? 'Si' : 'No'; ?>"  class="check" for="check6">
                                                                            <input class="public" type="checkbox" <?php echo ($objUser[0]['show_foto_portada'] == 1) ? 'checked' : ''; ?> id="check6">                                                                
                                                                        </label>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div><!-- /.box-body -->
                                                    </div>  
                                                </div>
                                                <div class="tab-pane" id="revenue-chart" style="position: relative; height: 300px;">
                                                    <div class="timeline-body">                                                        
                                                        <div class="box-body">                                                            
                                                            <table class="table mytable">
                                                                <tr>                                                            
                                                                    <td>Nombres:</td>                                                  
                                                                    <td><input id="u_nombres" class="update" type="text" value="<?php echo ucwords(trim($objUser[0]['nombres'])); ?>"/></td>
                                                                </tr>
                                                                <tr>                                                            
                                                                    <td>Apellidos:</td>                                                  
                                                                    <td><input id="u_apellidos" class="update" type="text" value="<?php echo ucwords(trim($objUser[0]['apellidos'])); ?>"/></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Email:</td>
                                                                    <td><input id="u_email" class="update" type="text" value="<?php echo trim($_SESSION['obj_user'][0]['email']); ?>"/></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Direccion:</td>
                                                                    <td><input id="u_direccion" class="update" type="text" value="<?php echo trim($_SESSION['obj_user'][0]['direccion']); ?>"/></td>

                                                                </tr>
                                                                <tr>
                                                                    <td>Telefonos:</td>
                                                                    <td><input id="u_telefonos" class="update" type="text" value="<?php echo trim($_SESSION['obj_user'][0]['telefonos']); ?>"/></td>

                                                                </tr>
                                                                <tr>
                                                                    <td>Cumpleaños:</td>
                                                                    <td><input id="u_cumple" class="update" type="text" value="<?php echo trim($_SESSION['obj_user'][0]['fecha_nac']); ?>"/></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Foto:</td>
                                                                    <td>
                                                                        <input class="file" type="button" value="Seleccionar.."/>
                                                                        <input class="cancelfile" type="button" value="Cancelar"/>
                                                                        <input type="button" id="actualizar" class="btnUpdateP" value="Actualizar">
                                                                        <input id="file" type="file" >
                                                                    </td>
                                                                </tr>

                                                            </table>
                                                        </div><!-- /.box-body -->

                                                    </div>

                                                </div>

                                            </div>
                                        </div>





                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-user bg-aqua"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>
                                        <h3 class="timeline-header no-border"><a href="#">Sarah Young</a> accepted your friend request</h3>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-comments bg-yellow"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>
                                        <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>
                                        <div class="timeline-body">
                                            Take me to your leader!
                                            Switzerland is small and neutral!
                                            We are more like Germany, ambitious and misunderstood!
                                        </div>
                                        <div class='timeline-footer'>
                                            <a class="btn btn-warning btn-flat btn-xs">View comment</a>
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline time label -->
                                <li class="time-label">
                                    <span class="bg-green">
                                        3 Jan. 2014
                                    </span>
                                </li>
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-camera bg-purple"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>
                                        <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>
                                        <div class="timeline-body">
                                            <img src="http://placehold.it/150x100" alt="..." class='margin' />
                                            <img src="http://placehold.it/150x100" alt="..." class='margin'/>
                                            <img src="http://placehold.it/150x100" alt="..." class='margin'/>
                                            <img src="http://placehold.it/150x100" alt="..." class='margin'/>
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <!-- timeline item -->
                                <li>
                                    <i class="fa fa-video-camera bg-maroon"></i>
                                    <div class="timeline-item">
                                        <span class="time"><i class="fa fa-clock-o"></i> 5 days ago</span>
                                        <h3 class="timeline-header"><a href="#">Mr. Doe</a> shared a video</h3>
                                        <div class="timeline-body">
                                            <div class="embed-responsive embed-responsive-16by9">
                                                <!--<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/tMWkeBIohBs" frameborder="0" allowfullscreen></iframe>-->                        
                                            </div>
                                        </div>
                                        <div class="timeline-footer">
                                            <a href="#" class="btn btn-xs bg-maroon">See comments</a>
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                <li>
                                    <i class="fa fa-clock-o bg-gray"></i>
                                </li>
                            </ul>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-code"></i> Timeline Markup</h3>
                                </div>
                                <div class="box-body">
                                    <pre style="font-weight: 600;">
&lt;ul class="timeline">

    &lt;!-- timeline time label -->
    &lt;li class="time-label">
        &lt;span class="bg-red">
            10 Feb. 2014
        &lt;/span>
    &lt;/li>
    &lt;!-- /.timeline-label -->

    &lt;!-- timeline item -->
    &lt;li>
        &lt;!-- timeline icon -->
        &lt;i class="fa fa-envelope bg-blue">&lt;/i>
        &lt;div class="timeline-item">
            &lt;span class="time">&lt;i class="fa fa-clock-o">&lt;/i> 12:05&lt;/span>

            &lt;h3 class="timeline-header">&lt;a href="#">Support Team&lt;/a> ...&lt;/h3>

            &lt;div class="timeline-body">
                ...
                Content goes here
            &lt;/div>

            &lt;div class='timeline-footer'>
                &lt;a class="btn btn-primary btn-xs">...&lt;/a>
            &lt;/div>
        &lt;/div>
    &lt;/li>
    &lt;!-- END timeline item -->

    ...

&lt;/ul>
                                    </pre>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 2.0
                </div>
                <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
            </footer>
        </div><!-- ./wrapper -->

        <!-- jQuery 2.1.3 -->
        <script src="plugins/jQuery/JQuery-3.2.1.js"></script>
        <script src="js/jquery_ui_min.js" type="text/javascript"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <!-- Bootstrap 3.3.2 JS -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>        
        <script src="js/app.min.js" type="text/javascript"></script><!-- tooltips -->

        <!-- FastClick -->
        <script src='plugins/fastclick/fastclick.min.js'></script>
        <script src="js/funciones.js" type="text/javascript"></script>
        <script src="js/notify.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
<!--        <script src="dist/js/app.min.js" type="text/javascript"></script>
         AdminLTE for demo purposes 
        <script src="dist/js/demo.js" type="text/javascript"></script>-->  
        <input id="filePortada" type="file" >
    </body>
</html>

<!--<table class="table ">
    <tr>                                                           
        <th>Datos Personales</th>                                               
    </tr>
    <tr>                                                            
        <td>Nombres: <input class="update" type="text" value="echo $_SESSION['obj_user'][0]['nombre']; ?>"/></td>
    </tr>
    <tr>                                                            
        <td>Apellidos:  <input class="update" type="text" value=" echo $_SESSION['obj_user'][0]['nombre']; ?>"/></td>

    </tr>
    <tr>                                                           
        <td>Foto: <input class="file" type="button" value="Seleccionar.."/>
            <input class="cancelfile" type="button" value="Cancelar"/>
            <input id="file" type="file" ></td>

    </tr>
    <tr>
        <td>Email: <input class="update" type="text" value=" echo $_SESSION['obj_user'][0]['nombre']; ?>"/></td>
    </tr>
    <tr>                                                           
        <td>Contraseña: <input class="update" type="text" value=" echo $_SESSION['obj_user'][0]['nombre']; ?>"/></td>
    </tr>

</table>-->
