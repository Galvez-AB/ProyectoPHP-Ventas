<?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/ProyectoDSW/views/formAutenticarUsuario.php');   
    $objFormAutenticar = new formAutenticarUsuario();
	$objFormAutenticar -> formAutenticarUsuarioShow();
?>