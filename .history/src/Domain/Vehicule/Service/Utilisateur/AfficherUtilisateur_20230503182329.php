<?php

namespace App\Domain\Vehicule\Service\Utilisateur;

use App\Domain\Vehicule\Repository\Utilisateur\AfficherUtilisateurRepository;


 /// Service.
 
final class AfficherUtilisateur
{
    /**
     * @var AfficherUtilisateurRepository
     */
    private $repository;
        
     /// The constructor.
     
     /** 
     * @param AfficherUtilisateurRepository $repository The repository
     * @param LoggerFactory $logger The logger
     */
    public function __construct(AfficherUtilisateurRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Affiche la liste de tous les utilisateurs
     *
     * @return array La liste de tous les utilisateurs
     */
    public function UtilisateurAfficher(): array
    {
        $books = $this->repository->SelectToutUtilisateur();

        return $books;
    }
    /**
     * Affiche un utilisateur selon son id
     *
     * @return array La liste de l'utilisateurs selon son id
     */
    public function UtilisateurIdAfficher($id): array
    {
        $utilisateur = $this->repository->SelectUtilisateurId($id);

        return ;
    }

}
?>