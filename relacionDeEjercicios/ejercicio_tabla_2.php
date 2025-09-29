<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio_tabla_2</title>
</head>

<body>
    <table border="1">


        <?php
        $matriz = array(
            "Marketing" => array(
                "Nombre" => "Pepe",
                "Apellidos" => "López",
                "Salario" => 1500,
                "Edad" => 35
            ),
            "Contabilidad" => array(
                "Nombre" => "Juan",
                "Apellidos" => "Sanchez",
                "Salario" => 1750,
                "Edad" => 28
            ),
            "Ventas" => array(
                "Nombre" => "María",
                "Apellidos" => "Carpio",
                "Salario" => 1675,
                "Edad" => 33
            ),
            "Informatica" => array(
                "Nombre" => "Pedro",
                "Apellidos" => "Luna",
                "Salario" => 2100,
                "Edad" => 48
            ),
            "Direccion" => array(
                "Nombre" => "Rosa",
                "Apellidos" => "Catalá",
                "Salario" => 5100,
                "Edad" => 53
            )
        );


        
        echo "<thead><tr><th>Departamento</th>";                //abrimos la cabecera de la tabla y como la primera tupla está vacía pues ingreso Departamentos por ejemplo
                                                                //porque esa primera columna perteneceria a la parte de Marketing ventas y eso.
        foreach (array_keys(reset($matriz)) as $columna) {      //reset me devuelve el primer elemento del array principal, por ejemplo el array de Marketing
                                                                //y array_keys me devuelve cada clave de ese sub-array, es decir el nombre, apllidos, tec.
            echo "<th>$columna</th>";                           //por cada vuelta que de el bucle crea un encabezado
        }
        echo "</tr></thead>";                                   //cerramos la cabecera de la tabla

       
        echo "<tbody>";                                         //abrimos el cuerpo de la tabla
        foreach ($matriz as $departamento => $datos) {          //de la matriz, cada departamento nos da sus datos
            echo "<tr>";                                        //abrimos <tr> para cada departamento uno por uno.
            echo "<td>$departamento</td>";                      //abrimos <td> e introduce el nombre del primer departamento y cerramos </td>.
            foreach ($datos as $valor) {                        //hacemos otro foreach que nos rellenará el resto de la fila con el contenido del array.
                echo "<td>$valor</td>";                         //abrimos <td> metemos el dato del array y cerramos </td>.
            }
            echo "</tr>";                                       //por último cerramos el </tr> de ese departamento y el segundo foreach vuelve a empezar en la linea 60
        }
        echo "</tbody>";                                        //para acabar cerramos el cuerpo de la tabla.



        ?>
    </table>
</body>

</html>