<?php
require_once('main/MainModel.php');

class EnderecoModel extends MainModel {
    private $nome_tabela = "endereco";
    
    public function __construct() {
        $this->setTable($this->nome_tabela);
    }
}