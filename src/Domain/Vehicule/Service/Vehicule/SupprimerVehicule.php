<?php

namespace App\Domain\Vehicule\Service\Vehicule;

use App\Domain\Vehicule\Repository\Vehicule\SupprimerVehiculeRepository;


 /// Service.
 
final class SupprimerVehicule
{
    /**
     * @var SupprimerVehiculeRepository
     */
    private $repository;
        
     /// The constructor.
     
     /** 
     * @param SupprimerVehiculeRepository $repository The repository
     * @param LoggerFactory $logger The logger
     */
    public function __construct(SupprimerVehiculeRepository $repository)
    {
        $this->repository = $repository;
    }
     /**
     * Supprime un vehicule
     *
     * @param int $id identifiant du véhicule
     *
     * @return array Le Vehicule supprimer object
     */
    public function VehiculeSupprimer(int $id): array
    {

        $vehiculeASupprimer = $this->repository->SupprimerVehicule($id);

        return $vehiculeASupprimer[0] ?? [];
    }
}
?>
