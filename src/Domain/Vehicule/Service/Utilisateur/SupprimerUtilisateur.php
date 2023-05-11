<?php

namespace App\Domain\Vehicule\Service\Utilisateur;

use App\Domain\Vehicule\Repository\Utilisateur\SupprimerUtilisateurRepository;


 /// Service.
 
final class SupprimerUtilisateur
{
    /**
     * @var SupprimerUtilisateurRepository
     */
    private $repository;
        
     /// The constructor.
     
     /** 
     * @param SupprimerUtilisateurRepository $repository The repository
     * @param LoggerFactory $logger The logger
     */
    public function __construct(SupprimerUtilisateurRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * supprime un Utilisateur
     *
     * @param int $data du formulaire data
     *
     * @return array The supprimer utilisateur object
     */
    public function UtilisateurSupprimer(int $id): array
    {

        $utilisateurASupprimer = $this->repository->SupprimerUtilisateur($id);




        return $utilisateurASupprimer[0] ?? [];
    }


}
?>