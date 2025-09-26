<?php
/*
include
include_once
require
require_once
Recomendada require
Los ficheros que tengan librerias con el require_once
el once detecta que las librerias ya están incluidas y no te da el error, 
sin embargo sin el once no lo hace y en el momento que incluamos otra vez 
otra libreria nos mandará error porque estamos redefiniendola.
*/
include 'prueba.php';
//include_once 'prueba.php';
echo "Contenido<br>";
include 'prueba.php';
echo "Contenido<br>";
require 'prueba.php';
echo "Contenido<br>";

/**
 * Las funciones deven de ser lo más independiente posibles. 
 * Deben ser lo más reutilizable posible.
 * Las funciones no muestran cosas por pantalla devuelven resultados
 * 
 */
function suma(int $a,$b){
$c=$a+$b;
return $c;
}
/**
 * parametro por valor: se realiza una copia de los valores y 
 * se trabaja con la copia
 * por referencia, lo que mandamos no se hace una copia se 
 * manda la direccion de la memeoria de la variable original
 * se indica con un & delante de la variable
 */
//Esta función se pasan los parametros por valor.
function salarioBruto($salario,$retenciones,$comision){
    $salario+=$comision;
    $retenciones=$salario*($retenciones/100);
    $salario-=$retenciones;
    return $salario;
}
//Esta función se pasan los parametros por referencia.
/**
 * Se modificaran las variables 'salario' y 'retenciones'
 *  una vez se ejecute la función.
 */
function salarioBruto2(&$salario,&$retenciones,$comision){
    $salario+=$comision;
    $retenciones=$salario*($retenciones/100);
    $salario-=$retenciones;
}
/**
 * a la hora de llamar a la funcion se puede mandar con el simbolo '&'
 * pero para que funcione la función tiene que estar realizada para 
 * que funcione
 */