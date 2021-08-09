
<?php

class movimento{


	private $id;
	private $cliente;
	private $tipo;
	private $dinicio;
	private $dfim;
	private $categoria;


public function setID($id)
{
	$this->id = $id;

}
public function getID()
{
	return $this->id;
}



public function setTipo($tipo)
{
	$this->tipo = $tipo;

}
public function getTipo()
{
	return $this->tipo;
}

public function setCliente($cliente)
{
	$this->cliente = $cliente;

}
public function getCliente()
{
	return $this->cliente;
}


public function setDataInicio($dinicio)
{
	$this->dinicio = $dinicio;

}
public function getDataInicio()
{
	return $this->dinicio;
}



public function setDataFim($dfim)
{
	$this->dfim = $dfim;

}
public function getDataFim()
{
	return $this->dfim;
}
public function setCategoria($categoria)
{
	$this->categoria = $categoria;

}
public function getCategoria()
{
	return $this->categoria;
}





public function inserirBD()
{

	require_once 'db.php';

	$objectCon = new db();
	$conn = $objectCon->conectar();
	if($conn->connect_error){
		die("Connection error: ". $conn->connect_error);
	}


	$sql = "INSERT INTO Movimentacoes (FK_Numero_Conteiner,Cliente, Tipo_Movimentacao, Data_Inicio, Data_Fim, Categoria)
	VALUES ('".$this->id."','".$this->cliente."' ,'".$this->tipo."','".$this->dinicio."','".$this->dfim."','".$this->categoria."')";

	if($conn->query($sql) === TRUE) {
		$this->id = mysqli_insert_id($conn);
		$conn->close();
		return TRUE;
	}
	else {
		$conn->close();
		return FALSE;
	}
}



public function atualizarBD()
{

	require_once 'db.php';

	$objectCon = new db();
	$conn = $objectCon->conectar();
	if($conn->connect_error){
		die("Connection error: ". $conn->connect_error);
	}


$sql = "UPDATE  Movimentacoes SET FK_Numero_Conteiner = '".$this->id."', Tipo_Movimentacao ='".$this->tipo."', Data_Inicio='".$this->dinicio."', Data_Fim='".$this->dfim."' WHERE FK_Numero_Conteiner ='".$this->id."';";


	if($conn->query($sql) === TRUE) {
		$this->id = mysqli_insert_id($conn);
		$conn->close();
		return TRUE;
	}
	else {
		$conn->close();
		return false;
	}
}






public function excluirBD($id) 
{

	require_once 'db.php';

	$objectCon = new db();
	$conn = $objectCon->conectar();
	if($conn->connect_error){
		die("Connection error: ". $conn->connect_error);
	}


	$sql = "DELETE FROM Movimentacoes WHERE FK_Numero_Conteiner ='".$id."';";

	if($conn->query($sql) === TRUE) {
		$this->id = mysqli_insert_id($conn);
		$conn->close();
		return TRUE;
	}
	else {
		$conn->close();
		return FALSE;
	}
}



public function listamovimentos()
{

	require_once 'db.php';

	$objectCon = new db();
	$conn = $objectCon->conectar();
	if($conn->connect_error){
		die("Connection error: ". $conn->connect_error);
	}


	$sql = "SELECT Conteiner.Numero_Conteiner FROM Conteiner LEFT OUTER JOIN Movimentacoes ON (Conteiner.Numero_Conteiner = Movimentacoes.FK_Numero_Conteiner) WHERE Movimentacoes.FK_Numero_Conteiner IS NULL";

	$re = $conn->query($sql);
	$conn->close();
	return $re;

}




public function fetchCliente()
{

	require_once 'db.php';

	$objectCon = new db();
	$conn = $objectCon->conectar();
	if($conn->connect_error){
		die("Connection error: ". $conn->connect_error);
	}


	$sql = "SELECT Conteiner.Cliente, Conteiner.Categoria FROM Conteiner WHERE Conteiner.Numero_Conteiner = '".$this->id."';";

	$re = $conn->query($sql);
	$conn->close();
	return $re;

}



public function fetchTipos()
{

	require_once 'db.php';

	$objectCon = new db();
	$conn = $objectCon->conectar();
	if($conn->connect_error){
		die("Connection error: ". $conn->connect_error);
	}


	$sql = "SELECT DISTINCT Tipo_Movimentacao FROM Movimentacoes;";

	$re = $conn->query($sql);
	$conn->close();
	return $re;

}

public function fetchClienteTotais()
{

	require_once 'db.php';

	$objectCon = new db();
	$conn = $objectCon->conectar();
	if($conn->connect_error){
		die("Connection error: ". $conn->connect_error);
	}


	$sql = "SELECT DISTINCT Cliente FROM Movimentacoes;";

	$re = $conn->query($sql);
	$conn->close();
	return $re;

}


public function countMovimentos()
{

	require_once 'db.php';

	$objectCon = new db();
	$conn = $objectCon->conectar();
	if($conn->connect_error){
		die("Connection error: ". $conn->connect_error);
	}


	$sql = "SELECT COUNT(*) FROM Movimentacoes;";

	$re = $conn->query($sql);
	$conn->close();
	return $re;

}



}

?>
