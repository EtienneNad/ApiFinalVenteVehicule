<?php

namespace App\Action\Vehicule;

use App\Domain\Vehicules\Service\Vehicule\ModifierVehicule;
use App\Factory\LoggerFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ModifierVehiculeAction
{
   /**
     * @var LoggerInterface
     */
    
    private $modifierVehicule;
    private $logger;

    public function __construct(ModifierVehicule $modifierVehicule, LoggerFactory $loggerFactory)
    {
        $this->modifierVehicule = $modifierVehicule;
        $this->logger = $loggerFactory
        // Le nom de fichier de log utilisé
        ->addFileHandler('LogModifierVehicule.log')
        // ON peut passer du texte en paramètre ici qui identifiera
        // la ligne de log, sinon un UUID sera utilisé
        ->createLogger('MessageFromModifierVehicule');
    }


    public function __invoke( ServerRequestInterface $requete,ResponseInterface $reponse): ResponseInterface 
    {
            
        $data = (array)$requete->getParsedBody();
       $id = (int)$data["id"] ?? 0;
        // Invoke the Domain with inputs and retain the result
        $vehicule = $this->modifierVehicule->VehiculeModifier( $id ,$data);

        // Transform the result into the JSON representation
        $resultat = [
            'id' => $vehicule['id'],
            'titre' => $vehicule['titre'],
            'description' => $vehicule['description'],
            'duree' => $vehicule['duree'],
            'date_sortie' => $vehicule['date_sortie'],
            'auteur_id'=>$vehicule['auteur_id'],
            'dessinateur_id'=>$vehicule['dessinateur_id']
        ];

        // Build the HTTP response
        $reponse->getBody()->write((string)json_encode($resultat));
        if(empty($data)){
            $this->logger->info("Il n'a aucun vehicule qui a été modifié");
            return $reponse
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(404);
        }

        $this->logger->info("Le vehicule".$resultat." a correctement été modifié");
        return $reponse
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
              
    }

}
?>