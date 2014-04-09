<?php
/**
 * @abstract Modelo para la conex con la bd
 * @autor Samuel Loza <starsaminf@gmail.com>
 * @version V1.0
 * 
 */
require_once "db.class.php";

class cf extends database {
  /** @abstract guarda el id gym o el periodo  
  */
  public $gym;
  /**
  * @abstract Retorna vector con los indices(A,B,C,D,..,etc) de los problemas
  * ordenados A - Z, de algun periodo $periodo="1432-2011"  
  */
  function numpro($periodo){
    $this->conectar();
    $query = $this->consulta("SELECT inde FROM problemas WHERE periodo='$periodo' ORDER BY inde");
    $this->disconnect();
    if($this->numero_de_filas($query)> 0) {
      while ( $tsArray = $this->fetch_assoc($query) ){
        $data[] = $tsArray;
      }
      return $data;
    }else{
     return '';
   }
 }
 /**
  * @abstract Retorna vector con los indices(A,B,C,D,..,etc) de los problemas
  * ordenados A - Z, del  idgym codeforces 
  */

 function numprogym($idgym){
  $this->conectar();
  $query = $this->consulta("SELECT id,inde,periodo FROM problemas WHERE id='$idgym' ORDER BY inde");
  $this->disconnect();
  if($this->numero_de_filas($query)> 0) {
    while ( $tsArray = $this->fetch_assoc($query) ){
      $data[] = $tsArray;
      $this->gym=$tsArray['periodo'];
    }
    return $data;
  }else{
   return '';
 }
}
/**
  * @abstract Retorna un vector con el problema de algun x periodo
  * ordenados A - Z, del  idgym codeforces 
  */
function problem($inde,$periodo){
  $this->conectar();
  $query = $this->consulta("SELECT * FROM  problemas WHERE periodo = '$periodo' AND inde='$inde'");
  $this->disconnect();
  if($this->numero_de_filas($query) > 0 ){
    $ans=$this->fetch_assoc($query);
    $this->gym=$ans['id'];
    return  $ans;
  }else{
    return '';
  }
}
/**
  * @abstract retorna gym id o gym periodo o periodo
  * 
  */

function idgym(){
  if(strlen($this->gym) >=6 &&strlen($this->gym) <=6 || strlen($this->gym)>=8){
    echo " ".$this->gym;
    return $this->gym;
  }else{
    return '';
  }
}
}

?>