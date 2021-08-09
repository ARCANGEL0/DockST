<?php
if(!isset($_SESSION))
 {
 session_start();
 }


class movimentosController{

 public function inserir($id,$cliente, $tipo,$dinicio,$dfim,$categoria) {
 require_once '../../../models/movimento.php';

 $movimento = new movimento();
 $movimento->setId($id);
 $movimento->setCliente($cliente);
 $movimento->setTipo($tipo);
 $movimento->setDataInicio($dinicio);
 $movimento->setDataFim($dfim);
 $movimento->setCategoria($categoria);

 $r = $movimento->inserirBD();

 return $r;
 }


 public function atualizar($id, $tipo,$dinicio,$dfim) {
 require_once '../../../models/movimento.php';
 $movimento = new movimento();
 $movimento->setId($id);
 $movimento->setTipo($tipo);
 $movimento->setDataInicio($dinicio);
 $movimento->setDataFim($dfim);
 $r = $movimento->atualizarBD();

 return $r;
 }



 public function remover($id) {
 require_once '../../../models/movimento.php';
 $movimento = new movimento();
 $r = $movimento->excluirBD($id); 
 return $r;
 }

  public function getMovCliente($id)
 {

 $movimento = new movimento();
 $movimento->setId($id);

 $r = $movimento->fetchCliente();
 return $r;



 }
 public function movimentos()
 {

 $movimento = new movimento();

 return $results = $movimento->listamovimentos();



 }


 public function getTipos()
 {

 $movimento = new movimento();

 return $results = $movimento->fetchTipos(); 



 }

  public function getClientes()
 {

 $movimento = new movimento();

 return $results = $movimento->fetchClienteTotais(); 



 }

 

 public function count()
 {

 $movimento = new movimento();

 return $results = $movimento->countMovimentos();



 }


}
