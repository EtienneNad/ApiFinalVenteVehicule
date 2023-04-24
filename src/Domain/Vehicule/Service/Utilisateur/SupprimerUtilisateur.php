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
     * Delete an Utilisateur
     *
     * @param int $data The form data
     *
     * @return array The deleted utilisateur object
     */
    public function UtilisateurSupprimer(int $id): array
    {

        $utilisateurASupprimer = $this->repository->SupprimerUtilisateur($id);




        return $utilisateurASupprimer[0] ?? [];
    }


}
?>