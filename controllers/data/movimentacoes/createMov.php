<?php 


require_once '../../movimentosController.php';
require_once '../../../models/movimento.php';
 $cControl = new movimentosController();

$id = $_POST["id"];
$cliente = $_POST["cliente"];
$tipo = $_POST["tipo"];
$dinicio = $_POST["dInicio"];
$dfim = $_POST["dFim"];
$categoria = $_POST["categoria"];

 if($cControl->inserir($id,$cliente, $tipo, $dinicio, $dfim, $categoria))
 {

 return TRUE;
 }

 else
 {

 return FALSE;
}


 ?>