<?php

namespace App\Core;

class Controller{

    //recebemos o model a ser instanciado
    //retornamos a instancia pronta

    public function model($model){
        require_once ("../App/Model/" . $model . ".php");
        return new $model;
    }

    protected function getRequestBody(){
       //pegando o corpo da requisição, retorna um string
       $json = file_get_contents("php://input");
       
         //convertendo a string em objeto
        $obj = json_decode($json);

        return $obj;
    }
}