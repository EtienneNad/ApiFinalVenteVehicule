<?php

namespace App\Action\Anime;

use App\Domain\Animes\Service\Anime\ModifierAnime;
use App\Factory\LoggerFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ModifierAnimeAction
{
   /**
     * @var LoggerInterface
     */
    
    private $modifierAnime;
    private $logger;

    public function __construct(ModifierAnime $modifierAnime, LoggerFactory $loggerFactory)
    {
        $this->modifierAnime = $modifierAnime;
        $this->logger = $loggerFactory
        // Le nom de fichier de log utilisé
        ->addFileHandler('LogModifierAnime.log')
        // ON peut passer du texte en paramètre ici qui identifiera
        // la ligne de log, sinon un UUID sera utilisé
        ->createLogger('MessageFromModifierAnime');
    }


    public function __invoke( ServerRequestInterface $requete,ResponseInterface $reponse): ResponseInterface 
    {
            
        $data = (array)$requete->getParsedBody();
       $id = (int)$data["id"] ?? 0;
        // Invoke the Domain with inputs and retain the result
        $anime = $this->modifierAnime->AnimeModifier( $id ,$data);

        // Transform the result into the JSON representation
        $resultat = [
            'id' => $anime['id'],
            'titre' => $anime['titre'],
            'description' => $anime['description'],
            'duree' => $anime['duree'],
            'date_sortie' => $anime['date_sortie'],
            'auteur_id'=>$anime['auteur_id'],
            'dessinateur_id'=>$anime['dessinateur_id']
        ];

        // Build the HTTP response
        $reponse->getBody()->write((string)json_encode($resultat));
        if(empty($data)){
            $this->logger->info("Il n'a aucun anime qui a été modifié");
            return $reponse
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(404);
        }

        $this->logger->info("L'anime".$resultat." a correctement été modifié");
        return $reponse
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
              
    }

}
?>