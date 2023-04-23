<?php

namespace App\Action\Vehicule;

use App\Domain\Vehicule\Service\Vehicule\AjouterVehicule;
use App\Factory\LoggerFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AjouterVehiculeAction
{
       /**
     * @var LoggerInterface
     */
    
    private $ajouterVehicule;
    private $logger;

    public function __construct(AjouterVehicule $ajouterVehicule, LoggerFactory $loggerFactory)
    {
        $this->ajouterVehicule = $ajouterVehicule;
        $this->logger = $loggerFactory
        // Le nom de fichier de log utilisé
        ->addFileHandler('LogAjouterVehicule.log')
        // ON peut passer du texte en paramètre ici qui identifiera
        // la ligne de log, sinon un UUID sera utilisé
        ->createLogger('MessageFromAjouterVehicule');
    }


    public function __invoke( ServerRequestInterface $requete,ResponseInterface $reponse): ResponseInterface 
    {
            
        $data = (array)$requete->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $vehicule = $this->ajouterVehicule->NouveauVehiculeCree($data);

        // Transform the result into the JSON representation
        $resultat = [
            'id' => $vehicule
        ];

        // Build the HTTP response
        $reponse->getBody()->write((string)json_encode($resultat));
      
        $this->logger->info("Le vehicule a été ajouter correctement");
        return $reponse
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);      
                
              
    }


}
?>