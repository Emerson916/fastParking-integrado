<?php

use App\Core\Model;

class Carro{

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

    public function inserir(){

        $sql = " INSERT INTO tblCarros (idPrecos, nome, placa, dataEntrada, horaEntrada,)
             VALUES (?,?,?,curdate(), curtime()) ";

        $stmt = Model::getConexao()->prepare($sql);
        $stmt->bindValue(1, $this->idPrecos);
        $stmt->bindValue(2, $this->nome);
        $stmt->bindValue(3, $this->placa);
      

        if($stmt->execute()){
            //se der certo, atribuir o id inserido a instância desta classe
            $this->id = Model::getConexao()->lastInsertId();
            return $this;
        }else{
            return false;
        }
    }

}
?>