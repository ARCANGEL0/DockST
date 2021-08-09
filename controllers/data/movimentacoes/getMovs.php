



 <?php 


require_once '../../movimentosController.php';
require_once '../../../models/movimento.php';

$fCon = new movimentosController();
   $results = $fCon->movimentos();
   if($results != null) { 


$re = $results->fetch_all();

echo json_encode($re); 


  }
   else {
    return FALSE;
   }

 ?>