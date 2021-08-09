<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class TableMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {

     
$movimentacoes = $this->table('Movimentacoes', array('id' => false, 'primary_key' => 'FK_Numero_Conteiner'));
        $movimentacoes->addColumn('FK_Numero_Conteiner', 'string')
              ->addColumn('Cliente', 'string')
              ->addColumn('Tipo_Movimentacao', 'string', ['limit' => 50])
              ->addColumn('Data_Inicio', 'date')
              ->addColumn('Data_Fim', 'date')
            ->addColumn('Categoria', 'string', ['limit'=>50])
              ->addIndex('FK_Numero_Conteiner', ['unique' => true])
              ->create();



    $conteiner = $this->table('Conteiner', array('id' => false, 'primary_key' => 'Numero_Conteiner'));
        $conteiner->addColumn('Numero_Conteiner', 'string')
              ->addColumn('Cliente', 'string', ['limit' => 255])
              ->addColumn('Tipo', 'string', ['limit'=>20])
              ->addColumn('Status', 'string', ['limit'=>20])
              ->addColumn('Categoria', 'string', ['limit'=>50])
              ->addIndex('Numero_Conteiner', ['unique' => true])
              ->create();


    $login = $this->table('Login', array('id' => false, 'primary_key' => 'usuario'));
        $login->addColumn('usuario', 'string', ['limit' => 255])
              ->addColumn('senha', 'string', ['limit' => 255])
              ->addIndex('usuario', ['unique' => true])
              ->create();
    }
}
