<?php 


require_once '../../conteinersController.php';
require_once '../../../models/conteiner.php';
 $cControl = new conteinersController();

$id = $_POST["id"];
$cliente = $_POST["cliente"];
$tipo = $_POST["tipo"];
$status = $_POST["status"];
$categoria = $_POST["categoria"];

 if($cControl->inserir($id, $cliente, $tipo, $categoria, $status))
 {

 return TRUE;
 }

 else
 {

 return FALSE;
}


 ?>