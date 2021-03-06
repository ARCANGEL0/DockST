
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

include('../controllers/adminController.php');

include('../controllers/conteinersController.php');


$objectCon = new db();
  $conn = $objectCon->conectar();
  if($conn->connect_error){
    die("Connection error: ". $conn->connect_error);
  }

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
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="../../assets/css/adminlte.min.css">
  <link rel="stylesheet" href="../../assets/css/style.css">


  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<!-- Aqui vai alguns css para corrigir bugs da tabela -->
<style>



</style>

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
            <a href="dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Início
              </p>
            </a>
          </li>
   
          <li class="nav-item">
            <a href="conteiners.php" class="nav-link active">
              <i class="nav-icon fa fa-regular fa-box"></i>
              <p>
                Contêiners
              </p>
            </a>
          </li>
         
          <li class="nav-item">
            <a href="movimentacao.php" class="nav-link ">
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



<!-- MODAL DE REGISTRAR -->


<div id="registrarCont" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Cadastrar um contêiner</h4>          </div>
          <div class="modal-body ">
          <form action="" method="POST" id="formCriar">
    <label for="regid">Número de Identificação</label>
    <input minlength="11" required class="form-control" placeholder="ID com 4 letras e 7 números" type="text" id="regid" name="regid">
    <br>
    <label for="cliente">Cliente</label>
    <input required class="form-control"  type="text" id="cliente" name="cliente">

    <br>

    <div class="d-flex justify-content-center">
    <label >Tipo</label>
        <select class="form-control" style="width: 25%; text-align: center" required onchange="" id="regTipo" name="regTipo" >
          <option hidden disabled selected value="#">Selecione o tipo</option>
          <option value="20">20</option>
          <option value="40">40</option>
</select>&nbsp;&nbsp;
      <label style="margin-left: 15%" >Status</label>
        <select class="form-control" style="width: 25%; text-align: center " required onchange="" id="regStatus" name="regStatus" >
          <option hidden disabled selected value="#">Selecione o status</option>
          <option value="Cheio">Cheio</option>
          <option value="Vazio">Vazio</option>
</select>
  </div> 
<br>
<label >Categoria</label>
        <select class="form-control"  required onchange="" id="regCategoria" name="regCategoria" >
          <option hidden disabled selected value="#">Selecione o tipo</option>
          <option value="Importação">Importação</option>
          <option value="Exportação">Exportação</option>
</select>
    </div>
          <div class="modal-footer">
          <button type="submit" name="salvarRegistro" id="salvarRegistro" class="btn btn-success">Registrar</button>
            <button type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
            </form>
          </div>
    </div>

      </div>
    </div>
<!-- FIM MODAL REGISTRAR -->


<!-- MODAL EDITAR -->
<div id="editConteiner" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Editar</h4>          </div>
          <div class="modal-body ">
          <form action="" method="POST" id="formEdit">
  
   <label for="editId">Número de Identificação</label>
    <input required class="form-control"  type="text" id="editId" name="editId">
    <br>
    <label for="editCliente">Cliente</label>
    <input required class="form-control"  type="text" id="editCliente" name="editCliente">

    <br>

    <div class="d-flex justify-content-center">
    <label >Tipo</label>
        <select required class="form-control";   id="editTipo" name="editTipo" >
          <option hidden disabled selected value="#">Selecione o tipo</option>
          <option value="10">10</option>
          <option value="20">20</option>
</select>&nbsp;&nbsp;
      <label >Status</label>
        <select required class="form-control" s onchange="" id="editStatus" name="editStatus" >
          <option hidden disabled selected value="#">Selecione o status</option>
          <option value="Cheio">Cheio</option>
          <option value="Vazio">Vazio</option>
</select>
  </div> 
<br>
<label >Categoria</label>
        <select required class="form-control"   onchange="" id="editCategoria" name="editCategoria" >
          <option hidden disabled selected value="#">Selecione o tipo</option>
          <option value="Importação">Importação</option>
          <option value="Exportação">Exportação</option>
</select>

    <input  type="hidden" id="editOldId" name="editOldId">

    </div>
          <div class="modal-footer">
          <button type="submit" name="salvarEdicao" id="salvarEdicao" class="btn btn-success">Salvar</button>
            <button type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
            </form>
          </div>
    </div>

      </div>
    </div>

<!-- FIM MODAL EDITAR -->


<!-- MODAL APAGAR -->


<div id="delConteiner" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">


      <div class="modal-content">
        <div class="modal-header">

          <h4 class="modal-title">Você tem certeza?</h4>
      
        <div class="modal-body">

        <form class="formDel" action="" method="POST" id="formDel" >

       <input type="hidden"  id="idDel" name="idDel">
    
 </div>

        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Deletar</button>

          <button type="button" class="btn btn-dark" data-dismiss="modal">Fechar</button>
          </form>
        </div>
      </div>

    </div>
  </div>
<!-- FIM MODAL APAGAR -->
  <!-- Content Wrapper. Início do conteudo -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Contêiners</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->




    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">


        <button class="btn btn-primary" type="button" name="button" data-toggle="modal" data-target="#registrarCont"><i class="fa fa-plus"></i> &nbsp;  Cadastrar um novo contêiner</button>




<br><br>


<!-- filtros -->
     <select class="btn btn-outline-info filtro" name="filtroTipo" id="filtroTipo">
          <option selected disabled hidden  value="">Tipo</option> 
                    <option value="">Todos</option>
                   <?php 


$conteiner = new conteinersController();

 $getFetch=$conteiner->getTipos ();
        $fetchs=$getFetch->fetch_all();
        foreach($fetchs as $fetch){
            echo '<option>'.$fetch[0].'</option>';
           
        }



                    ?>

        </select>

        <select class="btn btn-outline-info filtro" name="filtroCliente" id="filtroCliente">
          <option selected disabled hidden value="">Cliente</option> 
          <option value="">Todos</option>

          <?php 


$conteiner = new conteinersController();

 $getFetch=$conteiner->getClientes ();
        $fetchs=$getFetch->fetch_all();
        foreach($fetchs as $fetch){
            echo '<option>'.$fetch[0].'</option>';
           
        }



               
           ?>

        </select>


    <select class="btn btn-outline-info filtro" name="filtroStatus" id="filtroStatus">
          <option selected disabled hidden value="">Status</option> 
          <option value="">Todos</option>


<?php 

$conteiner = new conteinersController();

 $getFetch=$conteiner->getStatus ();
        $fetchs=$getFetch->fetch_all();
        foreach($fetchs as $fetch){
            echo '<option>'.$fetch[0].'</option>';
           
        }



 ?>
        </select>

          <select class="btn btn-outline-info filtro" name="filtroCategoria" id="filtroCategoria">
          <option selected disabled hidden value="">Categoria</option> 
          <option value="">Todas</option>
<?php 

$conteiner = new conteinersController();

 $getFetch=$conteiner->getCategoria ();
        $fetchs=$getFetch->fetch_all();
        foreach($fetchs as $fetch){
            echo '<option>'.$fetch[0].'</option>';
           
        }


 ?>


        </select>

<!-- fim filtros -->

        <table class="table table-bordered display" id="tabelaConteiners" width="100%" cellspacing="0">
          <form action="" id="myform">
        <thead>
        <tr>
          <th style="width: 10%">Nº do Contêiner</th>
          <th>Cliente</th>
          <th>Tipo</th>
          <th>Status</th>
          <th>Categoria</th>
       
          <th>Ações</th>
        </tr>
        </thead>
      <tbody>


      </tbody>
      </table>
      </form>




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
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/inputmask/jquery.inputmask.js"></script>

<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->


<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../assets/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../assets/js/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../assets/js/demo.js"></script>
<script src="../../plugins/toastr/toastr.min.js"></script>

<!-- SCRIPT PARA INICIAR O JS DE DATATABLES, E CRIAR UMA TABELA INTERATIVA -->

<script>


  $("#regid,#editId").inputmask("aaaa9999999",{"placeholder": ""}); // mascara de entrada para o id




  $(function(){





  var table =  $('#tabelaConteiners').DataTable({
          "language": {
          "sEmptyTable": "Nenhum registro encontrado",
          "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
          "sInfoFiltered": "(Filtrados de _MAX_ registros)",
          "sInfoPostFix": "",
          "sInfoThousands": ".",
          "sLengthMenu": "_MENU_ resultados por página",
          "sLoadingRecords": "Carregando...",
          "sProcessing": "Processando...",
          "sZeroRecords": "Nenhum registro encontrado",
          "sSearch": "Pesquisar",
          "oPaginate": {
              "sNext": "Próximo",
              "sPrevious": "Anterior",
              "sFirst": "Primeiro",
              "sLast": "Último"
          },
          "oAria": {

              "sSortAscending": ": Ordenar colunas de forma ascendente",
              "sSortDescending": ": Ordenar colunas de forma descendente"
          }},
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
      "serverSide": true,
      "processing": true,
      "ajax": '../controllers/db/getConteiners.php',
      "columnDefs": [

      {"render": acoes, "data": null, "targets": [5]},

      ],
    });

function acoes() {
            return '<button id="contExcluir" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;<button id="contEditar" type="button" class="btn btn-success"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;<button id="contMovimentos" type="button" class="btn btn-info"><i class="fa fa-search"></i></button>';



}







// buscas por parametros



    var parametroUrl = function parametroUrl(sParam) {
           var sPageURL = decodeURIComponent(window.location.search.substring(1)),
               sURLVar = sPageURL.split('&'),
               sParametNome,
               i;

           for (i = 0; i < sURLVar.length; i++) {
               sParametNome = sURLVar[i].split('=');

               if (sParametNome[0] === sParam) {
                   return sParametNome[1] === undefined ? true : sParametNome[1];
               }
           }
       };
       // Isto serve para impedir a visualização de conteudo
       //ao carregar a página, e forçar o filtro por numero

    var idnum = parametroUrl("numero");

 if (idnum != null) {
    table.rows().search(idnum, true, true).draw();
                }

    else{
        table.rows().search('').draw();

                }






table.on('click','#contMovimentos',function(){
   $tr=$(this).closest('tr');

      var data = table.row($tr).data();

    var id = data[0];
location.href="movimentacao.php?numero="+id;
     });


// fim buscas
// ajax para os filtros

$("#filtroTipo").on('change',function() 
{
table.column(2).search(this.value).draw();


  });


$("#filtroCliente").on('change',function() 
{
table.column(1).search(this.value).draw();


  });

$("#filtroStatus").on('change',function() 
{
table.column(3).search(this.value).draw();


  });

$("#filtroCategoria").on('change',function() 
{
table.column(4).search(this.value).draw();


  });


// fim ajax



//lida com o form Editar

$('#formEdit').validate({
      rules: {
        editId: { required: true, minlength:11  }
      },
      messages: {
        editId: { required: 'Preencha o ID corretamente!'},
      },
      submitHandler: function( form){



var editId =$('#editId').val();
var editCliente = $('#editCliente').val();
var editTipo = $('#editTipo').val();
var editStatus = $('#editStatus').val();
var editCategoria = $('#editCategoria').val();
var editOldId = $('#editOldId').val();

 $.ajax({
        url: '../controllers/data/conteiners/editConteiner.php',
        type: 'post',
        data: {id:editId,
          oldId: editOldId,
               cliente: editCliente,
               tipo: editTipo,
               status: editStatus,
               categoria: editCategoria
                },
        dataType: 'text',
        success:function(response){

  toastr.success('Dados alterados!');
  table.ajax.reload();
    $('#editConteiner').modal('hide');

                 },

                 error:function(response){

  toastr.error('Erro ao editar!');
    table.ajax.reload();

                 }





        });



        return false;
      },
      errorPlacement: function(){
            return false;  
        }
    });



  

// lida com o formulario do modal Registrar

  $('#formCriar').validate({
      rules: {
        regid: { required: true, minlength:11  }
      },
      messages: {
        regid: { required: 'Preencha o ID corretamente!'},
      },
      submitHandler: function( form ){


var id =$('#regid').val();
var cliente = $('#cliente').val();
var tipo = $('#regTipo').val();
var status = $('#regStatus').val();
var categoria = $('#regCategoria').val();


 $.ajax({
        url: '../controllers/data/conteiners/createConteiner.php',
        type: 'post',
        data: {id:id,
               cliente: cliente,
               tipo: tipo,
               status: status,
               categoria: categoria
                },
        dataType: 'text',
        success:function(response){

  toastr.success('Dados registrados!');
  table.ajax.reload();
    $('#registrarCont').modal('hide');
$("#formCriar")[0].reset();

                 },

                 error:function(response){

  toastr.error('Erro ao registrar!');
                 }





        });



        return false;
      },
      errorPlacement: function(){
            return false;  
        }
    });






 /// lida com evento de clique do botao Editar na tabela
 /// puxa os dados da linha e salva numa array, e insere os dados nos inputs da modal

     table.on('click','#contEditar',function(){

      $tr=$(this).closest('tr');

      var data = table.row($tr).data();

$('#editId').val(data[0]);
$('#editCliente').val(data[1]);
$('#editTipo').val(data[2]);
$('#editStatus').val(data[3]);
$('#editCategoria').val(data[4]);
$('#editOldId').val(data[0]);


// pega o ID do conteiner e abre modal de verificacao
    $('#editConteiner').modal('show');
    });


table.on('click', '#contExcluir', function(){

$tr=$(this).closest('tr');

var id = table.row($tr).data()[0];
$("#idDel").val(id);
$("#delConteiner").modal('show');


})


$("#formDel").on('submit',function(e){

e.preventDefault();

var getid = $('#idDel').val();


 $.ajax({
        url: '../controllers/data/conteiners/delConteiner.php',
        type: 'post',
        data: {id:getid},
        dataType: 'text',
        success:function(response){

toastr.success('Contêiner excluido!');
$("#delConteiner").modal('hide');
table.ajax.reload();


                 },

                 error:function(response){

  toastr.error('Erro ao excluir!');
                 }





        });
});




  });


</script>


</body>
</html>
