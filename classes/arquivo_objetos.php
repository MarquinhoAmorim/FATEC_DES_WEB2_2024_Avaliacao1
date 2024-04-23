<?php
include('Arquivo.php');

$arquivo = new ArquivoGravar('carro.txt'); 
$arquivo->gravar_linha('oi mundo');
$arquivo->gravar_linha('oi mundo 2');
unset($arquivo); 

$arquivo2 = new ArquivoLer('carro.txt'); 
while (! $arquivo2->eof()){
    print($arquivo2->ler_linha());
    print('<br>');
}
unset($arquivo2); 

?>