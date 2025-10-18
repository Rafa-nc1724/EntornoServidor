<?php
require_once("funciones.php");
/*
si (se ha enviado){
    validamos datos
}
si(se ha enviado y no hay errores){
    Procesamos
}pero si(No se ha enviado o hay errores){
    mostramos formulario en blanco o con errores
}
*/
$f;
$c;
$opc;
$errores = [];

if (isset($_POST['generar'])) {
    if (!empty($_POST['f'])) {
        $f = true;
    } else {
        $errores[] = "Error en Filas";
    }
    if (!empty($_POST['c'])) {
        $c = true;
    } else {
        $errores[] = "Error en Columnas";
    }
    if (!empty($_POST['opc'])) {
        $opc = true;
        $opcion = (int) $_POST['opc'];
    } else {
        $errores[] = "Error en opción";
    }
    if ($_POST['opc'] == 4 && $_POST['f'] != $_POST['c']) {
        $errores[] = "Error en la matriz, para realizar esta función la matriz debe de ser cuadrada.";
        $opc = false;
    }
}
if (isset($_POST['generar']) && $f && $c && $opc) {
    $filas = $_POST['f'];
    $columnas = $_POST['c'];
    $m = generaMatrizNumRand($filas, $columnas);
    muestraMatriz($m);
    switch ($opcion) {
        case 1:

            $r = sumaFilas($m);
            foreach ($r as $i => $valor) {
                echo "Fila: " . ($i + 1) . " -> $valor <br>";
            }
            break;
        case 2:
            $r = sumaColumnas($m);
            foreach ($r as $i => $valor) {
                echo "Columna: " . ($i + 1) . " -> $valor <br>";
            }
            break;
        case 3:
            echo "<h2>Suma de Filas</h2>";
            $r = sumaFilas($m);
            foreach ($r as $i => $valor) {
                echo "Fila: " . ($i + 1) . " -> $valor <br>";
            }
            echo "<h2>Suma de Columnas</h2>";
            $r = sumaColumnas($m);
            foreach ($r as $i => $valor) {
                echo "Columna: " . ($i + 1) . " -> $valor <br>";
            }
            break;
        case 4:
            $suma = sumaDiagonal($m);
            echo "La suma de la Diagonal Principal de la matriz es $suma";
            break;
        case 5:
            echo "<br>";
            $mT = matrizTraspuesta($m);
            echo "<h2>Matriz Traspuesta</h2>";
            muestraMatriz($mT);
            break;

        default:
            echo "<p style=color:red>Error en el procesamiento</p>";
            break;
    }
?>
    <br><a href="index.html">Volver al menú</a>
<?php
} elseif (!isset($_POST['generar']) || count($errores) > 0) {
?>
    <h2>Introduce el tamaño de la matriz</h2>
    <form method="post" action="calcula.php">
        <input type="hidden" name="opc" value="<?php echo isset($_POST['opc']) ? $_POST['opc'] : $_GET['opc']; ?>">
        <label>Filas:</label>
        <input type="number" name="f" min="1" required>
        <label>Columnas:</label>
        <input type="number" name="c" min="1" required>
        <button type="submit" name="generar">Generar Matriz</button>
    </form>
    <a href="index.html">Volver al menú</a><br>
<?php
    if (count($errores) > 0) {
        foreach ($errores as $i => $valor) {
            echo "<p style=color:red>$valor</p>";
        }
    }
}
