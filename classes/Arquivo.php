<?php 
class Arquivo { 
	private $arquivo; 
    private $handle;
	 
	public function __construct($nome_arquivo) { 
        $this->arquivo = $nome_arquivo; 
        $this->handle = fopen($nome_arquivo, "a+");
        
	} 

    public function gravar($valor_da_linha) { 
        fwrite($this->handle, $valor_da_linha);
        fwrite($this->handle,"\n");
	} 

	public function __destruct() { 
        fclose($this->handle);
	} 
} 

?>