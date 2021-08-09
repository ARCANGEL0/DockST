<?php 


require_once '../../movimentosController.php';
require_once '../../../models/movimento.php';
 $cControl = new movimentosController();

$id = $_POST["id"];


 if($cControl->remover($id))
 {

 return TRUE;
 }

 else
 {

 return FALSE;
}


 ?>