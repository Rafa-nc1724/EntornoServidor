<?php

function contador(){
    static $a = 0;
    $a++;
    return $a;
}
$a =10;
//las comillas asignan siempre una cadena de caracteres sean simples o dobles
$b='hola';
$c="hola";
$d=null;
$e=true;

echo contador()."<br>";
echo contador();


echo "<br><br>";

print "<br>";
echo "Hola"," Rafa<br>";
print "Hola Rafa<br>";
print "Hola "."Rafa";
?>
<br>
<?php
echo "Hola "."Rafa"."<br>";
echo "<br><br>";
print "El valor de la variable es: $a"."<br>";
print 'El valor de la variable es: "$a"'."<br>";
print "El valor de la variable es: \$a"."<br>";

echo gettype($a);
echo "<br>";
echo gettype($b);
echo "<br>";
echo gettype($d);
echo "<br>";
echo gettype($e);
echo "<br>";
echo gettype($noExiste);
?>
<br>
<br>
<?php
$v='a';
echo settype($a,"integer");
?>
<br>
<?php
echo "<br>".time();
echo "<br>". date_default_timezone_get();
date_default_timezone_set("Europe/Madrid");
echo "<br>". date_default_timezone_get();
echo "<br>".date('H:i:s \d\e\l l d/m/Y');
?>
<?= //funciona como la etqueta <?php echo
"<br>".time();
?>
<?php
/*
$_SERVER es una variable superglobar y toda su inf
está en el interior de un array

*/

echo "<br>";
echo $_SERVER['PHP_SELF'];

?>
<?php
if ($a < $b)
    print "a es menor que b";
elseif ($a > $b)
    print "a es mayor que b";
else
    print "a es igual a b";
?>

