<?php

namespace App\Action\Utilisateur;

use App\Domain\Vehicule\Service\Utilisateur\ModifierUtilisateur;
use App\Factory\LoggerFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ModifierUtilisateurAction
{
   /**
     * @var LoggerInterface
     */
    
    private $modifierUtilisateur;
    private $logger;

    public function __construct(ModifierUtilisateur $modifierUtilisateur, LoggerFactory $loggerFactory)
    {
        $this->modifierUtilisateur = $modifierUtilisateur;
        $this->logger = $loggerFactory
        // Le nom de fichier de log utilisé
        ->addFileHandler('LogModifierUtilisateur.log')
        // ON peut passer du texte en paramètre ici qui identifiera
        // la ligne de log, sinon un UUID sera utilisé
        ->createLogger('MessageFromModifierUtilisateur');
    }


    public function __invoke( ServerRequestInterface $requete,ResponseInterface $reponse): ResponseInterface 
    {
            
        $data = (array)$requete->getParsedBody();
        $id = $requete->getAttribute('id', 0);
        // Invoke the Domain with inputs and retain the result
        $utilisateur = $this->modifierUtilisateur->UtilisateurModifier( $id ,$data);

        // Transform the result into the JSON representation
        $resultat = [
            'id' => $utilisateur['id'],
            'username' => $utilisateur['username'],
            'motdepasse' => $utilisateur['motdepasse'],
            'cle' => $utilisateur['cle']
        ];

        // Build the HTTP response
        $reponse->getBody()->write((string)json_encode($resultat));
        if(empty($data)){
            $this->logger->info("Il n'a aucun utilisateur qui a été modifié");
            return $reponse
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(405);
        }
        else{
            $this->logger->info("L'utilisateur".$resultat." a correctement été modifié");
            return $reponse
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }   
    }

}
?>
