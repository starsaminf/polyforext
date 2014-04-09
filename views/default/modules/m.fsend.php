<?php
/**
 * @abstract Formulario para el envio del problema
 * @autor Samuel Loza <starsaminf@gmail.com>
 * @version V1.0
 * 
 * $gym  -> ID del mashup en codeforces
 * $inde -> ID del problema 
 * gym = 200; inde = A  
 */

	return " 
	<article>
		<div id='bloqueform'>
			<form action='submit.php' method='POST'>
				<input type='hidden' name='gym' value=".$gym." >
				<input type='hidden' name='id'  value=".$inde." >
				<select style='width: 300px;' name='programlang'>
					<option value='10'>GNU C 4</option>
					<option value='1'>GNU C++ 4.7</option>
					<option value='16'>GNU C++0x 4</option>
					<option value='2'>Microsoft Visual C++ 2010</option>
					<option value='9'>C# Mono 2.10</option>
					<option value='29'>MS C# .NET 4</option>
					<option value='28'>D DMD32 Compiler v2</option>
					<option value='32'>Go 1.2</option>
					<option value='12'>Haskell GHC 7.6</option>
					<option value='5'>Java 6</option>
					<option value='23'>Java 7</option>
					<option value='19'>OCaml 4</option>
					<option value='3'>Delphi 7</option>
					<option value='4'>Free Pascal 2</option>
					<option value='13'>Perl 5.12</option>
					<option value='6'>PHP 5.3</option>
					<option value='7'>Python 2.7</option>
					<option value='31'>Python 3.3</option>
					<option value='8'>Ruby 2</option>
					<option value='20'>Scala 2.10</option>
					<option value='34'>JavaScript V8 3</option>
					<option value='14'>ActiveTcl 8.5</option>
					<option value='15'>Io-2008-01-07 (Win32)</option>
					<option value='17'>Pike 7.8</option>
					<option value='18'>Befunge</option>
					<option value='22'>OpenCobol 1.0</option>
					<option value='25'>Factor</option>
					<option value='26'>Secret_171</option>
					<option value='27'>Roco</option>
					<option value='33'>Ada GNAT 4.7</option>
				</select>
				<br>

				<textarea placeholder='Copia tu codigo' name='codigo' style='width: 65%; height: 70%;'></textarea>
				<br/>
				<input type='submit'>
			</form>	

		</div>
	</article>
	";
	?>