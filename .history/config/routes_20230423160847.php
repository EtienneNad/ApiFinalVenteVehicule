<?php

use Slim\App;

return function (App $app) {

    $app->get('/', \App\Action\HomeAction::class)->setName('home');

    // Documentation de l'api
    $app->get('/docs', \App\Action\Docs\SwaggerUiAction::class);

    // Véhicule
    $app->post('/vehicule', \App\Action\Vehicule\AjouterVehiculeAction::class);
    $app->get('/vehicule/all', \App\Action\Vehicule\AfficherVehiculeAction::class);
    $app->delete('/vehicule/{id}', \App\Action\Vehicule\SupprimerVehiculeAction::class);
    $app->put('/vehicule/modif', \App\Action\Vehicule\ModifierVehiculeAction::class);

};

