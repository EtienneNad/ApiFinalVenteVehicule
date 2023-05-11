<?php

namespace App\Utilisateur\Action;

use App\Domain\Vehicule\Service\Utilisateur\AfficherUtilisateur;
use App\Factory\LoggerFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AfficherUsagerIdAction
{
    private $AfficherUsagerId;
    private $logger;
    public function __construct(AfficherUtilisateur $AfficherUsagerId, LoggerFactory $loggerFactory)
    {
        $this->AfficherUsagerId = $AfficherUsagerId;

        $this->logger = $loggerFactory
            // Le nom de fichier de log utilisé
            ->addFileHandler('LogUsager.log')
            // On peut passer du texte en paramètre ici qui identifiera
            // la ligne de log, sinon un UUID sera utilisé
            ->createLogger('MessageFromEtienne');
    }




    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        $usagerId = $request->getAttribute('username', "");
        $Usager = $this->AfficherUsagerId->UtilisateurUsernameAfficher($usagerId);

        $response->getBody()->write((string)json_encode($Usager));
        if (empty($Usager)) {
            $this->logger->info("il n'a pas d'usager dont l'id est " . $usagerId . " dans la base de données");
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(404);
        }

        $this->logger->info("L'usager dont l'id est " . $usagerId . " a correctement affiché");
        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}
