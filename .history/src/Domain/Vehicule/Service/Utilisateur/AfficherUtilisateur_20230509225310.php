<?php

namespace App\Domain\Vehicule\Service\Utilisateur;

use App\Domain\Vehicule\Repository\Utilisateur\AfficherUtilisateurRepository;
use App\Domain\Vehicule\Service\Utilisateur\AjouterUtilisateur;

 /// Service.
 
final class AfficherUtilisateur
{
    /**
     * @var AjouterUtilisateur
     */
    private $repositoryAjouter;
        
    /**
     * @var AfficherUtilisateurRepository
     */
    private $repository;
        
     /// The constructor.
     
     /** 
     * @param AfficherUtilisateurRepository $repository The repository
     * @param LoggerFactory $logger The logger
     */
    public function __construct(AfficherUtilisateurRepository $repository, AjouterUtilisateur $repositoryAjouter)
    {
        $this->repository = $repository;
        $this->repositoryAjouter = $repositoryAjouter;
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
     * Affiche un utilisateur selon son id
     *
     * @return array La liste de l'utilisateurs selon son id
     */
    public function UtilisateurCleAfficher($username, $motdepasse): array
    {
        $utilisateur = $this->repository->SelectUtilisateurCle($username, $motdepasse);
        if(empty($utilisateur)){
            
        }

        return $utilisateur[0] ?? [];
    }


}

?>