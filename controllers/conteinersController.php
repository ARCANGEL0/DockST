<?php
if(!isset($_SESSION))
 {
 session_start();
 }


class conteinersController{

 public function inserir($id, $cliente, $tipo,$categoria,$status) {
 require_once '../../../models/conteiner.php';

 $conteiner = new conteiner();
 $conteiner->setId($id);
 $conteiner->setCliente($cliente);
 $conteiner->setTipo($tipo);
 $conteiner->setStatus($status);
 $conteiner->setCategoria($categoria);

 $r = $conteiner->inserirBD();

 return $r;
 }


 public function atualizar($oldId, $id, $cliente, $tipo,$categoria,$status) {
 require_once '../../../models/conteiner.php';
 $conteiner = new conteiner();
 $conteiner->setId($id);
 $conteiner->setOldId($oldId);
 $conteiner->setCliente($cliente);
 $conteiner->setTipo($tipo);
 $conteiner->setStatus($status);
 $conteiner->setCategoria($categoria);

 $r = $conteiner->atualizarBD();

 return $r;
 }

 public function atualizarMovimento($oldId, $id,$categoria,$cliente) {
 require_once '../../../models/conteiner.php';
 $conteiner = new conteiner();
 $conteiner->setId($id);
 $conteiner->setOldId($oldId);
 $conteiner->setCategoria($categoria);
 $conteiner->setCliente($cliente); 


 $r = $conteiner->atualizarMov();

 return $r;
 }

 public function remover($id) {
 require_once '../../../models/conteiner.php';
 $conteiner = new conteiner();
 $r = $conteiner->excluirBD($id);
 return $r;
 }

 public function removerMov($id) {
 require_once '../../../models/conteiner.php';
 $conteiner = new conteiner();
 $r = $conteiner->delMov($id);
 return $r;
 }


 public function getTipos()

 {

 $conteiner = new conteiner();

 return $results = $conteiner->fetchTipo();



 }


 public function getClientes()

 {

 $conteiner = new conteiner();

 return $results = $conteiner->fetchCliente();


 }


 public function getStatus()

 {

 $conteiner = new conteiner();

 return $results = $conteiner->fetchStatus();



 }


 public function getCategoria()

 {

 $conteiner = new conteiner();

 return $results = $conteiner->fetchCategoria();



 }
 public function count()

 {

 $conteiner = new conteiner();

 return $results = $conteiner->countConteiners();



 }


}
