<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    
	private $matriz;

	/**
	 * Metodo encargado de cargar la vista
	 * 
	 */
    public function getSopaLetras(){
    	return response()->view('test');
    }

    /**
     * Metodo que obtiene el request he inicia el proceso de busqueda
     * @param  Request $request 
     * @return Integer  Numero de coincidencias encontradas
     */
    public function postSopaLetras(Request $request){

    	switch ($request->matriz) {
		    case 2:
		    	$this->matriz = [
			    	["1","","","","","","","","","10"],
					["E","I","O","I","E","I","O","E","I","O"],
					["5","","5","","","","","","",""],
					["E","A","E","A","E","","","","",""],
					["A","I","I","I","A","","","","",""],
					["E","I","0","I","E","","","","",""],
					["A","I","I","I","A","","","","",""],
					["E","A","E","A","E","","","","",""]
				];
		        break;
		    case 4:
		        $this->matriz = [
			    	["1","","1"],
					["E","",""]
				];
		        break;
		    default:
		    	$this->matriz = [
				  	["3","","3"],
				  	["O","I","E"],
				  	["I","I","C"],
				  	["E","X","E"]
				];
				 break;
		}
    	return $this->resolver($request->palabra);
    }

    /**
     * Metodo encargado de realizar la buscaquedas de la palabra solicitada
     * @param  String $palabra palabra a buscar
     * @return Integer     Cantidad de coincidencias
     */
    private function resolver($palabra){
    	$posibleSoluciones = $this->posiblesSolucionesDe($palabra);
    	$sumatoria = 0;

    	foreach ($posibleSoluciones as $pos) {
    		// Buscar horizontalmente hacia derecha.
			$palabraEncontrada = $this->palabraEnMatriz($pos, strlen($palabra), 0, 1);
			if(trim($palabra) == trim($palabraEncontrada))
	  		  $sumatoria++;

	  		// Buscar horizontalmente hacia izquierda.
	  		$palabraEncontrada = $this->palabraEnMatriz($pos, strlen($palabra), 0, -1);
			if(trim($palabra) == trim($palabraEncontrada))
	  		  $sumatoria++;

	  		// Buscar verticalmente hacia abajo.
	  		$palabraEncontrada = $this->palabraEnMatriz($pos, strlen($palabra), 1, 0);
			if(trim($palabra) == trim($palabraEncontrada))
	  		  $sumatoria++;

	  		// Buscar verticalmente hacia arriba.
	  		$palabraEncontrada = $this->palabraEnMatriz($pos, strlen($palabra), -1, 0);
			if(trim($palabra) == trim($palabraEncontrada))
	  		  $sumatoria++;

	  		// Buscar diagonal superior derecha.
	  		$palabraEncontrada = $this->palabraEnMatriz($pos, strlen($palabra), -1, 1);
			if(trim($palabra) == trim($palabraEncontrada))
	  		  $sumatoria++;

	  		// Buscar diagonal superior izquierda.
	  		$palabraEncontrada = $this->palabraEnMatriz($pos, strlen($palabra), -1, -1);
			if(trim($palabra) == trim($palabraEncontrada))
	  		  $sumatoria++;

	  		// Buscar diagonal inferior derecha.
	  		$palabraEncontrada = $this->palabraEnMatriz($pos, strlen($palabra), 1, 1);
			if(trim($palabra) == trim($palabraEncontrada))
	  		  $sumatoria++;

	  		// Buscar diagonal inferior izquierda.
	  		$palabraEncontrada = $this->palabraEnMatriz($pos, strlen($palabra), 1, -1);
			if(trim($palabra) == trim($palabraEncontrada))
	  		  $sumatoria++;
    	}

    	return $sumatoria;
    }

    /**
     * Metodo que realiza la busqueda de las posibles posiciones de la palabra. Este obtiene un Indice * invertido dentro de la matriz
     * @param  String $palabra 
     * @return Array  Array con las posiciones de la primera letra de la palabra
     */
    private function posiblesSolucionesDe($palabra){
    	$primeraLetra = $palabra[0];
		$indiceInvertido = [];

		for ($i=0; $i < count($this->matriz); $i++) { 
			for ($j=0; $j < count($this->matriz[$i]); $j++) { 
				if ($this->matriz[$i][$j] == $primeraLetra) {
					array_push($indiceInvertido, [$i,$j]);
				}
			}
		}
	  	return $indiceInvertido;
    }

    /**
     * Busca la palabra segun una posicion inicial y dirrecion
     * @param  Array  $posInicial        Posicion inicial para la busqueda
     * @param  Integer $numeroCaracteres Cantidad carateres en la palabra
     * @param  Integer $moverEnFila      Direccion en fila
     * @param  Integer $moverEnColumna   Direccion en columna
     * @return String                    La coincidencia de la palabra
     */
    private function palabraEnMatriz($posInicial, $numeroCaracteres, $moverEnFila, $moverEnColumna){
    	$pa = null;
		$recorrido = 0;
		$fila = $posInicial[0];
		$columna = $posInicial[1];
		while (($recorrido < $numeroCaracteres) &&
			 	($fila < count($this->matriz) && $columna < count($this->matriz)) &&
			 	($fila > -1 && $columna > -1)) {
			$pa = $pa.$this->matriz[$fila][$columna];
			print_r($fila." ".$columna);
			$fila = $fila + $moverEnFila;
			$columna = $columna + $moverEnColumna;
			$recorrido++;
		}
		return $pa;
    }
}
