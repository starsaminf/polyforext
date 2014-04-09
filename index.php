<?php
/**
 * @abstract Index :D
 * @autor Samuel Loza <starsaminf@gmail.com>
 * @version V1.0
 * 
 */
require 'controller/mvc.controller.php';
$mvc = new mvc_controller();
if($_GET['option']){
	$mvc -> listproblems('A',$_GET['option']);
	echo "<script languaje='javacript'>
	document.getElementById('A').checked=true;
</script>
";
}else{
	if($_GET['inde'] && !$_POST['per']){
		$opti="";
		for($i=2;$i<strlen($_GET['inde']);$i++){
			$opti.=$_GET['inde'][$i];
		}
		$rr=$_GET['inde'][0];
		$mvc -> listproblems($rr,$opti);
		echo "
		<script languaje='javacript'>
			document.getElementById('$rr').checked=true;
		</script>
		";
	}else{
		if($_POST['inde']&&$_POST['per']){
			$mvc->sendf($_POST['inde'],$_POST['per']);
		}else{
			$mvc->principal();
		}
	}
}
?>