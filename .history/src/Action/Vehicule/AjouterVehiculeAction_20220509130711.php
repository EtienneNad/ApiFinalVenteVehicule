<?php

namespace App\Action\Anime;

use App\Domain\Animes\Service\Anime\AjouterAnime;
use App\Factory\LoggerFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class AjouterAnimeAction
{
       /**
     * @var LoggerInterface
     */
    
    private $ajouterAnime;
    private $logger;

    public function __construct(AjouterAnime $ajouterAnime, LoggerFactory $loggerFactory)
    {
        $this->ajouterAnime = $ajouterAnime;
        $this->logger = $loggerFactory
        // Le nom de fichier de log utilisé
        ->addFileHandler('LogAjouterAnime.log')
        // ON peut passer du texte en paramètre ici qui identifiera
        // la ligne de log, sinon un UUID sera utilisé
        ->createLogger('MessageFromAjouterAnime');
    }


    public function __invoke( ServerRequestInterface $requete,ResponseInterface $reponse): ResponseInterface 
    {
            
        $data = (array)$requete->getParsedBody();

        // Invoke the Domain with inputs and retain the result
        $anime = $this->ajouterAnime->NouveauAnimeCree($data);

        // Transform the result into the JSON representation
        $resultat = [
            'id' => $anime
        ];

        // Build the HTTP response
        $reponse->getBody()->write((string)json_encode($resultat));
      
        $this->logger->info("L'anime a été ajouter correctement");
        return $reponse
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(201);      
                
              
    }


}
?>