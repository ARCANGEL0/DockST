
<?php

class conteiner{


	private $id;
	private $oldid;
	private $cliente;
	private $tipo;
	private $status;
	private $categoria;


public function setID($id)
{
	$this->id = $id;

}
public function getID()
{
	return $this->id;
}

public function setOldID($oldid)
{
	$this->oldid = $oldid;

}
public function getOldID()
{
	return $this->oldid;
}


public function setCliente($cliente)
{
	$this->cliente = $cliente;

}
public function getCliente()
{
	return $this->cliente;
}

public function setTipo($tipo)
{
	$this->tipo = $tipo;

}
public function getTipo()
{
	return $this->tipo;
}


public function setStatus($status)
{
	$this->status = $status;

}
public function getStatus()
{
	return $this->status;
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


	$sql = "INSERT INTO Conteiner (Numero_Conteiner, Cliente, Tipo, Status, Categoria)
	VALUES ('".$this->id."', '".$this->cliente."','".$this->tipo."','".$this->status."','".$this->categoria."')";

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


	$sql = "UPDATE Conteiner SET Numero_Conteiner = '".$this->id."', Cliente ='".$this->cliente."', Tipo='".$this->tipo."',Status='".$this->status."',Categoria='".$this->categoria."' where Numero_Conteiner
= '".$this->oldid."';";

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


public function atualizarMov()
{

	require_once 'db.php';

	$objectCon = new db();
	$conn = $objectCon->conectar();
	if($conn->connect_error){
		die("Connection error: ". $conn->connect_error);
	}


	$sql = "UPDATE Movimentacoes SET FK_Numero_Conteiner = '".$this->id."',Movimentacoes.Cliente='".$this->cliente."', Movimentacoes.Categoria='".$this->categoria."' WHERE FK_Numero_Conteiner = '".$this->oldid."';";

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



public function excluirBD($id)
{

	require_once 'db.php';

	$objectCon = new db();
	$conn = $objectCon->conectar();
	if($conn->connect_error){
		die("Connection error: ". $conn->connect_error);
	}


	$sql = "DELETE FROM Conteiner WHERE Numero_Conteiner ='".$id."';";

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


public function delMov($id)
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



public function fetchTipo()
{

	require_once 'db.php';

	$objectCon = new db();
	$conn = $objectCon->conectar();
	if($conn->connect_error){
		die("Connection error: ". $conn->connect_error);
	}


	$sql = "SELECT DISTINCT Tipo FROM Conteiner;";

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


	$sql = "SELECT DISTINCT Cliente FROM Conteiner;";

	$re = $conn->query($sql);
	$conn->close();
	return $re;

}

public function fetchStatus()
{

	require_once 'db.php';

	$objectCon = new db();
	$conn = $objectCon->conectar();
	if($conn->connect_error){
		die("Connection error: ". $conn->connect_error);
	}


	$sql = "SELECT DISTINCT Status FROM Conteiner;";

	$re = $conn->query($sql);
	$conn->close();
	return $re;

}


public function fetchCategoria()
{

	require_once 'db.php';

	$objectCon = new db();
	$conn = $objectCon->conectar();
	if($conn->connect_error){
		die("Connection error: ". $conn->connect_error);
	}


	$sql = "SELECT DISTINCT Categoria FROM Conteiner;";

	$re = $conn->query($sql);
	$conn->close();
	return $re;

}




public function countConteiners()
{

	require_once 'db.php';

	$objectCon = new db();
	$conn = $objectCon->conectar();
	if($conn->connect_error){
		die("Connection error: ". $conn->connect_error);
	}


	$sql = "SELECT COUNT(*) FROM Conteiner;";

	$re = $conn->query($sql);
	$conn->close();
	return $re;

}

}

?>
