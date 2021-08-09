<?php
 


$sql_details = array(
    'user' => '',    // usuario SQL
    'pass' => '', // senha SQL
    'db'   => 'DockST', // Banco de dados
    'host' => 'localhost'
);
 


$table = 'Movimentacoes'; // tabela
 
// chave primaria 

$primaryKey = 'FK_Numero_Conteiner';
 
// data das colunas
$columns = array(
    array( 'db' => 'FK_Numero_Conteiner', 'dt' => 0 ),
    array( 'db' => 'Cliente', 'dt' => 1 ),
    array( 'db' => 'Tipo_Movimentacao',  'dt' => 2 ),
    array( 'db' => 'Data_Inicio',   'dt' => 3 ),
    array( 'db' => 'Data_Fim',     'dt' => 4 ),
    array( 'db' => 'Categoria',     'dt' => 5 ),

);
 


require('../../plugins/datatables/ssp.class.php');


echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns)
);