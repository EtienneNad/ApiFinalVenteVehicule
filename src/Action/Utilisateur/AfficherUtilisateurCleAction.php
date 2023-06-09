<?php

namespace App\Action\Utilisateur;

use App\Domain\Vehicule\Service\Utilisateur\AfficherUtilisateur;
use App\Factory\LoggerFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


final class AfficherUtilisateurCleAction
{
    private $AfficherUtilisateur;
    private $logger;
    public function __construct(AfficherUtilisateur $AfficherUtilisateur, LoggerFactory $loggerFactory)
    {
        $this->AfficherUtilisateur = $AfficherUtilisateur;

        $this->logger = $loggerFactory
            // Le nom de fichier de log utilisé
            ->addFileHandler('LogUsager.log')
            // On peut passer du texte en paramètre ici qui identifiera
            // la ligne de log
            ->createLogger('MessageFromEtienne');
    }




    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        
        $data = $request->getParsedBody();
        $username = (string)($data['username'] ?? '');
        $motdepasse = (string)($data['motdepasse']?? '');
     
        $Usager = $this->AfficherUtilisateur->UtilisateurCleAfficher($username, $motdepasse);
        

        $response->getBody()->write((string)json_encode($Usager));
        if (empty($Usager)) {
            $this->logger->info("il n'a pas d'usager dont le nom d'utilisateur est " . $username . "et dont le mot de passe est ". $motdepasse ." dans la base de données");
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(404);
        }

        $this->logger->info("L'usager dont le nom d'utilisateur est " . $username . "et dont le mot de passe est ". $motdepasse . " a correctement affiché sa cle");
        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}
