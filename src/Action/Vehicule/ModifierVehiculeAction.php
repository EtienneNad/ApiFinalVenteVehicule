<?php

namespace App\Action\Vehicule;

use App\Domain\Vehicule\Service\Vehicule\ModifierVehicule;
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
        // la ligne de log
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
            'marque' => $vehicule['marque'],
            'models' => $vehicule['models'],
            'prix' => $vehicule['prix'],
            'description' => $vehicule['description'],
            'image_url'=>$vehicule['image_url'],
            'nom_vendeur'=>$vehicule['nom_vendeur'],
            'adresse'=>$vehicule['adresse'],
            'ville'=>$vehicule['ville'],
            'courriel'=>$vehicule['courriel'],
            'no_telephone'=>$vehicule['no_telephone']
            
        ];

        // Build the HTTP response
        $reponse->getBody()->write((string)json_encode($resultat));
        if(empty($data)){
            $this->logger->info("Il n'a aucun vehicule qui a été modifié");
            return $reponse
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(404);
        }
        else{
            $this->logger->info("Le vehicule".$resultat." a correctement été modifié");
            return $reponse
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }   
    }

}
?>