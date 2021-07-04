<?php
    session_start();

    use App\Core\Controller;
    
    class Carros extends Controller{
    
        public function index(){
    
            $carrosModel = $this->model("Carros");
    
            $carros = $carrosModel->listarTodas();
    
            //para mostrar todos os carros possiveis
           echo json_encode($carros, JSON_UNESCAPED_UNICODE);
        }
    }
?>