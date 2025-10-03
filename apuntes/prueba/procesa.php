<?php
//usando POST como metodo
echo "Datos <br>";
if (isset($_POST['enviar'])) {
    echo "Nombre: " . $_POST['nombre'] . "<br>";
    echo "Apellidos: " . $_POST['apellidos'] . "<br>";
    echo "Email: " . $_POST['email'] . "<br>";
    //var_dump($_POST);
    foreach($_POST['modulos'] as $valor){
        echo "Modulo: ".$valor."<br>";
    }
    $nom = $_POST['nombre'];
    $apll = $_POST['apellidos'];
    $email = $_POST['email'];
} else {
    echo "No has enviado el formulario<br>";
    echo "<a href=datos.php>Ir a datos</a>";
}

//usando GET como metodo
/*  echo "Nombre: ".$_GET['nombre']."<br>";
    echo "Apellidos: ".$_GET['apellidos']."<br>";
    echo "Email: ".$_GET['email']."<br>"; */
?>
<a href="datos.php?n=<?= $nom ?>&a=<?= $apll ?>&e=<?= $email ?>"> Ir a datos</a>