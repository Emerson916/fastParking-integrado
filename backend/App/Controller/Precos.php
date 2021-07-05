<?php

use App\Core\Controller;

class Precos extends Controller{

    //Listagem
    public function index(){
        
        $precoModel = $this->model("Preco");

        $dados = $precoModel->listarTodos();

       
    }
}