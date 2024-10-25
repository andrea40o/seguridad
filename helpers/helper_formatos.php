<?php
    //Formatear fecha

    function formatearFecha($fecha){
        return date('d M,Y,g:i a', strtotime($fecha));
    };

    //Recortar texto, el texto de introducciòn

    function textoCorto($text, $chars=100){
        $text=$text."";
        $text=substr($text, 0, $chars);
     $text=substr($text, 0, strrpos($text,' '));
    $text=$text."...";

    return $text;
    }

?>