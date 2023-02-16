<?php 

namespace App\Repositories;

use App\Connection\ConnectionFactory;
use PDO;

class TeamRepository {

    public $connection;

    public function __construct()
    {
        $factory = new ConnectionFactory();
        $this->connection = $factory->getConnection();
    }

    public function getAll(){
        $sql = "SELECT * FROM tb_teams";

        $table = $this->connection->query($sql); 
        $resultados = $table->fetchAll(PDO::FETCH_ASSOC);

        return $resultados;
    }

    public function getById(int $id){
        $sql = "SELECT * FROM tb_teams WHERE id = :id";

        $table = $this->connection->prepare($sql); 
        $table->bindParam(":id", $id);

        $table->execute();

        $resultados = $table->fetch(PDO::FETCH_ASSOC);

        return $resultados;
    }

    public function getByGroup($group){
        $sql = "SELECT * FROM tb_teams WHERE grupo = :group";

        $table = $this->connection->prepare($sql); 
        $table->bindParam(":group", $group);

        $table->execute();

        $resultados = $table->fetchAll(PDO::FETCH_ASSOC);

        return $resultados;
    }

    public function getByTeamName($nome){
        $sql = "SELECT * FROM tb_teams WHERE nome_times like :nome";

        $table = $this->connection->prepare($sql); 
        $table->bindValue(":nome", '%'.$nome.'%');

        $table->execute();

        $resultados = $table->fetchAll(PDO::FETCH_ASSOC);

        return $resultados;
    }


    public function create(string $texto){

        $sql = "INSERT INTO tb_teams (???) VALUES('$texto')";

        $statement = $this->connection->exec($sql);

        $id = $this->connection->lastInsertId();

        return $id;
    }
}