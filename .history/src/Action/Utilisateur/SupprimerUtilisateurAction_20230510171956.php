<?php

namespace App\Action\Utilisateur;

use App\Domain\Vehicule\Service\Utilisateur\SupprimerUtilisateur;
use App\Factory\LoggerFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class SupprimerUtilisateurAction
{
   /**
     * @var LoggerInterface
     */
    
    private $supprimerUtilisateur;
    private $logger;

    public function __construct(SupprimerUtilisateur $supprimerUtilisateur, LoggerFactory $loggerFactory)
    {
        $this->supprimerUtilisateur = $supprimerUtilisateur;
        $this->logger = $loggerFactory
        // Le nom de fichier de log utilisé
        ->addFileHandler('LogSupprimerUtilisateur.log')
        // ON peut passer du texte en paramètre ici qui identifiera
        // la ligne de log, sinon un UUID sera utilisé
        ->createLogger('MessageFromSupprimerUtilisateur');
    }


    public function __invoke( ServerRequestInterface $requete,ResponseInterface $reponse): ResponseInterface 
    {
            
        $id = $requete->getAttribute('id', 0);
        // Invoke the Domain with inputs and retain the result
        $this->supprimerUtilisateur->UtilisateurSupprimer($id);
        // Build the HTTP response
        $resultat = "L'utilisateur a correctement été suprimer";

        $reponse->getBody()->write((string)json_encode($resultat));
        if(empty($id)){
            $this->logger->info(" l' id de l'utilisateur est invalide.");
            return $reponse
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(404);
        }
        else{
            $this->logger->info("L'utilisateur dont l'id est " . $id . "a correctement été supprimer");
            return $reponse
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);         
        }    
    }

}
?>
