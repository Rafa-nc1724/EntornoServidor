
<form action="datos1.php" method="POST">
<?php
echo "<h2>Datos:</h2>";
echo "Nombre: ".$_POST['nombre']."<br>";
echo "Apellidos: ".$_POST['apellidos']."<br>";
echo "Número de Matrícula: ".$_POST['nM']."<br>";
echo "Curso: ".$_POST['curso']."<br>";
echo "Precio: ".$_POST['precio']."<br>";
?>
<button type="submit" name="inicio">Inicio</button>
</form>