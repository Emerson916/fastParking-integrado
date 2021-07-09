<?php

use App\Core\Model;

class Carro{

    public $idCarros;
    public $idPrecos;
    public $nome;
    public $placa;
    public $dataEntrada;
    public $horaEntrada;
    public $totalValor;
    public $horaSaida;
    
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

        $sql = " INSERT INTO tblCarros (dataEntrada, horaEntrada, idPrecos, nome, placa )
                    VALUES (curdate(), curtime(), ?, ?, ?) ";

        $stmt = Model::getConexao()->prepare($sql);
        $stmt->bindValue(1, $this->idPrecos);
        $stmt->bindValue(2, $this->nome);
        $stmt->bindValue(3, $this->placa);
      

        if($stmt->execute()){
            //se der certo, atribuir o id inserido a instância desta classe
            $this->idCarros = Model::getConexao()->lastInsertId();
            return $this;
        }else{
            return false;
        }
    }

    public function update(){

        $sql = " UPDATE tblCarros SET nome = ?, placa = ? WHERE idCarros = ? ";

        $stmt = Model::getConexao()->prepare($sql);
        $stmt->bindValue(1, $this->nome);
        $stmt->bindValue(2, $this->placa);
        $stmt->bindValue(3, $this->idCarros);

        return $stmt->execute();
    }

    public function buscarPorId($id){

        $sql = " SELECT * FROM tblCarros WHERE idCarros = ? ";

        $stmt = Model::getConexao()->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $carro = $stmt->fetch(PDO::FETCH_OBJ);

            $this->idCarros = $carro->idCarros;
            $this->idPrecos = $carro->idPrecos;
            $this->nome = $carro->nome;
            $this->placa = $carro->placa;
            $this->dataEntrada = $carro->dataEntrada;
            $this->horaEntrada = $carro->horaEntrada;
            $this->totalValor = $carro->totalValor;
            $this->horaSaida = $carro->horaSaida;
           
            
            return $this;
        }else{
            return false;
        }
    }

    public function delete(){

        $sql = " DELETE FROM tblCarros WHERE idCarros = ? ";

        $stmt = Model::getConexao()->prepare($sql);
        $stmt->bindValue(1, $this->idCarros);

        return $stmt->execute();

    }

}
?>