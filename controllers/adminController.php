<?php
if(!isset($_SESSION))
 {
 session_start();
 }
class adminController {

public function login($usuario, $senha)
 {
 	
 $admin = new administrador();
 $admin->carregarUsuario($usuario);
 if($admin->getSenha() == $senha)
 {
 $_SESSION['admin'] = serialize($admin);
 return true;
 }
 else
 {
 return false;
 }
 }

}
?>