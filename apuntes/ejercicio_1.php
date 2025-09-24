<?php

$d1=25;
$m1=6;
$y1=2028;

$dia=date("l");

$dia=date("l",mktime(0,0,0,$m1,$d1,$y1));

switch ($dia){
    case "Monday":
        $d="Lunes";
    case "Tuesday":
        $d="Martes";
    case "Wednesday":
        $d="Miércoles";
    case "Thursday":
        $d="Jueves";
    case "Friday":
        $d="Viernes";
    case "Saturday":
        $d="Sábado";
    case "Sunday":
        $d="Domingo";
}

switch ($dia){
    case 1:
        $m="Enero";
    case 2:
        $m="Febrero";
    case 3:
        $m="Marzo";
    case 4:
        $m="Abril";
    case 5:
        $m="Mayo";
    case 6:
        $m="Junio";
    case 7:
        $m="Julio";
    case 8:
        $m="Agosto";
    case 9:
        $m="Septiembre";
    case 10:
        $m="Octubre";
    case 11:
        $m="Noviembre";
    case 12:
        $m="Diciembre";
}

echo "<br>".$d.",".date('d',mktime(0,0,0,$m1,$d1,$y1))." de ".$m." de ".date('Y',mktime(0,0,0,$m1,$d1,$y1));

?>