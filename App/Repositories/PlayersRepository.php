<?php 

namespace App\Repositories;

use App\Connection\ConnectionFactory;
use PDO;

class PlayersRepository {

    public $connection;

    public function __construct()
    {
        $factory = new ConnectionFactory();
        $this->connection = $factory->getConnection();
    }

    public function getAll(){
        $sql = "SELECT * FROM tb_players";

        $table = $this->connection->query($sql); 
        $resultados = $table->fetchAll(PDO::FETCH_ASSOC);

        return $resultados;
    }

    public function getById(int $id){
        $sql = "SELECT * FROM tb_players WHERE id = :id";

        $table = $this->connection->prepare($sql); 
        $table->bindParam(":id", $id);

        $table->execute();

        $resultados = $table->fetch(PDO::FETCH_ASSOC);

        return $resultados;
    }

    public function getByTeamName($nome_times){

        $sql = "SELECT * FROM tb_teams WHERE team_name = :nome or team_code = :nome";

        $table = $this->connection->prepare($sql); 
        $table->bindParam(":nome", $nome_times);

        $table->execute();

        $time = $table->fetch(PDO::FETCH_ASSOC);
        //fim da busca pelo time

        $sql = "SELECT * FROM tb_players WHERE id_team = :id";

        $table = $this->connection->prepare($sql); 
        $table->bindParam(":id", $time["id"]);

        $table->execute();

        $resultados = $table->fetchAll(PDO::FETCH_ASSOC);

        return $resultados;
    }

    public function getByPosition( $posicao){
        $sql = "SELECT * FROM tb_players WHERE posicao = :posicao";

        $table = $this->connection->prepare($sql); 
        $table->bindParam(":posicao", $posicao);

        $table->execute();

        $resultados = $table->fetchAll(PDO::FETCH_ASSOC);

        return $resultados;
    }

    public function getByPlayersName($nome_jogadores){

        $sql = "SELECT * FROM tb_players WHERE nome_jogadores like :nome";

        $table = $this->connection->prepare($sql); 
        $table->bindValue(":nome", '%'.$nome_jogadores.'%');

        $table->execute();

        $resultados = $table->fetchAll(PDO::FETCH_ASSOC);

        return $resultados;
    }
}