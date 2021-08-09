
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
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="../../assets/css/adminlte.min.css">
  <link rel="stylesheet" href="../../assets/css/style.css">

<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment-with-locales.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

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
            <a href="conteiners.php" class="nav-link ">
              <i class="nav-icon fa fa-regular fa-box"></i>
              <p>
                Contêiners
              </p>
            </a>
          </li>
         
          <li class="nav-item">
            <a href="movimentacao.php" class="nav-link active">
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


<div id="registrarMov" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Registrar um movimento</h4>          </div>
          <div class="modal-body ">
          <form action="" method="POST" id="formCriar">
    <label for="regid">Número do contêiner</label>
    <select required class="form-control" name="regID" id="regID"> 
      <option hidden selected disabled value="">Selecione um conteiner</option>

  
      


    </select>
<br>
 <label for="regCliente">Cliente</label>
<input disabled type="text" class="form-control" required id="regCliente" name="regCliente" >
<br>

    <label for="regTipo">Tipo de movimentação</label>
    <select required class="form-control"  type="text" id="regTipo" name="regTipo">
      <option selected hidden disabled value="">Selecione o tipo</option>
      <option value="Embarque">Embarque</option>
      <option value="Descarga">Descarga</option>
      <option value="Gate in">Gate in</option>
      <option value="Gate out">Gate out</option>
      <option value="Posicionamento">Posicionamento</option>
      <option value="Pilha">Pilha</option>
      <option value="Pesagem">Pesagem</option>
      <option value="Scanner">Scanner</option>



</select>
    <br>

    <div class="d-flex justify-content-center">
    <label style="margin-left:-2%" >Data de início</label>
        <input type="date" class="form-control" style="width: 25%; text-align: center" required onchange="" id="regDataInicio" name="regDataInicio" >
      
</input>&nbsp
      <label  >Data final</label>
        <input type="date" class="form-control" style="width: 25%; text-align: center " required onchange="" id="regDataFim" name="regDataFim" >
     
</input>
  </div> 

        <input type="hidden" required id="regCategoria" name="regCategoria" >


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
<div id="editMov" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Editar</h4>          </div>
          <div class="modal-body ">
          <form action="" method="POST" id="formEdit">
  
 <label for="editId">Número do contêiner</label>
    <input type="text" disabled class="form-control" name="editId" id="editId"> 

  
    </input>
    <br>
    <label for="editTipo">Tipo de movimentação</label>
    <select required class="form-control"  type="text" id="editTipo" name="editTipo">
      <option selected hidden disabled value="">Selecione o tipo</option>
      <option value="Embarque">Embarque</option>
      <option value="Descarga">Descarga</option>
      <option value="Gate in">Gate in</option>
      <option value="Gate out">Gate out</option>
      <option value="Posicionamento">Posicionamento</option>
      <option value="Pilha">Pilha</option>
      <option value="Pesagem">Pesagem</option>
      <option value="Scanner">Scanner</option>



</select>
    <br>

    <div class="d-flex justify-content-center">
    <label style="margin-left:-2%" >Data de início</label>
        <input type="date" class="form-control" style="width: 25%; text-align: center" required onchange="" id="editDataI" name="editDataI" >
      
</input>&nbsp
      <label  >Data final</label>
        <input type="date" class="form-control" style="width: 25%; text-align: center " required onchange="" id="editDataF" name="editDataF" >
     
</input>
  </div> 


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


<div id="delMov" class="modal fade" role="dialog">
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
    <div class="content-header movHeader">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Movimentações</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->




    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

       


<br><br>
<div class="filtros d-flex justify-content-left">

<!-- filtros -->
     <select class="btn btn-outline-info filtro" name="filtroTipo" id="filtroTipo">
          <option selected disabled hidden  value="">Tipo de movimentacao</option> 
                    <option value="">Todos</option>

    <?php 


$movimento = new movimentosController();

 $getFetch=$movimento->getTipos();
        $fetchs=$getFetch->fetch_all();
        foreach($fetchs as $fetch){
            echo '<option>'.$fetch[0].'</option>';
           
        }




               
           ?>


        </select>


         <select class="btn btn-outline-info filtro" name="filtroClientes" id="filtroClientes">
          <option selected disabled hidden  value="">Cliente</option> 
                    <option value="">Todos</option>

    <?php 


$movimento = new movimentosController();

 $getFetch=$movimento->getClientes();
        $fetchs=$getFetch->fetch_all();
        foreach($fetchs as $fetch){
            echo '<option>'.$fetch[0].'</option>';
           
        }




               
           ?>


        </select>

<div id="reportrange" class="btn btn-outline-info filtro" style="width: auto">
    <i class="fa fa-calendar"></i>&nbsp;
    <span></span> <i class="fa fa-caret-down"></i>
</div>



</div>

<!-- fim filtros -->

        <table class="table table-bordered display" id="tabelaMovimentacoes" width="100%" cellspacing="0">
          <form action="" id="myform">
   <thead>
          <th >Nº do Contêiner</th>
          <th>Cliente</th>
          <th>Tipo de movimentação</th>
          <th>Data de inicio</th>
          <th>Data final</th>
          <th>Categoria</th>

          <th style="width: 10%">Ações</th>
   </thead>
    
   <tfoot>
    

  
    </tfoot>
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
<script src="../plugins/datatables-buttons/js/dataTables.buttons.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment-with-locales.min.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>



  $(function(){





  var table =  $('#tabelaMovimentacoes').DataTable({
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
         "dom": 'Bfrtip',
      "buttons": [
         
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 2, 3,4,5],
                    grouped_array_index: [1]
                },
                className: "btn btn-success",
                text: "<i class='fa fa-file-excel'></i>&nbsp;&nbsp; Gerar relatório em Excel"
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 2, 3,4,5],
                    grouped_array_index: [1],



                },
              

                footer: true,
                header: true,


                className: "btn btn-danger",
                text: "<i class='fa fa-file-pdf'></i>&nbsp;&nbsp; Gerar relatório em PDF"

            }
        ],
      "ajax": '../controllers/db/getMovimentacoes.php',
      "columnDefs": [
      {"targets":[1,5], "visible": false},
      {"render": acoes, "data": null, "targets": [6]},
      {"targets":[3,4], "render":function(data){
      return moment(data).format('dddd, DD MMMM  YYYY');
    }}

      ],
  "footerCallback": function (row, data, start, end, display) {
                var api = this.api(), data;

                var intVal = function (i) {
                    return typeof i === 'string' ?
                        i.replace(/[\L,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };

                total = api
                    .column(5)
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0)
                ;

                pageTotal = api
                    .column(5, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0)
                ;

                $(api.column([5, 3]).footer()).html(
              
                    '' + total

                );
                total = api
                    .column(3)
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0)
                ;

                pageTotal = api
                    .column(1, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0)
                ;

                $(api.column(1).footer()).html(
                    '' + total

                );
            },

 "order": [[1, 'asc']],
            "displayLength": 25,
            "drawCallback": function (settings) {
                var api = this.api();
                var rows = api.rows({ page: 'all' }).nodes();
                var last = null;

            var storedIndexArray = [];
            api.column(1, { page: "all" })
                .data()
                .each((group, i) => {
                    if (last !== group) {
                        storedIndexArray.push(i);
                        $(rows)
                            .eq(i)
                            .before(
                                '<tr class="group"><td class="bg bg-dark" colspan="4">' +
                                    group +"</td><td class='text-center bg bg-primary group group-count'></td></tr>",


                             '<tr>',
          '<th >Nº do Contêiner</th>',
          '<th>Tipo de movimentação</th>',
          '<th>Data de inicio</th>',
          '<th>Data final</th>', 

          '<th style="width: 10%"1>Ações</th>',
        '</tr>',


                            );
                        last = group;
                    }
                });
            storedIndexArray.push(
                api.column(0, { page: "current" }).data().length
            );
            for (let i = 0; i < storedIndexArray.length - 1; i++) {
                let element = $(".group-count")[i];
                $(element).text(
                    storedIndexArray[i + 1] - storedIndexArray[i]
                );
            }


            } // fim callback



    });

function acoes() {
            return '<button id="movExcluir" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;<button id="movEditar" type="button" class="btn btn-success"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;<button id="movConteiners" type="button" class="btn btn-info"><i class="fa fa-search"></i></button>';



}

$(".dt-buttons").prepend('<button class="btn btn-primary" type="button" name="button" id="registrar" data-toggle="modal" data-target="#registrarMov"><i class="fa fa-plus"></i> &nbsp;  Registrar um novo movimento</button>');





$("#filtroTipo").on('change',function() 
{
table.column(2).search(this.value).draw();


  });

$("#filtroClientes").on('change',function() 
{
table.column(1).search(this.value).draw();


  });

// filtro para Datas 

    moment.locale('pt-br');

    var dataInicio = moment().subtract(29, 'days');
    var dataFim = moment();

    function cb(dataInicio, dataFim) {
        $('#reportrange span').html(dataInicio.format('D MMMM, YYYY') + ' - ' + dataFim.format('D MMMM , YYYY'));

  $('#reportrange').on('apply.daterangepicker', function(ev, picker)
    // funcao que detecta mudanca de data
{
    startdate=picker.startDate.format('YYYY-MM-DD');
    enddate=picker.endDate.format('YYYY-MM-DD');

    $('#reportrange span').val(startdate + ' - ' + enddate);
 
    alert(startdate+" ---- "+enddate);
 
 
});


    }
    $('#reportrange').daterangepicker({
        startDate: dataInicio,
        endDate: dataFim,
        ranges: {
           'Hoje': [moment(), moment()],
           'Ontem': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Últimos 7 dias': [moment().subtract(6, 'days'), moment()],
           'Últimos 30 dias': [moment().subtract(29, 'days'), moment()],
           'Este mês': [moment().startOf('month'), moment().endOf('month')],
           'Mês passado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
           'Neste ano': [moment().subtract(7, 'month').startOf('month'), moment().add(4, 'month').startOf('month')]

        },

"locale": {
    "format": "DD/MM/YYYY",
    "separator": " à ",
    "applyLabel": "Aplicar",
    "cancelLabel": "Cancelar",
    "customRangeLabel": "Outro"
  },



    }, cb);

    cb(dataInicio, dataFim);

// datas

// validar datas de registro



// fim validar

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
      

    var idnum = parametroUrl("numero");

 if (idnum != null) { // caso nao esteja vazia, é porque há um parametro. e irá buscar.
    table.rows().search(idnum, true, true).draw();
                }

    else{ // sem parametro
        table.rows().search('').draw();

                }






table.on('click','#movConteiners',function(){
   $tr=$(this).closest('tr');

      var data = table.row($tr).data();

    var id = data[0];
location.href="conteiners.php?numero="+id;
     });



// fim parametros


 

//lida com o form Editar

$('#formEdit').on('submit', function(e){

  e.preventDefault();


var editId =$('#editId').val();
var edittipo = $('#editTipo').val();
var editdatainicio = $('#editDataI').val();
var editdatafim = $('#editDataF').val();

 $.ajax({
        url: '../controllers/data/movimentacoes/editMov.php',
        type: 'post',
        data: {id:editId,
             tipo: edittipo,
               dInicio: editdatainicio,
               dFim: editdatafim
                },
        dataType: 'text',
        success:function(response){

  toastr.success('Dados alterados!');
  table.ajax.reload();
    $('#editMov').modal('hide');

                 },

                 error:function(response){

  toastr.error('Erro ao editar!');
                 }





        });



      });




// lida com o formulario do modal Registrar

  $('#formCriar').on('submit',function(e) {
     

e.preventDefault();

var id =$('#regID').val();
var cliente = $('#regCliente').val();

var tipo = $('#regTipo').val();
var datainicio = $('#regDataInicio').val();
var datafim = $('#regDataFim').val();
var categoria = $('#regCategoria').val();

if($("#regDataInicio").val() > $("#regDataFim").val()) {
$("#regDataFim").addClass("error");
  return FALSE;

  // 

}

 $.ajax({
        url: '../controllers/data/movimentacoes/createMov.php',
        type: 'post',
        data: {id:id,
          cliente: cliente,
               tipo: tipo,
               dInicio: datainicio,
               dFim: datafim,
               categoria: categoria
                },
        dataType: 'text',
        success:function(response){

  toastr.success('Dados registrados!');
  table.ajax.reload();
    $('#registrarMov').modal('hide');
$("#formCriar")[0].reset();

                 },

                 error:function(response){

  toastr.error('Erro ao registrar!');
                 }





        });



      });






 /// lida com evento de clique do botao Editar na tabela
 /// puxa os dados da linha e salva numa array, e insere os dados nos inputs da modal

     table.on('click','#movEditar',function(){

      $tr=$(this).closest('tr');

      var data = table.row($tr).data();

$('#editId').val(data[0]);
$('#editTipo').val(data[2]);
$('#editDataI').val(data[3]);
$('#editDataF').val(data[4]);



// pega o ID do conteiner e abre modal de verificacao
    $('#editMov').modal('show');
    });



// aqui executa o ajax ao abrir o modal, e pega containers não registrados 

// Basicamente, ele executa um query SQL que busca TODOS os conteiners na tabela Conteiners
// que nao estao listadas na tabela movimentos, isto é, sem registro.
//  e retorna em JSON, no qual o AJAX atribui nas options no select do registrar.

$("#registrar").on('click',function(){


 $.ajax({
        url: '../controllers/data/movimentacoes/getMovs.php',
        type: 'get',
        dataType: 'json',
        success:function(response){ 

          var len = response.length

                $("#regID").empty();
                $("#regCliente").empty();
                $("#regID").append("<option selected hidden disabled>Selecione um conteiner</option>");


                for( var i = 0; i<=len; i++){
                    var id = response[i][0];
                    $("#regID").append("<option value='"+id+"'>"+id+"</option>");

                }




                 },

                 error:function(response){

  toastr.error('Erro em buscar dados!');
                 }





        });

});



$("#regID").on('change',function(){

var movid = $(this).val();
 $.ajax({
        url: '../controllers/data/movimentacoes/getMovCliente.php',
        type: 'post',
        data: {idf:movid},
        dataType: 'json',
        success:function(response){ 

          var len = response.length

                $("#regCliente").empty();


                for( var i = 0; i<=len; i++){
                    var cliente = response[i][0];
                    var categoria = response[i][1];
                    $("#regCliente").val(cliente);
                    $("#regCategoria").val(categoria);
                }





                 },

                 error:function(response){

  toastr.error('Erro em buscar dados!');
                 }





        });



});
table.on('click', '#movExcluir', function(){

$tr=$(this).closest('tr');

var id = table.row($tr).data()[0];
$("#idDel").val(id);
$("#delMov").modal('show');


})


$("#formDel").on('submit',function(e){

e.preventDefault();

var getid = $('#idDel').val();


 $.ajax({
        url: '../controllers/data/movimentacoes/delMov.php',
        type: 'post',
        data: {id:getid},
        dataType: 'text',
        success:function(response){

toastr.success('Movimentação deletada!');
$("#delMov").modal('hide');
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
