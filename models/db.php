
<?php 

Class db {
	
	private $maquina = "localhost";
	private $user = "root";
	private $password ="db140825";
	private $db = "DockST";


public function conectar()
{
	$conn = new mysqli($this->maquina, $this->user,$this->password, $this->db);
	return $conn;
}

}

 ?>