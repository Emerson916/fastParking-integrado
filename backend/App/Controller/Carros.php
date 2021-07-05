<?php
    session_start();

    use App\Core\Controller;
    
    class Carros extends Controller{
    
        public function index(){
    
            $carrosModel = $this->model("Carro");
    
            $carros = $carrosModel->listarTodas();
    
            //para mostrar todos os carros possiveis
           echo json_encode($carros, JSON_UNESCAPED_UNICODE);
        }
    

    public function store(){

        //pegando o corpo da requisição, retona uma string
        $json = file_get_contents("php://input");

        //convertendo a string em objeto
        $novoCarro = json_decode($json);

        //instanciando o model
        $carrosModel = $this->model("Carro");

        //atribuindo a descricao ao model
        $carrosModel->idPrecos = $novoCarro->idPrecos;
        $carrosModel->nome = $novoCarro->nome;
        $carrosModel->placa = $novoCarro->placa;

        //chamando o método inserir do model
        $carrosModel = $carrosModel->inserir();

        //verificando se deu certo
        if($carrosModel){
            //se deu certo, retornar a categoria inserida
            http_response_code(201);
            echo json_encode($carrosModel, JSON_UNESCAPED_UNICODE);

        }else{
            //se deu errado, mudar status code para 500 e retornar mensagem de erro
            http_response_code(500);
            echo json_encode(["erro" => "Problemas ao inserir um novo carro"]);
        }

    }
}
    
?>