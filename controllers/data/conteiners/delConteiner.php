<?php 


require_once '../../conteinersController.php';
require_once '../../../models/conteiner.php';
 $cControl = new conteinersController();

$id = $_POST["id"];

 if($cControl->remover($id) && $cControl->removerMov($id))
 {

 return TRUE;
 }

 else
 {

 return FALSE;
}


 ?>