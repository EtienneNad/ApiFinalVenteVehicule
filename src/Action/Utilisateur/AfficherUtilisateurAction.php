<?php

namespace App\Action\Utilisateur;

use App\Domain\Vehicule\Service\Utilisateur\AfficherUtilisateur;
use App\Factory\LoggerFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


final class AfficherUtilisateurAction
{
   /**
     * @var LoggerInterface
     */
    
    private $AfficherUtilisateur;
    private $logger;

    public function __construct(AfficherUtilisateur $AfficherUtilisateur, LoggerFactory $loggerFactory)
    {
        $this->AfficherUtilisateur = $AfficherUtilisateur;
        $this->logger = $loggerFactory
        // Le nom de fichier de log utilisé
        ->addFileHandler('LogAfficherUtilisateur.log')
        // ON peut passer du texte en paramètre ici qui identifiera
        // la ligne de log
        ->createLogger('MessageFromAfficherUtilisateur');
    }


    public function __invoke(ServerRequestInterface $requete,ResponseInterface $response): ResponseInterface 
    {
        
        $utilisateur = $this->AfficherUtilisateur->UtilisateurAfficher();
        $response->getBody()->write((string)json_encode($utilisateur));
        if (empty($utilisateur)) {
            $this->logger->error("il est impossible d'afficher le tableau d'utilisateur");
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(404);
        }
    
        $this->logger->info("le tableau  d'utilisateur a correctement affiché");
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        
              
    }

}
?>
