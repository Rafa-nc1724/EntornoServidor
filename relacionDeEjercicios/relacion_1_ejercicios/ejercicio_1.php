<?php
$year=2028;
    
if($year%4 == 0){
    if($year%100 !== 0){
        if($year%400 !== 0){
            print "El año es bisiesto (tiene 366 días)";
        }
    }else{
        print "El año no es bisiesto (tiene 365 días)";
    }
}else{
    print "El año no es bisiesto (tiene 365 días)";
}
?>