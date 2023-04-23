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

        // Here you can also use your preferred validation library

        if (empty($data['titre'])) {
            $errors['titre'] = 'Input required';
        }

        if (empty($data['description'])) {
            $errors['description'] = 'Input required';
        }
        if (empty($data['duree'])) {
            $errors['duree'] = 'Input required';
        }
        if (empty($data['date_sortie'])) {
            $errors['date_sortie'] = 'Input required';
        }
        if (empty($data['auteur_id'])) {
            $errors['auteur_id'] = 'Input required';
        }
        if (empty($data['dessinateur_id'])) {
            $errors['dessinateur_id'] = 'Input required';
        }

        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }
}
?>
