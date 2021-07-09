<?php

use App\Core\Controller;

class Precos extends Controller{

    //Listagem
    public function index(){
        
        $precoModel = $this->Model("Preco");

        $precos = $precoModel->listarTodos();

       
    }

    public function store(){

        $novoPreco = $this->getRequestBody();

        //instanciando o model
        $precoModel = $this->Model("Preco");

        //atribuindo os valores ao model
        
        $precoModel->primeiraHora =  $novoPreco->primeiraHora;

        $precoModel->demaisHoras =  $novoPreco->demaisHoras;
        
        //chamando o método inserir do model
        $precoModel = $precoModel->inserir();

        //verificando se deu certo
        if($precoModel){
            //se deu certo, retornar o carro inserido
            http_response_code(201);
            echo json_encode($precoModel, JSON_UNESCAPED_UNICODE);

        }else{
            //se deu errado, mudar status code para 500 e retornar mensagem de erro
            http_response_code(500);
            echo json_encode(["erro" => "Problemas ao inserir um novo preco"]);
        }
    }
}