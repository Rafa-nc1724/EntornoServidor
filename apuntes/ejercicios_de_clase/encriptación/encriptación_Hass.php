<?php 
/*
esta codificación para la misma cadena siempre da la misma codificación
siempre nos dará una coidificación de 32 caracteres

4d66a794f78832ec32db80993af0bb4a
4d66a794f78832ec32db80993af0bb4a
*/
echo "-----MD5-----<br>";
$pass="pepe";
$passmd5=md5($pass);
echo $passmd5;//encripctación con md5

$pass2="Pepe1234";
$passmd5_2=md5($pass2);
echo "<br>".$passmd5_2; //nos devuelve la misma encriptación aunque la vuelva a hacer otra vez
echo "<br><br>";

//verificación de contraseña con md5 aunque no se recomienda es vulnerable.
if($passmd5==md5("Rafael12345")){
    echo "Contraseña correcta";
} else{
    echo "Contraseña incorrecta";
}
/**
 * Con password_hash la misma cadena siempre que la codifiques sale una codificación diferente
 * además te da una codificación de 60 caracteres usando PASSWORD_DEFAULT
 */
echo "<br><br>";
echo "<br>-----PASSWORD_HASH-----<br>";

$passbcrypt=password_hash($pass,PASSWORD_DEFAULT);
echo $passbcrypt;
//para verificarlo realizamos lo siguiente.
if(password_verify($pass,$passbcrypt)){
    echo "<br>Contraseña correcta";
}else{
    echo "<br>Contraseña incorrecta";
}



