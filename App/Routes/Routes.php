<?php

use Slim\App;
use App\Controllers\TeamController;
use App\Controllers\PlayersController;

$app = new App(['settings' => ['displayErrorDetails' => true]]);

/**
 * As linhas 12 a 20 são necessárias para se permitir o acesso dessas rotas por outros sistemas.
 * O padrão é ter acesso liberado somentre para quem estiver no mesmo servidor. Essa restrição está relacionada ao CORS 
 */
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response->withHeader('Access-Control-Allow-Origin', '*')
    ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

$app->get ('/', TeamController ::class . ":getAll");
$app->get ('/times', TeamController ::class . ":getAll");
$app->get ('/times/grupos/{grupo}', TeamController ::class . ":getByGroup");
$app->get ('/times/nome_times/{nome}', TeamController ::class . ":getByTeamName");
$app->get ('/times/{id}', TeamController ::class . ":getById");

$app->get ('/jogadores', PlayersController ::class . ":getAll");
$app->get ('/jogadores/nome_times/{nome}', PlayersController ::class . ":getByTeamName");
$app->get ('/jogadores/{id}', PlayersController ::class . ":getById");
$app->get ('/jogadores/nome_jogador/{nome}', PlayersController ::class . ":getByPlayersName");
$app->get ('/jogadores/posicao/{posicao}', PlayersController ::class . ":getByPosition");

$app->run();
