<?php 
class Arquivo { 
	private $arquivo; 
	 
	public function __construct($nome_arquivo) { 
        $this->arquivo = $nome_arquivo; 
        print('Chamado o construtor   ');
	} 
	 
	public function __destruct() { 
	    print('Chamado o destrutor   ');
	} 
} 

?>