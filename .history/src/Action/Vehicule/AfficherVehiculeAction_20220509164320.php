<?php

namespace App\Action\Anime;

use App\Domain\Animes\Service\Anime\AfficherAnime;
use App\Factory\LoggerFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


final class AfficherAnimeAction
{
    /**
     * @var LoggerInterface
     */
    
    private $afficherAnime;
    private $logger;

    public function __construct(AfficherAnime $afficherAnime, LoggerFactory $loggerFactory)
    {
        $this->afficherAnime = $afficherAnime;
        $this->logger = $loggerFactory
        // Le nom de fichier de log utilisé
        ->addFileHandler('LogAfficherAnime.log')
        // ON peut passer du texte en paramètre ici qui identifiera
        // la ligne de log, sinon un UUID sera utilisé
        ->createLogger('MessageFromAfficherAnime');
    }


    public function __invoke(ServerRequestInterface $requete, ResponseInterface $response): ResponseInterface 
    {
            
        
        $anime = $this->afficherAnime->AnimeAfficher();
        $response->getBody()->write((string)json_encode($anime));
        if (empty($anime)) {
            $this->logger->error("il est impossible d'afficher le tableau d'anime");
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(404);
        }
        
        $this->logger->info("le tableau d'anime a correctement affiché");
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
              
    }
}
