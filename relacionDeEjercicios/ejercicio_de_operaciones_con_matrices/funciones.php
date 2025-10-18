<?php

//función que genera una matriz con números aleatorios entre el 1 y el 100
function generaMatrizNumRand($f, $c)
{
    $m = [];
    for ($i = 0; $i < $f; $i++) {
        for ($j = 0; $j < $c; $j++) {
            $m[$i][$j] = rand(1, 100);
        }
    }
    return $m;
}

//función que muestra una matriz en pantalla
function muestraMatriz($m)
{
    echo "<table border='1'>";
    foreach ($m as $f) {
        echo "<tr>";
        foreach ($f as $c) {
            echo "<td>$c</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

//función que realiza la suma de cada filas de una matriz y lo devuelve en un array
function sumaFilas($m)
{
    $r = [];
    foreach ($m as $i => $f) {
        $r[$i] = array_sum($f);
    }
    return $r;
}

//función que realiza la suma de cada una de las columnas y lo devuelve en un array
function sumaColumnas($m)
{
    $f = count($m);
    $c = count($m[0]);
    $r = array_fill(0, $c, 0);

    for ($i = 0; $i < $f; $i++) {
        for ($j = 0; $j < $c; $j++) {
            $r[$j] += $m[$i][$j];
        }
    }
    return $r;
}

//función que realiza la suma de la diagonal principal de la matriz.
function sumaDiagonal($m){
    $f=count($m);
    $c=count($m[0]);
    $suma=0;

    for($i=0;$i<$f;$i++){
        $suma+=$m[$i][$i];
    }
    return $suma;
}

//función que recoge una matriz y la devuelve de manera traspuesta
function matrizTraspuesta($m){
    return array_map(null,...$m);
}
