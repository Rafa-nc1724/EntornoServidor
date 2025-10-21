<?php
try{
$conex = new mysqli("localhost","dwes","abc123.","empleados");
$conex->set_charset("utf8mb4");
$result= $conex->query("select * from datos");
//$datos= $result->fetch_all();//devuelve un array de cada fila
//$datos= $result->fetch_assoc();//devuelve un array con el nombre de los indices de la Bd.
//$datos= $result->fetch_row();
//$datos= $result->fetch_object();//devuelve un objeto
//print_r($datos);

while($datos=$result->fetch_object()){
    echo"<br>".$datos->Nombre;
}
$result->data_seek(0);

while($datos=$result->fetch_assoc()){
    echo"<br>".$datos['Nombre'];
}

} catch(Exception $ex){
    echo $ex;
}