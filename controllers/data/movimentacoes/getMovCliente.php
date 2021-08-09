



 <?php 


require_once '../../movimentosController.php';
require_once '../../../models/movimento.php';


$id = $_POST["idf"];



$fCon = new movimentosController();
   $results = $fCon->getMovCliente($id);
   if($results != null) { 


$re = $results->fetch_all();

echo json_encode($re); 
 

  }
   else {
    return FALSE;
   }

 ?>