<?php

namespace App\Domain\Vehicules\Service\Vehicule;

use App\Domain\Vehicules\Repository\Vehicule\AjouterVehiculeRepository;
use App\Exception\ValidationException;

/// Service.

final class AjouterVehicule
{
    /**
     * @var AjouterVehiculeRepository
     */
    private $repository;

    /// The constructor.

    /** 
     * @param AfficherVehiculeRepository $repository The repository
     * @param LoggerFactory $logger The logger
     */
    public function __construct(AjouterVehiculeRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Create a new vehicule.
     *
     * @param array $data The form data
     *
     * @return int The new vehicule ID
     */
    public function NouveauVehiculeCree(array $data): int
    {
        // Input validation
        $this->ValidationNouveauVehicule($data);

        // Insert vehicule
        $vehicule = $this->repository->InsererVehicule($data);

        // Logging here: vehicule created successfully
        //$this->logger->info(sprintf('User created successfully: %s', $userId));

        return $vehicule;
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
    private function ValidationNouveauVehicule(array $data): void
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
