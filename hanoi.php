<?php

class Pila
{
    public $pila;
	public $size;
	public function __construct($size){
		$this->pila=array();
		$this->size=$size;
	}

	public function push($elemento){
		$this->pila[]=$elemento;
	}

	public function pop(){
		array_pop($this->pila);
	}

	public function top(){
		return end($this->pila);
	}

	public function isEmpty(){
		return empty($this->pila);
	}

	public function length(){
		return count($this->pila);
	}

}

class Disco
{
	public $size;
	public $conjunto_disco;
	public function __construct($cant){
		$this->conjunto_disco=array();
		$this->setDiscos($cant);
	}
	private function setDiscos($cantidad){
		for ($i=$cantidad; $i > 0; $i--) { 
			$this->conjunto_disco[]=$i;
		}
	}
}

class ProcesarJugada 
{
	private $origen;
	private $extremo;

	public function __construct(FormatJugada $jugada){
		$this->origen=$jugada->origen;
		$this->extremo=$jugada->extremo;
	}

	public function pilaOrigenNoVacia(Pila $pilaOrigen){

	}
	
}

class FormatJugada
{
	public $origen;
	public $extremo;
	public function setOrigenExtremo($valores){
		$this->origen=substr($valores, -2,-1);
		$this->extremo=substr($valores, -1);
	}
}

class FormarTorre
{
	public function imprimirTorre(Pila $torre){
		for ($i=$torre->size; $i >=0 ; $i--) { 
			$cadenaEquis="";
			if(isset($torre->pila[$i])){
				for ($x=0; $x <$torre->pila[$i] ; $x++) { 
					$cadenaEquis .='_';
				}
				echo $cadenaEquis.PHP_EOL;
			}else{
				echo '|'.PHP_EOL;
			}
		}
		echo '____________________'.PHP_EOL;
	}
	/* public function imprimirTorre(Pila $torre){
		for ($i=$torre->size; $i >=0 ; $i--) { 
			$valor = (isset($torre->pila[$i])) ? $torre->pila[$i] : '|' ;
			echo $valor.PHP_EOL;
		}
		echo '------------------'.PHP_EOL;
	} */
}

class Movimientos
{
	public $minMovimiento;
	public $movimientosRealizados;
	public function __construct($cantDiscos){
		$this->minMovimiento= (2**$cantDiscos)-1;
		$this->movimientosRealizados=0;
	}
	
	public function movimientoRealizado(){
		$this->movimientosRealizados++;
	}
}


echo "ingrese la cantidad de discos".PHP_EOL; 
fscanf(STDIN, "%s\n", $cantidadDiscos);
$cantidadDiscos;


$disco=new Disco($cantidadDiscos);
$pila1=new Pila($cantidadDiscos);
$pila2=new Pila($cantidadDiscos);
$pila3=new Pila($cantidadDiscos);
$cantJugadas= new Movimientos($cantidadDiscos);
foreach ($disco->conjunto_disco as $key => $disco) {
	$pila1->push($disco);	
}
$torre=new FormarTorre;
$torre->imprimirTorre($pila1);
$torre->imprimirTorre($pila2);
$torre->imprimirTorre($pila3);
echo 'minimos de movimientos:'.$cantJugadas->minMovimiento.'  -----  moviminetos realizados:'.$cantJugadas->movimientosRealizados.PHP_EOL;
$ganado=false;
while ($ganado==false) {
	echo "jugadas posibles".PHP_EOL; 
	echo "-12-21-13-31-23-32".PHP_EOL; 
	echo "el primer numero indica desde donde mover y el segundo hacias donde".PHP_EOL; 
	fscanf(STDIN, "%s\n", $desdeHasta);
	switch ($desdeHasta) {
		case '12':
			$jugadaValida=true;
			$pilaPop=$pila1;
			$pilaPush=$pila2;
			break;
		case '21':
			$jugadaValida=true;
			$pilaPop=$pila2;
			$pilaPush=$pila1;
			break;
		case '13':
			$jugadaValida=true;
			$pilaPop=$pila1;
			$pilaPush=$pila3;
			break;
		case '31':
			$jugadaValida=true;
			$pilaPop=$pila3;
			$pilaPush=$pila1;
			break;
		case '23':
			$jugadaValida=true;
			$pilaPop=$pila2;
			$pilaPush=$pila3;
			break;
		case '32':
			$jugadaValida=true;
			$pilaPop=$pila3;
			$pilaPush=$pila2;
			break;
		default:
			$jugadaValida=false;
			break;
	}
	if ($jugadaValida) {
		$jugada=new FormatJugada;
		$procesarJugada= new ProcesarJugada($jugada);
		if (!$pilaPop->isEmpty()) {
			$jugada->setOrigenExtremo($desdeHasta);
			$topPop=$pilaPop->top();
			$topPush=$pilaPush->top();
			if ($topPush==false || $topPop<$topPush) {
				$pilaPop->pop();
				$pilaPush->push($topPop);
				$cantJugadas->movimientoRealizado();
			}else{
				echo "movimiento invalido".PHP_EOL;
			}
		}else{
			echo "no puedes mover desde una pila vacía".PHP_EOL;
		}
	}else{
		echo "error al ingresar numeros".PHP_EOL;
	}
	$torre->imprimirTorre($pila1);
	$torre->imprimirTorre($pila2);
	$torre->imprimirTorre($pila3);
	echo 'minimos de movimientos:'.$cantJugadas->minMovimiento.'  -----  moviminetos realizados:'.$cantJugadas->movimientosRealizados.PHP_EOL;
if ($pila3->length()==$cantidadDiscos || $desdeHasta=='x') {$ganado=true;}
}


if ($desdeHasta=='x') {
	$resultado="te rendiste  ;(";
}else{
	$resultado="Felicidades Ganaste XD";
}
	echo "_________________________________________________________".PHP_EOL; 
	echo '----------------'.$resultado.'----------------'.PHP_EOL;
	echo "_________________________________________________________".PHP_EOL; 


/* */

?>