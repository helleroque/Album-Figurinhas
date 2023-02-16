<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Repositories\TeamRepository;

class TeamController {

    //adicione a variável de repository nesta linha
    public $repository;

    public function __construct()
    {
        //adicione o algoritmo para criar um "objeto da classe TeamRepository"
        $this->repository = new TeamRepository();    

    }

    public function getAll(Request $request, Response $response, array $args){
        
        $team = $this->repository->getAll();
        
        return $response->withJson($team)->withStatus(200);
    }

    public function getById(Request $request, Response $response, array $args){
        
        $id = $args['id'];

        $team = $this->repository->getById($id);
        return $response->withJson($team)->withStatus(200);
    }

    public function getByTeamName(Request $request, Response $response, array $parametros){

        $nome = $parametros['nome'];
        
        $team = $this->repository->getByTeamName($nome);
        return $response->withJson($team)->withStatus(200);
    }

    public function getByGroup(Request $request, Response $response, array $parametros){

        $grupo = $parametros['grupo'];   
        
        
        $teams = $this->repository->getByGroup($grupo);
        return $response->withJson($teams)->withStatus(200);
    }

}