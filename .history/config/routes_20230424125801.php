<?php

use Slim\App;
use App\Middleware\AuthentificationBaseMiddleware;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

return function (App $app) {

    $app->get('/', \App\Action\HomeAction::class)->setName('home');

    // Documentation de l'api
    $app->get('/docs', \App\Action\Docs\SwaggerUiAction::class);

    // Véhicule
    $app->post('/vehicule', \App\Action\Vehicule\AjouterVehiculeAction::class);
    $app->get('/vehicule/all', \App\Action\Vehicule\AfficherVehiculeAction::class);
    $app->delete('/vehicule/{id}', \App\Action\Vehicule\SupprimerVehiculeAction::class);
    $app->put('/vehicule/modif', \App\Action\Vehicule\ModifierVehiculeAction::class);

    $app->post('/utilisateur', \App\Action\Utilisateur\AjouterUtilisateurAction::class);
    $app->get('/utilisateur/all', \App\Action\Utilisateur\AfficherUtilisateurAction::class);
    $app->delete('/utilisateur/{id}', \App\Action\Utilisateur\SupprimerUtilisateurAction::class);
    $app->put('/utilisateur/modif', \App\Action\Utilisateur\ModifierUtilisateurAction::class);
};

