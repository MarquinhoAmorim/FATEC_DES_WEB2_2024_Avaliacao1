<?php 
class ArquivoGravar { 
	private $arquivo; 
    private $handle;
	 
	public function __construct($nome_arquivo) { 
        $this->arquivo = $nome_arquivo; 
        $this->handle = fopen($nome_arquivo, "a+");
        
	} 

    public function gravar_linha($valor_da_linha) { 
        fwrite($this->handle, $valor_da_linha);
        fwrite($this->handle,"\n");
	} 

	public function __destruct() { 
        fclose($this->handle);
	} 
} 

class ArquivoLer { 
	private $arquivo; 
    private $handle;
	 
	public function __construct($nome_arquivo) { 
        $this->arquivo = $nome_arquivo; 
        $this->handle = fopen($nome_arquivo, "r");
        
	} 

    public function ler_linha() { 
        $buffer = stream_get_line($this->handle, 1096, "\n");
        return $buffer;   
	} 

    public function eof() {
        return feof($this->handle);
    }

	public function __destruct() { 
        fclose($this->handle);
	} 
}
?>