<?php
if(isset($_COOKIE['ultimaVez'])){
    echo "Hola, tu último acceso fue el día ".$_COOKIE['ultimaVez'];
} else{
    echo "Hola, esta es la primera vez que accedes";

}
    setcookie("ultimaVez", date("d-m-Y H:i:s"), time()+3600);