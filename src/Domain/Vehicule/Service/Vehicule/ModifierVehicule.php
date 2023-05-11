<?php

namespace App\Domain\Vehicule\Service\Vehicule;

use App\Domain\Vehicule\Repository\Vehicule\ModifierVehiculeRepository;
use App\Domain\Vehicule\Repository\Vehicule\AfficherVehiculeRepository;
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
     * validation.
     
     * @param int $id id du véhicule
     *
     * @throws RessourceNotFoundException
     *
     * @return void
     */
    private function ValidationVehicule(int $id): void
    {
        $vehicule = $this->afficherRepository->SelectVehiculeId($id);

        if (empty($vehicule)) {
             throw new RessourceNotFoundException("Aucun vehicule trouvé pour le id {$id}");
        }
    }

    /**
     *  validation des donner.
     *
     * @param array $data du formulaire data
     *
     * @throws ValidationException
     *
     * @return void
     */
    private function ValidationUpdateVehiculeData(array $data): void
    {
        $errors = [];
        if(!isset($data['marque'])) {
            $errors['marque'] = 'Champs requis';
        }
        if(!isset($data['models'])) {
            $errors['models'] = 'Champs requis';
        }
        if(!isset($data['prix'])) {
            $errors['prix'] = 'Champs requis';
        }
        if(!isset($data['description'])) {
            $errors['description'] = 'Champs requis';
        }
        if(!isset($data['image_url'])) {
            $errors['image_url'] = 'Champs requis';
        }
        if(!isset($data['nom_vendeur'])) {
            $errors['nom_vendeur'] = 'Champs requis';
        }
         if(!isset($data['adresse'])) {
            $errors['adresse'] = 'Champs requis';
        }
         if(!isset($data['ville'])) {
            $errors['ville'] = 'Champs requis';
        }
         if(!isset($data['courriel'])) {
            $errors['courriel'] = 'Champs requis';
        }
         if(!isset($data['no_telephone'])) {
            $errors['no_telephone'] = 'Champs requis';
        }
        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }
}
?>
