<?php
function strquick() {
        $numargs = func_num_args();
        if ( $numargs == 2 ) {
                //desde 0 hasta el caracter
                $texto = func_get_arg(0);
                $caracter = func_get_arg(1);
                $pos = strpos($texto, $caracter);
                return substr($texto, 0, $pos);
        } elseif ( $numargs == 3 ) {
                //texto entre dos caracteres
                $texto = func_get_arg(0);
                $caracter = func_get_arg(1);
                $caracter2 = func_get_arg(2);
                $pos = strpos($texto, $caracter) + 1;
                $pos2 = strpos($texto, $caracter2) - $pos;
                return substr($texto, $pos, $pos2);
        }
}
 
function strquick_rest($texto, $caracter) {
        //desde el caracter hasta el final
        $pos = strpos($texto, $caracter)+1;
        return substr($texto, $pos);
}
?>
