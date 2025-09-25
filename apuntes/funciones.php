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
