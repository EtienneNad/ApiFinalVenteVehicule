<?php

namespace App\Domain\Vehicules\Service\Vehicule;

use App\Domain\Vehicules\Repository\Vehicule\SupprimerVehiculeRepository;


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
     * Delete an Auteur
     *
     * @param int $data The form data
     *
     * @return array The deleted auteur object
     */
    public function VehiculeSupprimer(int $id): array
    {

        $vehiculeASupprimer = $this->repository->SupprimerVehicule($id);

        return $vehiculeASupprimer[0] ?? [];
    }
}
?>
