<?php
/**
 * @abstract el controlador
 * @autor Samuel Loza <starsaminf@gmail.com>
 * @version V1.0
 * 
 */
require 'modelo/cf.class.php';

class mvc_controller {
/**
 * @abstract Muestra la pagina html
 */
private function view_page($html){
  echo $html;
}
  /**
 * @abstract CArga el template
 */
  function load_template($title='Sin Titulo'){
    $pagina = $this->load_page('views/default/page.php');    
    return $pagina;
  }
  /**
 * @abstract carga la pagina esqueleto
 */
  private function load_page($page){
    return file_get_contents($page);
  }
  /**
 * @abstract preg_replace($patrones, $sustituciones, $cadena);
 */
  private function replace_content($in, $out,$pagina){
   return preg_replace($in, $out, $pagina);
 }
 /**
 * @abstract Lista los problemas seleccionados de un periodo x
 */
 function listproblems($inde,$periodo){
  $cf = new cf();
  $pagina = $this->load_template('- Lista  problemas - ');
  ob_start();
  $tsArray = $cf -> numpro($periodo);
  $problem = $cf -> problem($inde,$periodo);

  if($tsArray!=''){
    $buscador=include 'views/default/modules/m.listproblems.php';
    $table = ob_get_clean();
    $idg= $cf->idgym();
    $table="
    <form name='send' method='POST' action='submit.php'>
     <input type='hidden' name='inde' value='$inde'>
     <input type='hidden' name='per' value='$idg'>
     <input type='submit'>
   </div>
 </form>";

 $pagina = $this->replace_content('/\#NAVLIST\#/ms',$buscador.$table , $pagina);
 $pagina = $this->replace_content('/\#HEADER\#/ms',"" , $pagina);  
 $pagina = $this->replace_content('/\#NEWS\#/ms',"" , $pagina);

 $buscador = include 'views/default/modules/m.printproblem.php';
 $table = ob_get_clean();
 $pagina = $this->replace_content('/\#CENTERCONT\#/ms',$buscador.$table , $pagina);

}else{
 $pagina = $this->replace_content('/\#NAVLIST\#/ms' ,$periodo.' '.$periodo.'<h1>Combinacion invalida <//h1>' , $pagina);
}
$this->view_page($pagina);
}

/**
 * @abstract Envia y muestra el resultado del veredicto :D
 */
function sendf($inde,$gym,$proglang,$code){
  require 'views/default/modules/m.send.php';

  $sendcf = new conectar();
  if($sendcf -> Cflogin()==0 &&$sendcf->setlang($proglang,$inde)==0 &&$sendcf->SendCode($code,$gym)==0){
    $pagina = $this->load_template('- Enviar CODIGO - ');
    $header=$this->load_page('views/default/sections/sa.header.php');
    $pagina =$this->replace_content( '/\#HEADER\#/ms',$header,$pagina);
    $pagina =$this->replace_content( '/\#NAVLIST\#/ms',"",$pagina);
    $pagina =$this->replace_content( '/\#NEWS\#/ms',"",$pagina);



    ob_start();

    $Pname=$sendcf->getPname();
    $Plang=$sendcf->getPlang($proglang);
    $Pverd=$sendcf->getPverd();
    $Ptime=$sendcf->getPtime();  
    $Pmemo=$sendcf->getPmemo();  


    $buscador = include "views/default/modules/m.ans.php";
    $code=$sendcf->printans();
    $pagina =  $this->replace_content('/\#CENTERCONT\#/ms' ,'Tu solucion se envio correctamente y este es el veredicto <br> '.$buscador.'<br>'.$code, $pagina);
    $this->view_page($pagina);
    
    echo " Gracias vuelva pronto ";
  }else{
    echo "Hola :D";
  }
  /* Elimina cookie */
  if(file_exists(getcwd().'/cof'))unlink(getcwd().'/cof');

}
/**
 * @abstract Evia el codigo a  Codeforces
 */
function sendc($inde,$gym){
  $cf = new cf();
  $pagina = $this->load_template('- Enviar CODIGO - ');
  $header=$this->load_page('views/default/sections/sa.header.php');
  $pagina =$this->replace_content( '/\#HEADER\#/ms',$header,$pagina);
  // function numpro($periodo){

  $tsArray = $cf -> numprogym($gym);
  $idg= $cf->idgym();
  $periodo=$idg;
  $reg['inde']=$idg;

  $listar=include 'views/default/modules/m.listproblems.php';

  $pagina = $this->replace_content('/\#NAVLIST\#/ms',$listar , $pagina);
  $buscador = include "views/default/modules/m.fsend.php";

  $new=$this->load_page('views/default/modules/m.news.php');
  $pagina = $this->replace_content('/\#NEWS\#/ms' ,$new , $pagina);


  $pagina =  $this->replace_content('/\#CENTERCONT\#/ms' ,$buscador, $pagina);

  $this->view_page($pagina);
}
/**
 * @abstract Muestra todos los problemas
 */

function principal(){
  $pagina=$this->load_template(' Pagina Principal MVC ');
  $pagina = $this->replace_content('/\#NAVLIST\#/ms' ,"" , $pagina);
  
  $header=$this->load_page('views/default/sections/sa.header.php');
  $pagina =$this->replace_content( '/\#HEADER\#/ms',$header,$pagina);
  
  $html = include 'views/default/modules/m.principal.php';
  $pagina = $this->replace_content('/\#CENTERCONT\#/ms' ,$html , $pagina);
  $new=$this->load_page('views/default/modules/m.news.php');
  $pagina = $this->replace_content('/\#NEWS\#/ms' ,$new , $pagina);
  
  $this->view_page($pagina);

}

}
?>