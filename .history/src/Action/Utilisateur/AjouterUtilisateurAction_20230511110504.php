<?php

namespace App\Action\Utilisateur;

use App\Domain\Vehicule\Service\Utilisateur\AjouterUtilisateur;
use App\Factory\LoggerFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AjouterUtilisateurAction
{
   /**
     * @var LoggerInterface
     */
    
    private $ajouterUtilisateur;
    private $logger;

    public function __construct(AjouterUtilisateur $ajouterUtilisateur, LoggerFactory $loggerFactory)
    {
        $this->ajouterUtilisateur = $ajouterUtilisateur;
        $this->logger = $loggerFactory
        // Le nom de fichier de log utilisé
        ->addFileHandler('LogAjouterUtilisateur.log')
        // ON peut passer du texte en paramètre ici qui identifiera
        // la ligne de log, sinon un UUID sera utilisé
        ->createLogger('MessageFromAjouterUtilisateur');
    }


    public function __invoke( ServerRequestInterface $requete,ResponseInterface $reponse): ResponseInterface 
    {
            
            // Collect input from the HTTP request
        $data = (array)$requete->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $utilisateur = $this->ajouterUtilisateur->NouveauUtilisateurCree($data);

        // Transform the result into the JSON representation
        $resultat = [
            'id' => $utilisateur
        ];

        // Build the HTTP response
        $reponse->getBody()->write((string)json_encode($resultat));
        
        if($resultat['id'] = 0 ){
           return "cette usager existe"; 
        }
        $this->logger->info("L'utilisateur a été ajouter correctement");
        return $reponse
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
              
    }

}
?>
