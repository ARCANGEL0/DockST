<?php 


require_once '../../conteinersController.php'; 
require_once '../../../models/conteiner.php';
require_once '../../movimentosController.php';
require_once '../../../models/movimento.php';

 $cControl = new conteinersController();

$id = $_POST["id"]; 
$cliente = $_POST["cliente"];
$tipo = $_POST["tipo"];
$status = $_POST["status"];
$categoria = $_POST["categoria"];
$oldId = $_POST["oldId"];

 if($cControl->atualizar($oldId, $id, $cliente, $tipo, $categoria, $status) && $cControl->atualizarMovimento($oldId,$id,$categoria, $cliente))
 {

 return TRUE;
 }

 else
 {

 return FALSE;
}


 ?>