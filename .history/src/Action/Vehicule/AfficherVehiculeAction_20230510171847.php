<?php

namespace App\Action\Vehicule;

use App\Domain\Vehicule\Service\Vehicule\AfficherVehicule;
use App\Factory\LoggerFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


final class AfficherVehiculeAction
{
    /**
     * @var LoggerInterface
     */
    
    private $afficherVehicule;
    private $logger;

    public function __construct(AfficherVehicule $afficherVehicule, LoggerFactory $loggerFactory)
    {
        $this->afficherVehicule = $afficherVehicule;
        $this->logger = $loggerFactory
        // Le nom de fichier de log utilisé
        ->addFileHandler('LogAfficherVehicule.log')
        // ON peut passer du texte en paramètre ici qui identifiera
        // la ligne de log, sinon un UUID sera utilisé
        ->createLogger('MessageFromAfficherVehicule');
    }


    public function __invoke(ServerRequestInterface $requete, ResponseInterface $response): ResponseInterface 
    {
            
        
        $vehicule = $this->afficherVehicule->VehiculeAfficher();
        $response->getBody()->write((string)json_encode($vehicule));
        if (empty($vehicule)) {
            $this->logger->error("il est impossible d'afficher le tableau d'vehicule");
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(404);
        }
        else{
            $this->logger->info("le tableau d'vehicule a correctement affiché");
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }    
    }
}
