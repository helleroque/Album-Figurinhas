<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Repositories\PlayersRepository;

class PlayersController{

    //adicione a variável de repository nesta linha
    public $repository;

    public function __construct()
    {
        //adicione o algoritmo para criar um "objeto da classe PlayersRepository"
        $this->repository = new PlayersRepository();    

    }

    public function getAll(Request $request, Response $response, array $args){
        
        $players = $this->repository->getAll();
        
        return $response->withJson($players)->withStatus(200);
    }

    public function getById(Request $request, Response $response, array $args){
        
        $id = $args['id'];

        $players = $this->repository->getById($id);
        return $response->withJson($players)->withStatus(200);
    }

    public function getByPlayersName(Request $request, Response $response, array $parametros){

        $nome_jogadores = $parametros['nome'];
        
        $players = $this->repository->getByPlayersName($nome_jogadores);
        return $response->withJson($players)->withStatus(200);
    }

    public function getByTeamName(Request $request, Response $response, array $args){

        $nome = $args['nome'];
        
        $players = $this->repository->getByTeamName($nome);
        return $response->withJson($players)->withStatus(200);
    }

    public function getByPosition(Request $request, Response $response, array $args){

        $posicao = $args['posicao'];
        
        $players = $this->repository->getByPosition($posicao);
        return $response->withJson($players)->withStatus(200);
    }
}