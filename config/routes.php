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
    $app->post('/vehicule', \App\Action\Vehicule\AjouterVehiculeAction::class)->add(AuthentificationBaseMiddleware::class);
    $app->get('/vehicule/all', \App\Action\Vehicule\AfficherVehiculeAction::class)->add(AuthentificationBaseMiddleware::class);
    $app->delete('/vehicule/{id}', \App\Action\Vehicule\SupprimerVehiculeAction::class)->add(AuthentificationBaseMiddleware::class);
    $app->put('/vehicule/modif', \App\Action\Vehicule\ModifierVehiculeAction::class)->add(AuthentificationBaseMiddleware::class);

    $app->post('/utilisateur', \App\Action\Utilisateur\AjouterUtilisateurAction::class)->add(AuthentificationBaseMiddleware::class);
    $app->get('/utilisateur/all', \App\Action\Utilisateur\AfficherUtilisateurAction::class)->add(AuthentificationBaseMiddleware::class);
    $app->post('/utilisateur/cle', \App\Action\Utilisateur\AfficherUtilisateurCleAction::class);
    $app->delete('/utilisateur/{id}', \App\Action\Utilisateur\SupprimerUtilisateurAction::class)->add(AuthentificationBaseMiddleware::class);
    $app->put('/utilisateur/modif', \App\Action\Utilisateur\ModifierUtilisateurAction::class)->add(AuthentificationBaseMiddleware::class);
};

