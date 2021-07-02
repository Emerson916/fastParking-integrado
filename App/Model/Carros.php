<?php

use App\Core\Model;

class Carros{

    public $idCarros;
    public $idPrecos;
    public $nome;
    public $placa;
    public $dataEntrada;
    public $horaEntrada;
    
    public function listarTodas(){

        $sql = " SELECT * FROM tblCarros ";

        $stmt = Model::getConexao()->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);

            return $resultado;
        }else{
            return [];
        }
    }
}
?>