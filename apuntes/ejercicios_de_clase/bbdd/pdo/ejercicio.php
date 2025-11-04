<?php
try{
$db='mysql:host=localhost;dbname=dwes;charset=utf8mb4';
//mysql:host=nombre del dominio;dbname=nombre de la base de datos;charset=nomenglatura que usamos.
$opc=array(/* PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ, */PDO::ATTR_CASE=>PDO::CASE_LOWER);
$conex=new PDO($db,'dwes','abc123.',$opc);
//Cada vez que recupere cada consutla lo pasará como objeto y en minuscula.
//exec siempre para cuando no devuelva resultados (filas afectadas)
//query siempre que devuelva resultados (datos del select)
$conex->beginTransaction();//tenemos que ponerlo cada vez que queramos desactivar el autocommit, despues del commit
$reg1=$conex->exec("UPDATE stock SET unidades=2 WHERE producto='3DSNG'");
$reg2=$conex->exec("UPDATE stock SET unidades=5 WHERE producto='ACERAX3950'");
if($reg1===0)echo "No se ha actualizado el producto 1<br>";
if($reg2===0)echo "No se ha actualizado el producto 2<br>";
$conex->commit();
$reg2=$conex->exec("UPDATE stock SET unidades=5000000 WHERE producto='ARCLPMP32GBN'");
} catch(PDOException $ex){
    $conex->rollBack();
    echo $ex->getMessage()."<br>";
    print_r($ex->errorInfo);
} 

try {
    $result=$conex->query("SELECT *FROM producto");
    echo "Numero de registros devueltso: ".$result->rowCount()."<br>";
    while($fila=$result->fetchObject()){
        
    }
} catch (PDOException $ex) {
    
}
