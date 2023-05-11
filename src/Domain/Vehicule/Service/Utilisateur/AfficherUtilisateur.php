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
        $utilisateur = $this->repository->SelectToutUtilisateur();

        return $utilisateur;
    }
    /**
     * Affiche un utilisateur selon son id
     *
     * @return array La liste de l'utilisateurs selon son id
     */
    public function UtilisateurIdAfficher($utilisateurId): array
    {
        $utilisateur = $this->repository->SelectUtilisateurId($utilisateurId);

        return $utilisateur[0] ?? [];
    }
/**
     * Affiche une cle selon son username et son mots de passe
     *
     * @return array La cle de l'utilisateurs selon son username et son mots de passe
     */
    public function UtilisateurCleAfficher($username, $motdepasse): array
    {
        $utilisateur = $this->repository->SelectUtilisateurCle($username, $motdepasse);

        return $utilisateur[0] ?? [];
    }


}

?>