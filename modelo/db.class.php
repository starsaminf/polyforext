<?php
/*
CLASE PARA LA CONEXION Y LA GESTION DE LA BD
*/
class database {
 private $conexion;

 /* METODO PARA CONECTAR CON LA BASE DE DATOS*/
 public function conectar(){
  if(!isset($this->conexion)){
    $this->conexion = (mysql_connect("dbhost","dbuser","dbpass")) or die(mysql_error());
    mysql_select_db("dbname",$this->conexion) or die(mysql_error());
  }
} 

  /* METODO PARA REALIZAR UNA CONSULTA 
 */
 public function consulta($sql){
  $resultado = mysql_query($sql,$this->conexion);
  if(!$resultado){
   echo 'MySQL Error: ' . mysql_error();
   exit;
 }
 return $resultado;
}

 /*METODO PARA CONTAR EL NUMERO DE RESULTADOS
 */
 function numero_de_filas($result){
  if(!is_resource($result)) return false;
  return mysql_num_rows($result);
}

 /*METODO PARA CREAR ARRAY DESDE UNA CONSULTA
 */
 function fetch_assoc($result){
  if(!is_resource($result)) return false;
  return mysql_fetch_assoc($result);
}

/* METODO PARA CERRAR LA CONEXION A LA BASE DE DATOS */
public function disconnect(){
  /*
  No es necesario ya que se desconecta solo 
  */
  //mysql_close();

}

}
?>
