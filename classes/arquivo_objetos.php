<?php
include('Arquivo.php');
$arquivo = new Arquivo('carro.txt'); 
$arquivo->gravar('oi mundo');
$arquivo->gravar('oi mundo 2');
unset($arquivo); 

?>