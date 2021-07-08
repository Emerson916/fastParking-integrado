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
            //se deu certo, retornar o carro inserido
            http_response_code(201);
            echo json_encode($carrosModel, JSON_UNESCAPED_UNICODE);

        }else{
            //se deu errado, mudar status code para 500 e retornar mensagem de erro
            http_response_code(500);
            echo json_encode(["erro" => "Problemas ao inserir um novo carro"]);
        }
    }

    public function update($id){

        $editarCarros = $this->getRequestBody();

        $carrosModel = $this->model("Carro");

        $carrosModel = $carrosModel->buscarPorId($id);

        if(!$carrosModel){
            http_response_code(404);
            echo json_encode(["erro" => "Carro não encontrado"]);
            exit();
        }

        //atribuindo a descricao ao model
        $carrosModel->nome = $editarCarros->nome;
        $carrosModel->placa = $editarCarros->placa;

        //verificando se deu certo
        if($carrosModel->update()){
            //se deu certo, retornar o carro inserido
            http_response_code(204);
        }else{
            //se deu errado, mudar status code para 500 e retornar mensagem de erro
            http_response_code(500);
            echo json_encode(["erro" => "Parâmetro invalido"]);
        }
    }

    public function delete($id){

        $carrosModel = $this->model("Carro");

        $carrosModel = $carrosModel->buscarPorId($id);

        if(!$carrosModel){
            http_response_code(404);
            echo json_encode(["erro" => "Carro não encontrado"]);
            exit();
        }

        if($carrosModel->delete()){
            //se deu certo, exclui o carro
            http_response_code(204);
        }else{
            //se deu errado, mudar status code para 500 e retornar mensagem de erro
            http_response_code(500);
            echo json_encode(["erro" => "Parâmetro invalido"]);
        }
    }


    public function find($id){

        $carrosModel = $this->model("Carro");

        $carros = $carrosModel->buscarPorId($id); 

       if($carros){
            echo json_encode($carros, JSON_UNESCAPED_UNICODE);
       }else{
           http_response_code(404);
           echo json_encode(["erro" => "Carro não encontrado!!"]);
       } 
    }

}
    
?>