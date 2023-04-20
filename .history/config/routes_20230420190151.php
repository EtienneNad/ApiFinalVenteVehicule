<?php

use Slim\App;

return function (App $app) {

    $app->get('/', \App\Action\HomeAction::class)->setName('home');

    // Documentation de l'api
    $app->get('/docs', \App\Action\Docs\SwaggerUiAction::class);

    // Véhicule
    $app->post('/vehicule', \App\Action\vehicule\AjoutervehiculeAction::class);
    $app->get('/vehicule/all', \App\Action\vehicule\AffichervehiculeAction::class);
    $app->delete('/vehicule/{id}', \App\Action\vehicule\SupprimervehiculeAction::class);
    $app->put('/vehicule/modif', \App\Action\vehicule\ModifiervehiculeAction::class);

};

