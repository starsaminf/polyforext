<?php
/**
 * @abstract Lista los problemas de un periodo x
 * @autor Samuel Loza <starsaminf@gmail.com>
 * @version V1.0
 * 
 */

$dat='<form method="GET" action="index.php" name="s2" id="s2">';
foreach ($tsArray as $reg) {
	$dat.= "<input type = 'radio' name = 'inde' id='";
	$dat.= $reg['inde']."' ";
	$dat.= "value = '";
	$dat.= $reg['inde']."-".$periodo."'checked = 'checked' onclick='document.s2.submit()'/>".$reg['inde'];
}
$dat.='</form>';
return $dat;
?>