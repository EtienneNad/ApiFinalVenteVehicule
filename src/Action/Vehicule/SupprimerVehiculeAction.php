<?php

namespace App\Action\Vehicule;

use App\Domain\Vehicule\Service\Vehicule\SupprimerVehicule;
use App\Factory\LoggerFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class SupprimerVehiculeAction
{
   /**
     * @var LoggerInterface
     */
    
    private $supprimerVehicule;
    private $logger;

    public function __construct(SupprimerVehicule $supprimerVehicule, LoggerFactory $loggerFactory)
    {
        $this->supprimerVehicule = $supprimerVehicule;
        $this->logger = $loggerFactory
        // Le nom de fichier de log utilisé
        ->addFileHandler('LogASupprimerVehicule.log')
        // ON peut passer du texte en paramètre ici qui identifiera
        // la ligne de log, sinon un UUID sera utilisé
        ->createLogger('MessageFromSupprimerVehicule');
    }


    public function __invoke( ServerRequestInterface $requete,ResponseInterface $reponse): ResponseInterface 
    {
            
            // Collect input from the HTTP request
         $id = $requete->getAttribute('id', 0);
         // Invoke the Domain with inputs and retain the result
         $this->supprimerVehicule->VehiculeSupprimer($id);
         // Build the HTTP response
         $resultat = "Le vehicule a correctement été suprimer";

         $reponse->getBody()->write((string)json_encode($resultat));
         
        
         $this->logger->info("Le vehicule dont l'id est " . $id . "a correctement été supprimer");
         return $reponse
             ->withHeader('Content-Type', 'application/json')
             ->withStatus(200);         
              
    }

}
?>