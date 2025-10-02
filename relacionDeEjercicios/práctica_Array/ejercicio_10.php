<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio_10</title>
</head>

<body>
    <h2>Ejercicio 10: Contar las Vocales en una Cadena</h2>
    <h3>Objetivo: Practicar el uso de bucles, operadores lógicos y funciones para
        manejar cadenas.</h3>
    <h3>Descripción:</h3>
    <p>1. Solicita una cadena de texto al usuario.
        <br>2. Escribe un algoritmo que cuente cuántas vocales hay en la cadena.
    </p>
    <?php
    $cadena="Hola me llamo Rafa y estudio 2ºDAW.";

    function cuentaVocales(String $cadena){
        
        $contador=0;

        for($i=0;$i<strlen($cadena);$i++){
            $ca=$cadena[$i];

            if($ca=='a' || $ca=='e' || $ca=='i' || $ca=='o' || $ca=='u' || $ca=='A' || $ca=='E' || $ca=='I' || $ca=='O' || $ca=='U'){
                $contador++;
            }
        }

        echo "La cadena: '".$cadena."' tiene ".$contador." vocales";
        
    }

    echo cuentaVocales($cadena);
    ?>
</body>

</html>