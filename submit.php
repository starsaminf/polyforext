<?php
/**
 * @abstract Prepara el envio del codigo al mashup en codeforces
 * @autor Samuel Loza <starsaminf@gmail.com>
 * @version V1.0
 * 
 */
require 'controller/mvc.controller.php';
$mvc = new mvc_controller();
if((!$_POST['inde']&&!$_POST['per']) && ($_POST['gym']&&$_POST['id']&&$_POST['programlang']&&$_POST['codigo'])){
	//si todo ook listo par a enviar
	echo "<br> 1 <br>";
	$mvc->sendf($_POST['id'],$_POST['gym'],$_POST['programlang'],$_POST['codigo']);
}else{
	
	//next update
	if(($_POST['inde']&&$_POST['per']) && (!$_POST['gym']&&!$_POST['id']&&!$_POST['programlang']&&!$_POST['codigo'])){
		echo " <br> 2 <br>";
		$mvc->sendc($_POST['inde'],$_POST['per']);
		
	}else{
		/*
			Send manualmente
		*/
		}
	}
	?>	