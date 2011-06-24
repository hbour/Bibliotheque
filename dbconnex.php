<?php
function connexobject($base, $param)
{
	include_once($param.".php");
	$idcom = new mysqli(MYHOST,MYUSER,MYPASS,$base);
	if(!$idcom) {
		echo "Erreur de connection à la base de données.";
		exit();
	}
	return $idcom;
}