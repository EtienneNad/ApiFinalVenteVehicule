<?php

namespace App\Action\Anime;

use App\Domain\Animes\Service\Anime\SupprimerAnime;
use App\Factory\LoggerFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class SupprimerAnimeAction
{
   /**
     * @var LoggerInterface
     */
    
    private $supprimerAnime;
    private $logger;

    public function __construct(SupprimerAnime $supprimerAnime, LoggerFactory $loggerFactory)
    {
        $this->supprimerAnime = $supprimerAnime;
        $this->logger = $loggerFactory
        // Le nom de fichier de log utilisé
        ->addFileHandler('LogASupprimerAnime.log')
        // ON peut passer du texte en paramètre ici qui identifiera
        // la ligne de log, sinon un UUID sera utilisé
        ->createLogger('MessageFromSupprimerAnime');
    }


    public function __invoke( ServerRequestInterface $requete,ResponseInterface $reponse): ResponseInterface 
    {
            
            // Collect input from the HTTP request
         $id = $requete->getAttribute('id', 0);
         // Invoke the Domain with inputs and retain the result
         $this->supprimerAnime->AnimeSupprimer($id);
         // Build the HTTP response
         $resultat = "L'anime a correctement été suprimer";

         $reponse->getBody()->write((string)json_encode($resultat));
         
        
         $this->logger->info("L'anime dont l'id est " . $id . "a correctement été supprimer");
         return $reponse
             ->withHeader('Content-Type', 'application/json')
             ->withStatus(200);         
              
    }

}
?>