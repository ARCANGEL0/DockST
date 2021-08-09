<?php 


require_once '../../movimentosController.php';
require_once '../../../models/movimento.php';
 $cControl = new movimentosController();

$id = $_POST["id"];
$tipo = $_POST["tipo"];
$dinicio = $_POST["dInicio"];
$dfim = $_POST["dFim"];

 if($cControl->atualizar($id, $tipo, $dinicio, $dfim))
 {

 return TRUE;
 }

 else
 {

 return FALSE;
}


 ?>