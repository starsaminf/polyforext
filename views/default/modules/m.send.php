<?php
/**
 * @abstract SE encarga de enviar y recibir los resultados de codefroces
 * @autor Samuel Loza <starsaminf@gmail.com>
 * @version V1.0
 * 
 */

class conectar{
	public $url="";
	public $elements="";
	public $nlang="";
	public $submittedP;
	public $vec;
	public $idgym;
	public $Pname;
	public $Plang;
	public $Pverd;
	public $Ptime;
	public $Pmemo;
	function __construct(){
		$user="usercodeforces";
		$pas="passcodeforces";
		$token="8feb9cg550h2f69a6c60a39a0272de35";
		$tta="60";
		$this->url = "http://codeforces.com/enter";
		$this->elements="csrf_token=".$token."&action=enter&handle=".$user."&password=".$pas."&_tta=".$tta;
	}
	function setlang($lang,$pindex){
		$this->vec=array("10"=>"GNU C 4",
			"1" =>"GNU C++ 4.7",
			"16"=>"GNU C++0x 4",
			"2"=>"Microsoft Visual C++ 2010",
			"9"=>"C# Mono 2.10",
			"29"=>"MS C# .NET 4",
			"28"=>"D DMD32 Compiler v2",
			"32"=>"Go 1.2",
			"12"=>"Haskell GHC 7.6",
			"5"=>"Java 6",
			"23"=>"Java 7",
			"19"=>"OCaml 4",
			"3"=>"Delphi 7",
			"4"=>"Free Pascal 2",
			"13"=>"Perl 5.12",
			"6"=>"PHP 5.3",
			"7"=>"Python 2.7",
			"31"=>"Python 3.3",
			"8"=>"Ruby 2",
			"20"=>"Scala 2.10",
			"34"=>"JavaScript V8 3",
			"14"=>"ActiveTcl 8.5",
			"15"=>"Io-2008-01-07 (Win32)",
			"17"=>"Pike 7.8",
			"18"=>"Befunge",
			"22"=>"OpenCobol 1.0",
			"25"=>"Factor",
			"26"=>"Secret_171",
			"27"=>"Roco",
			"33"=>"Ada GNAT 4.7");

		if(isset($this->vec[$lang])){
			$vec2=array("10"=>"GNU C 4",
				"GNU C++ 4.7"=>"1",
				"GNU C++0x 4"=>"16",
				"Microsoft Visual C++ 2010"=>"2",
				"C# Mono 2.10"=>"9",
				"MS C# .NET 4"=>"29",
				"D DMD32 Compiler v2"=>"28",
				"Go 1.2"=>"32",
				"Haskell GHC 7.6"=>"12",
				"Java 6"=>"5",
				"Java 7"=>"23",
				"OCaml 4"=>"19",
				"Delphi 7"=>"3",
				"Free Pascal 2"=>"4",
				"Perl 5.12"=>"13",
				"PHP 5.3"=>"6",
				"Python 2.7"=>"7",
				"Python 3.3"=>"31",
				"Ruby 2"=>"8",
				"Scala 2.10"=>"20",
				"JavaScript V8 3"=>"34",
				"ActiveTcl 8.5"=>"14",
				"Io-2008-01-07 (Win32)"=>"15",
				"Pike 7.8"=>"17",
				"Befunge"=>"18",
				"OpenCobol 1.0"=>"22",
				"Factor"=>"25",
				"Secret_171"=>"26",
				"Roco"=>"27",
				"Ada GNAT 4.7"=>"33");
			$this->nlang=$vec2[$this->vec[$lang]];
		}else {
			exit("Id malo");
		}
		$this->submittedP=$pindex;	
	}

	function Cflogin(){
		$handler = curl_init();  
		curl_setopt($handler, CURLOPT_URL, $this->url);
		curl_setopt($handler, CURLOPT_POST,true);  
		curl_setopt($handler, CURLOPT_POSTFIELDS, $this->elements);  
		curl_setopt($handler, CURLOPT_COOKIEJAR,getcwd().'/cof');
		curl_setopt($handler, CURLOPT_COOKIEFILE,getcwd().'/cof'); 
		curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($handler, CURLOPT_FRESH_CONNECT, true);
		curl_setopt($handler, CURLOPT_COOKIESESSION,getcwd().'/cof');
		curl_setopt($handler, CURLOPT_RETURNTRANSFER,1);
		$response = curl_exec ($handler);
		if(curl_errno($handler)){
			echo "Paso algo codigo=loguin :(";
				curl_close($handler);
				exit();
				return 1;
			}
			return 0;
		}


		function SendCode($code,$link){
			$this->idgym=$link;
			$code = urlencode($code);
			$codigo="";
			for($i=0;$i<strlen($code);$i++){
				if(($code[$i]=='%') && ($code[$i+1]=='2') && ($code[$i+2]=='A')){
					$codigo.="*";
					$i+=2;
				}else{
					$codigo.=$code[$i];
				}
			}
			
			$code=$codigo;
			$token="8feb9cg550h2f69a6c60a39a0272de35";
			$tta="60";
			$this->elements="";
			$this->elements="csrf_token=".$token."&action=submitSolutionFormSubmitted&submittedProblemIndex=".$this->submittedP."&programTypeId=".$this->nlang."&source=".$code."&_tta=".$tta;
			$handler = curl_init();  
			curl_setopt($handler, CURLOPT_URL, "http://codeforces.com/gym/".$link."/submit");
			curl_setopt($handler, CURLOPT_POST,true);  
			curl_setopt($handler, CURLOPT_POSTFIELDS, $this->elements);  
			curl_setopt($handler, CURLOPT_COOKIEJAR,getcwd().'/cof');
			curl_setopt($handler, CURLOPT_COOKIEFILE,getcwd().'/cof'); 
			curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($handler, CURLOPT_FRESH_CONNECT, true);
			curl_setopt($handler, CURLOPT_COOKIESESSION,getcwd().'/cof');
			curl_setopt($handler, CURLOPT_RETURNTRANSFER,1);
			$response = curl_exec ($handler);
			/*
			bug reparado :D
			Error reparar //You have submitted exactly the same code before
			*/
			curl_close($handler);
			echo "Espere a que termine de cargar todo :D .... :D<br>";
			sleep(20);
			$bus=strpos($response, "You have submitted exactly the same code before");
			if($bus){
				echo " UPS el codigo ya fue  enviado anteriormente ES COPIA.. :D ";
				exit();
				return 1;
			}
			if(curl_errno($handler)){
				echo "Paso algo al subir el code :(";
					exit();
					return 1;
				}else{
					$handler = curl_init(); 

					curl_setopt($handler, CURLOPT_URL,"http://codeforces.com/gym/".$link."/my" );
					curl_setopt($handler, CURLOPT_COOKIEJAR,getcwd().'/cof');
					curl_setopt($handler, CURLOPT_COOKIEFILE,getcwd().'/cof'); 
					curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($handler, CURLOPT_FRESH_CONNECT, true);
					curl_setopt($handler, CURLOPT_COOKIESESSION,getcwd().'/cof');
					curl_setopt($handler, CURLOPT_RETURNTRANSFER,1);
					$response = curl_exec ($handler);

					$this->name="";		$lang=$this->nlang;
					$verd="";		$time="";
					$memo="";
					$bus=strpos($response, "data-submission-id");
					$id="";

			//name 

					for($i=$bus+20;;$i++){
						if($response[$i]!='"'){
							$id.=$response[$i];
						}else break;
					}
					$this->Pname=$id;
					if($bus==FALSE){
						echo "error1 <br>";
						return 1;
					}
		//fecha
					$bus=strpos($response,"status-small");
					for($i=$bus+28;;$i++){
						if($response[$i]=='<' && $response[$i+1]=='/'){
							break;
						}
						echo $response[$i];
					}
					if($bus==FALSE){
						return 1;
					}
					echo "<br>";
			//vere
					$bus=strpos($response,'information-box-link');
					for ($i=$bus+53;  ; $i++) { 
						if($response[$i]=='<')break;
						$verd.=$response[$i];
					}
					$this->Pverd=$verd;
					if($bus==FALSE){
						return 1;
					}

			//time

					$bus=strpos($response,"time-consumed-cell");
					for ($i=$bus+21;  ; $i++) { 
						if($response[$i]=='<')break;
						$time.=$response[$i];
					}
					if($bus==FALSE){
						return 1;
					}
					$this->Ptime=$time;

					$bus=strpos($response,"memory-consumed-cell");
					for ($i=$bus+22;  ; $i++) { 
						if($response[$i]=='<')break;
						$memo.=$response[$i];
					}
					if($bus==FALSE){
						return 1;
					}
					$this->Pmemo=$memo;
		//end bd
					$foot="";
					$info = curl_getinfo($handler);
					$foot= "Se tardo ".$info['total_time']." segundos en enviar la peticion  :D";


					return 0;
				}
			}




			function getPname(){
				return $this->Pname;
			}
			function getPlang($lang){
				return $this->vec[$lang];
			}
			function getPverd(){
				return $this->Pverd;
			}
			function getPtime(){
				return $this->Ptime;
			}
			function getPmemo(){
				return $this->Pmemo;
			}




			function printans(){
				$handler = curl_init();  
				curl_setopt($handler, CURLOPT_URL, "http://codeforces.com/gym/".$this->idgym."/submission/".$this->Pname);
				curl_setopt($handler, CURLOPT_COOKIEJAR,getcwd().'/cof');
				curl_setopt($handler, CURLOPT_COOKIEFILE,getcwd().'/cof'); 
				curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($handler, CURLOPT_FRESH_CONNECT, true);
				curl_setopt($handler, CURLOPT_COOKIESESSION, getcwd().'/cof');
				curl_setopt($handler, CURLOPT_RETURNTRANSFER,1);
				$response = curl_exec ($handler);  
				curl_close($handler);
				$bus=strpos($response,"Source");
				$var="<br> ";
				for($i=$bus;$i<strpos($response, "footer");$i++){
					$var.=$response[$i];
				}
				return $var;
			}
		}
		?>
