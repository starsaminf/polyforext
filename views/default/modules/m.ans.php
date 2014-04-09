<?php
return "
<table border='1'class=''>
	<tbody>
		<tr>
			<th style='width:30%;' class='top'>Problem</th>
			<th style='width:20%;' class='top'>Lang</th>
			<th style='width:30%;' class='top'>Verdict</th>
			<th style='width:10%;' class='top'>Time</th>
			<th style='width:65;' class='top'>Memory</th>
		</tr>
		<tr class='highlighted-row'>
			<td class='bottom dark'>".$Pname."
			</td>
			<td class='bottom dark'>".$Plang."							
			</td>
			<td class='bottom dark'>".$Pverd."	
			</td>
			<td class='bottom dark'>".$Ptime."	
			</td>
			<td class='bottom dark'>".$Pmemo."	
			</td>
		</tr>
	</tbody>
</table>";
?>