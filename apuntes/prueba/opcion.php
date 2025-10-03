<?php
echo "Estas en opciones<br>";
if($_GET['n']==1){
    echo "<br>Has pulsado el enlace 1<br>";
}
if($_GET['n']==2){
    echo "<br>Has pulsado el enlace 2<br>";
}
if($_GET['n']==3){
    echo "<br>Has pulsado el enlace 3<br>";
}
?>
<a href="datos.php" > Ir a datos</a>