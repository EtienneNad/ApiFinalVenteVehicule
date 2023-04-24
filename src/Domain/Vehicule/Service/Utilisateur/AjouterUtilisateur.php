<?php

namespace App\Domain\Vehicule\Service\Utilisateur;

use App\Domain\Vehicule\Repository\Utilisateur\AjouterUtilisateurRepository;
use App\Exception\ValidationException;

 /// Service.
 
final class AjouterUtilisateur
{
    /**
     * @var AjouterUtilisateurRepository
     */
    private $repository;
        
     /// The constructor.
     
     /** 
     * @param AjouterUtilisateurRepository $repository The repository
     * @param LoggerFactory $logger The logger
     */
    public function __construct(AjouterUtilisateurRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Create a new utilisateur.
     *
     * @param array $data The form data
     *
     * @return int The new utilisateur ID
     */
    public function NouveauUtilisateurCree(array $data): int
    {
        // Input validation
        $this->ValidationNouveauUtilisateur($data);

        // Insert user
        $utilisateur = $this->repository->InsererUtilisateur($data);

        // Logging here: utilisateur created successfully
        //$this->logger->info(sprintf('utilisateur created successfully: %s', $utilisateur));

        return $utilisateur;
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
    private function ValidationNouveauUtilisateur(array $data): void
    {
        $errors = [];

        // Here you can also use your preferred validation library

        if (empty($data['username'])) {
            $errors['username'] = 'Input required';
        }

        if (empty($data['motdepasse'])) {
            $errors['motdepasse'] = 'Input required';
        } 
       
        if (empty($data['cle'])) {
            $errors['cle'] = 'Input required';
        }  

        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }

}
?>