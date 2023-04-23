<?php

namespace App\Domain\Vehicules\Service\Vehicule;

use App\Domain\Vehicules\Repository\Vehicule\ModifierVehiculeRepository;
use App\Domain\Vehicules\Repository\Vehicule\AfficherVehiculeRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;
use App\Exception\RessourceNotFoundException;
use App\Exception\ValidationException;

 /// Service.
 
final class ModifierVehicule
{
     /**
     * @var ModifierVehiculeRepository
     */
    private $repository;

    /**
     * @var AfficherVehiculeRepository
     */
    private $afficherRepository;   
    
    /**
     * @var LoggerInterface
     */
    private $logger;

     /// The constructor.
     
     /** 
     * @param ModifierVehiculeRepository $repository The repository
     * @param LoggerFactory $logger The logger
     */
    public function __construct(ModifierVehiculeRepository $repository,AfficherVehiculeRepository $afficherRepository,LoggerFactory $logger)
    {
        $this->repository = $repository;
        $this->afficherRepository=$afficherRepository;
        $this->logger = $logger
            ->addFileHandler('LogModifierVehicule.log')
            ->createLogger("MessageFromModifierVehicule");
    }
    
    public function VehiculeModifier(int $id, array $data): array
    {
        $updateSucceed = false;
        // Validate if vehicule exist
        $this->ValidationVehicule($id);
        // Validate if all fields are sent
        $this->ValidationUpdateVehiculeData($data);

        // Update vehicule
        $updateSucceed = $this->repository->ModificationVehicule($data);

        $this->logger->info("Le véhicule id [{$id}]" . ($updateSucceed ? " a été modifié" : " n'a pu être modifié"));

        return $data;
    }

    /**
     * Input validation.
     *
     * @param array $data The form data
     *
     * @throws RessourceNotFoundException
     *
     * @return void
     */
    private function ValidationVehicule(int $id): void
    {
        $vehicule = $this->afficherRepository->SelectVehiculeId($id);

        // if (empty($vehicule)) {
        //     throw new RessourceNotFoundException("Aucun vehicule trouvé pour le id {$id}");
        // }
    }

    /**
     * Input validation.
     *
     * @param array $data The form data
     *
     * @throws ValidationException
     *
     * @return void
     */
    private function ValidationUpdateVehiculeData(array $data): void
    {
        $errors = [];
        if(!isset($data['titre'])) {
            $errors['titre'] = 'Champs requis';
        }
        if(!isset($data['description'])) {
            $errors['description'] = 'Champs requis';
        }
        if(!isset($data['duree'])) {
            $errors['duree'] = 'Champs requis';
        }
        if(!isset($data['date_sortie'])) {
            $errors['date_sortie'] = 'Champs requis';
        }
        if(!isset($data['auteur_id'])) {
            $errors['auteur_id'] = 'Champs requis';
        }
        if(!isset($data['dessinateur_id'])) {
            $errors['dessinateur_id'] = 'Champs requis';
        }
        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }
}
?>
