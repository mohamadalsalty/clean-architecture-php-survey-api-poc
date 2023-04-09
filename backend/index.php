<?php

require_once 'vendor/autoload.php';
use App\Router;
header('Content-Type: application/json');



use App\Http\Controllers\SurveyController;
use App\Infrastructure\Repositories\MysqlSurveyRepository;
use App\UseCases\SurveyUseCase;


$router = new Router();
$mysqlSurveyRepository = new MysqlSurveyRepository();
$surveyUseCase = new SurveyUseCase($mysqlSurveyRepository);
$surveyController = new SurveyController($surveyUseCase);


$router->addRoute(/**
 * @param $id
 * @return void
 */ 'GET', '/survey/{id}', function ($id) use ($surveyController) {
    $surveyController->findSurvey($id);
});

$router->addRoute(/**
 * @return void
 */ 'POST', '/survey/create', function () use ($surveyController) {
    $title = $_POST['title'] ?? '';
    $surveyController->createSurvey($title);
});

$router->addRoute(/**
 * @param $id
 * @return void
 */ 'GET', '/surveys/all', function () use ($surveyController) {
    $surveyController->findAllSurveys();
});




$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];
$router->handleRequest($requestMethod, $requestUri);
