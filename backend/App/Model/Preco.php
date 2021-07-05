<?php

use App\Core\Model;

class Preco {
    
    public $idPrecos;
    public $primeiraHora;
    public $demaisHoras;

    public function listarTodos(){
        $sql = " SELECT * FROM  tblPrecos ";

        //preparamos a consulta
        $stmt = Model::getConexao()->prepare($sql);
        //executamos a consulta
        $stmt->execute();

        //verificamos a quantidade de linhas
        if($stmt->rowCount() > 0){
            //pegamos os resultados em forma de lista de objetos
            $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);

            //retornamos o resultado
            return $resultado;
        }else{
            return [];
        }
    }

}
?>
