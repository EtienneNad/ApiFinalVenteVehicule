<?php

namespace App\Domain\Vehicules\Service\Vehicule;

use App\Domain\Vehicules\Repository\Vehicule\AfficherVehiculeRepository;


 /// Service.
 
final class AfficherVehicule
{
    /**
     * @var AfficherVehiculeRepository
     */
    private $repository;
        
     /// The constructor.
     
     /** 
     * @param AfficherVehiculeRepository $repository The repository
     * @param LoggerFactory $logger The logger
     */
    public function __construct(AfficherVehiculeRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Affiche la liste de tous les vehicules
     *
     * @return array La liste de tous les vehicules
     */
    public function VehiculeAfficher(): array
    {
        $vehicule = $this->repository->SelectToutVehicules();

        return $vehicule;
    }
    /**
     * Affiche un vehicule selon son id
     *
     * @return array La liste de l'vehicule selon son id
     */
    public function VehiculeIdAfficher($vehiculeId): array
    {
        $vehicule = $this->repository->SelectVehiculeId($vehiculeId);

        return $vehicule[0] ?? [];
    }
}
?>