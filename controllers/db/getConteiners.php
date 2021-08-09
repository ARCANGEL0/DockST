<?php
 

$sql_details = array(
    'user' => '', // usuario SQL
    'pass' => '', // senha SQL
    'db'   => 'DockST', // Banco de dados
    'host' => 'localhost'
);
 


$table = 'Conteiner'; // tabela
 
//chave primaria 

$primaryKey = 'Numero_Conteiner';
 
// dados das colunas
$columns = array(
    array( 'db' => 'Numero_Conteiner', 'dt' => 0 ),
    array( 'db' => 'Cliente',  'dt' => 1 ),
    array( 'db' => 'Tipo',   'dt' => 2 ),
    array( 'db' => 'Status',     'dt' => 3 ),
    array('db'  => 'Categoria', 'dt'  => 4)
);
 
require('../../plugins/datatables/ssp.class.php');


echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns)
);