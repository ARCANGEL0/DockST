
<?php
// Aqui o PHP inicia uma sessão, e inclui o arquivo verifyLogin.php ao carregar
session_start();
if(!$_SESSION['admin']) {
  header('Location: ../../index.php');
  exit();
}
include('../models/db.php');
include('../models/administrador.php');
include('../models/conteiner.php');
include('../models/movimento.php');
include('../controllers/movimentosController.php');
include('../controllers/adminController.php');

include('../controllers/conteinersController.php');

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DockST | Sistema Portuário</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../assets/css/adminlte.min.css">
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="stylesheet" href="../../assets/Admin/css/style.css">

  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="../../assets/Admin/js/paginate.js" charset="utf-8"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>


</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        </div>
        <div class="pageLogo">
       <i class="fa fa-user"></i>
       <h5>
<?php

 echo unserialize($_SESSION['admin'])->getUsuario();

 ?>
 

     </h5>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar nav-legacy flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class

               with font-awesome or any other icon font library -->



          <li class="nav-item ">
            <a href="dashboard.php" class="nav-link active">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Início
              </p>
            </a>
          </li>
   
          <li class="nav-item">
            <a href="conteiners.php" class="nav-link">
              <i class="nav-icon fa fa-regular fa-box"></i>
              <p>
                Contêiners
              </p>
            </a>
          </li>
         
          <li class="nav-item">
            <a href="movimentacao.php" class="nav-link">
              <i class="nav-icon fa fa-retweet"></i>
              <p>
                Movimentação
              </p>
            </a>

          </li>

   <li class="nav-item">
            <a href="../controllers/Login/Logout.php" class="nav-link">
              <i class="nav-icon fa fa-sign-out-alt"></i>
                            
   <p>Sair</p>
              </p>
            </a>

          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div  style="margin-left: 41%" class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Página Inicial</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content ">
      <div class="container-fluid ">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-12 col-6 text-center">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>
<?php


$movimento = new movimentosController();

 $getFetch=$movimento->count();
        $fetchs=$getFetch->fetch_all();
        foreach($fetchs as $fetch){
            echo '<option>'.$fetch[0].'</option>';
           
        }


 ?>

                </h3>

                <p>Contêiners em movimento</p>
              </div>
              <div class="icon">
                <i class="fa fa-retweet text-center"></i>
              </div>
            </div>
          </div>
      
          <!-- ./col -->
          <div class="col-lg-12 col-6 text-center">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>
                <?php


$conteiner = new conteinersController();

 $getFetch=$conteiner->count();
        $fetchs=$getFetch->fetch_all();
        foreach($fetchs as $fetch){
            echo '<option>'.$fetch[0].'</option>';
           
        }


 ?>
                </h3>

                <p>Contêiners registrados</p>
              </div>
              <div class="icon">
                <i class="fa fa-box"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->


            <!-- TO DO List -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  Etapas para concluir
                </h3>

                <div class="card-tools">

                </div>
              </div>
              <script>



          var todo1 ='<ul class="todo-list" data-widget="todo-list">'+


          '<li class=" done">'+

                      '<div  class="icheck-primary d-inline ml-2">'+
                      '<i class="fa fa-clipboard"></i>'+

                      '</div>'+
                      '<span class="text">Editar esquema de exportação da tabela estilizado</span>'+
                      '<span class="text">para agrupar por nome</span>'+

 

            '<li class="done">'+

                        '<div  class="icheck-primary d-inline ml-2">'+
                        '<i class="fa fa-clipboard"></i>'+

                        '</div>'+
                        '<span class="text">Criar botão para ao clicar, redirecionar</span>'+
                        '<span class="text">para outra página, buscando por parâmetro</span>'+
                        '<span class="text">ex: buscar em movimentações pelo Nº do contêiner</span>'+

                     

            '<li class="done">'+

                        '<div  class="icheck-primary d-inline ml-2">'+
                        '<i class="fa fa-clipboard"></i>'+

                        '</div>'+
                        '<span class="text">Criar uma forma de exportar a tabela em XLSX e PDF</span>'+


                           '<li class="done">'+

                        '<div  class="icheck-primary d-inline ml-2">'+
                        '<i class="fa fa-clipboard"></i>'+

                        '</div>'+
                        '<span class="text">Criar dependência no registro de movimentações</span>'+
                        '<span class="text"> Para que só possa ser possível cadastrar movimentações</span>'+
                        '<span class="text"> de contêiners não utilizados ainda.</span>'+



                         '<li class="done">'+

                        '<div  class="icheck-primary d-inline ml-2">'+
                        '<i class="fa fa-clipboard"></i>'+

                        '</div>'+
                        '<span class="text">Criar selects para uso de filtragem na tabela</span>'+
                        '<span class="text">podendo listar por dados nas colunas</span>'+


                            '<li class="done">'+

                        '<div  class="icheck-primary d-inline ml-2">'+
                          '<i class="fa fa-clipboard"></i>'+
                        '</div>'+
                        '<span class="text">Criar eventos para lidar com requisições</span>'+
                '<span class="text">através do AJAX</span>'+


  '<li class="done">'+

                        '<div  class="icheck-primary d-inline ml-2">'+
                          '<i class="fa fa-clipboard"></i>'+
                        '</div>'+
                        '<span class="text">Criar modals para manipulação dos dados para seguir o esquema CRUD</span>'+


    '<li class="done">'+

                        '<div  class="icheck-primary d-inline ml-2">'+
                          '<i class="fa fa-clipboard"></i>'+
                        '</div>'+
                        '<span class="text">Tornar as tabelas interativas fazendo uso dos Controladores disponíveis</span>'+

          '<li class="done">'+
                      '<div  class="icheck-primary d-inline ml-2">'+
                        '<i class="fa fa-clipboard"></i>'+
                      '</div>'+
                        '<span class="text">Criar tabelas para MOVIMENTAÇÕES e CONTEINERS</span>'+

                      '<li class="done">'+
                      '<div  class="icheck-primary d-inline ml-2">'+
                        '<i class="fa fa-clipboard"></i>'+
                      '</div>'+
                        '<span class="text">Criar sistema de login fazendo uso dos modelos para acesso</span>'+


   '<li class="done">'+
                      '<div  class="icheck-primary d-inline ml-2">'+
                        '<i class="fa fa-clipboard"></i>'+
                      '</div>'+
                        '<span class="text">Criar controladores para manipular</span>'+

                        '<span class="text">dados e modelos</span>'+


                      '<li class="done">'+

                        '<div class="icheck-primary d-inline ml-2">'+
                        '<i class="fa fa-clipboard"></i>'+

                        '</div>'+
                        '<span class="text">Criar modelos PHP para conteiners</span>'+
                        '<span class="text">e movimentações</span>' +
                      '</li>'+
                      '<li class="done">'+

                        '<div  class="icheck-primary d-inline ml-2">'+
                        '<i class="fa fa-clipboard"></i>'+

                        '</div>'+
                        '<span class="text">Criar esquema de banco de dados</span>'+


                    '</ul>';


              </script>


              <!-- /.card-header -->
              <div class="card-body">


                <ul class="todo-list">

                  <div id="content">
<script>
    $("#content").html(todo1);
</script>
                  </div>
                </ul>

              </div>

              <!-- /.card-body -->
              <div class="card-footer clearfix">

              </div>
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
         
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">


  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<!-- jQuery UI 1.11.4 -->
<script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../plugins/jqvmap/maps/jquery.vmap.brazil.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../assets/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../assets/js/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../assets/js/demo.js"></script>
</body>
</html>
