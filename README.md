<div align="center">
<center><p><img src="https://cdn.iconscout.com/icon/free/png-256/dock-3173485-2650637.png"></img>

</center>
</div>

DockST -- Sistema CRUD 
================================

Este projeto foi desenvolvido como simulação de um sistema CRUD para logística portuária, seguindo os modelos MVC com uso do PDO.


### Funcionalidades

O projeto é um sistema web, acessível mediante autenticação de login, tendo disponível 2 páginas com tabelas interativas feitas com uso de modelos e controladores.
&nbsp;

##### Contêiners

> Registrar os contêiners e suas identificações
>
> Atribuir os contêiners à clientes específicos
>
> Determinar o tipo do contêiner, o seu status e a sua categôria

&nbsp;

##### Movimentos

> Controla todas as movimentações dos contêiners
>
> Listar agrupando por cliente, os processos em andamento dos conteiners
>
> Gerar relatórios com suma de importações e exportações, assim como demais dados


&nbsp;


### Uso 

Clone o repositório em seu local de preferência,
e edite os arquivos de configuração do Phinx e Datatables para seus
dados do banco de dados


    $ git clone https://github.com/ARCANGEL0/DockST.git 
    $ cd DockST
    $ nano phinx.php
    $ nano DockST/controllers/db/getConteiners.php
    $ nano DockST/controllers/db/getMovimentacoes.php



Depois, rode as migrações para gerar as tabelas e os dados na database que deseja.

    $ vendor/bin/phinx migrate -e DockST
    $ vendor/bin/phinx seed:run -e DockST
 
 Depois rode o servidor local na pasta raiz da forma que preferir.

 > $ php -S localhost:8000 -t . 

 &nbsp; ou 

 > $ symfony server:start

