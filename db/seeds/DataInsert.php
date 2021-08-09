<?php


use Phinx\Seed\AbstractSeed;
use Cake\Utility\Security;

class DataInsert extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {


 $data = [
            ['usuario' => 'sysadmin', 'senha' => Security::hash('adminpassword', 'md5')] // aqui ele insere os dados na tabela Login, transformando a senha com hash MD5
        ];

        $this->table('Login')
            ->insert($data)
            ->save();
    }
}
