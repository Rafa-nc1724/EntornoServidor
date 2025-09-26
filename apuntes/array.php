<?php
/**
 * Existen 3 tipos de array
 * 
 * - Array Escalares:[0,1,2]
 * - Array Asociativos:[nombre,apellido,dirección]
 * - Array Mixto:[0,nombre,1,apellido]
 * 
 * Los indices se pueden usar como información.
 * en PHP el for no se suele usar para recorrer un array sobretodo un for each
 * Se crean dinámicamente
 * 
 */

//Declarar array
$array_escalar[7]="Pepe";
$array_asociativo["nombre"]=1;
$array_mixto["nombre"]="Juan";
$array_mixto["1"]="Pepe";
//El array mixto es el que comparte los indices numéricos y de otro tipo
//Si los indices no se dicen se crean del 0 hacia adelante
$a=["Pepe","Juan","Maria"];
foreach ($a as $ind=>$valor){
    echo $ind."=".$valor."<br>";
}

echo "<br>";

$a=[2=>"Pepe",1=>"Juan",0=>"Maria"];
foreach ($a as $ind=>$valor){
    echo $ind."=".$valor."<br>";
}

echo "<br>";
echo "<br>";

$b=array("Pepe","Juan","Maria");
foreach ($b as $ind=>$valor){
    echo $ind."=".$valor."<br>";
}

echo "<br>";

$b=array(0=>"Pepe",3=>"Juan",5=>"Maria");
foreach ($b as $ind=>$valor){
    echo $ind."=".$valor."<br>";
}
//La funcion array no añade crea.
echo "<br>===============================================<br>";


$a[][]="Pepe";
$a[][]="Maria";
$a[][3]="Rosa";
$a[][]="Juan";
$a[2][]="Antonio";
//count($a);-> te devuelve el número de indices que tiene el array en su interior
//pero si es una matriz te devuelve las filas que tiene 
/**
 * Si quisiera ver la cantidad de columnas que tiene una fila dentro de una 
 * matriz debería de hacer count($a[2]);
 */
//así podemos crear una matriz.
$matriz=array(
    0=>array("Nombre"=>"Alma","apellido"=>"Marcela Gozo","edad"=>69),
    1=>array("Nombre"=>"Leandro","apellido"=>"Gado","edad"=>4),
    2=>array("Nombre"=>"Rosa","apellido"=>"Melano","edad"=>15));

//matriz 
$matriz_ciclos=array(
    "Daw"=>array(
        "Dwes"=>"Desarrollo web entorno servidor",
        "Dwec"=>"Desarrollo we entorno cliente",
        "Diw"=>"Diseño de Interfaces web",
        "OPT"=>"Optativa"),
    "Dam"=>array(
        "Di"=>"Diseño de Interfaces",
        "Android"=>"Programación en android",
        "Windows"=>"Programación en Windows",
        "OPT"=>"Optativa")
);

foreach($matriz_ciclos as $ind=>$valor){
    echo $ind."=".$valor."<br>";
}