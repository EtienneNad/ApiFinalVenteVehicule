<?php

namespace App\Domain\Vehicule\Service\Utilisateur;

use App\Domain\Vehicule\Repository\Utilisateur\ModifierUtilisateurRepository;
use App\Domain\Vehicule\Repository\Utilisateur\AfficherUtilisateurRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;
use App\Exception\RessourceNotFoundException;
use App\Exception\ValidationException;

 /// Service.
 
final class ModifierUtilisateur
{
    /**
     * @var ModifierUtilisateurRepository
     */
    private $repository;
        
     /**
     * @var AfficherUtilisateurRepository
     */
    private $afficherRepository;
     /// The constructor.

      /**
     * @var LoggerInterface
     */
    private $logger;
     
     /** 
     * @param ModifierUtilisateurRepository $repository The repository
     * @param LoggerFactory $logger The logger
     */
    public function __construct(ModifierUtilisateurRepository $repository, AfficherUtilisateurRepository $afficherRepository,LoggerFactory $logger)
    {
        $this->repository = $repository;
        $this->afficherRepository = $afficherRepository;
         $this->logger = $logger
            ->addFileHandler('LogModifierUtilisateur.log')
            ->createLogger("MessageFromModifierUtilisateur");
    }

    public function UtilisateurModifier(int $id, array $data): array
    {
        $this->ValidationUtilisateur($id);
        // Validate if all fields are sent
        $this->ValidationUpdateUtilisateurData($data);

        // Update utilisateur
        $updateSucceed = $this->repository->ModificationUtilisateur($data);

       

        return $updateSucceed;
    }

    /**
     * Input validation.
     *
     * @param int $id  de l'utilisateur
     *
     * @throws RessourceNotFoundException
     *
     * @return void
     */
    private function ValidationUtilisateur(int $id): void
    {
        $utilisateur = $this->afficherRepository->SelectUtilisateurId($id);
        if (empty($utilisateur)) {
            throw new RessourceNotFoundException("Aucun vehicule trouvé pour le id {$id}");
       }
       
    }

    /**
     *  validation.
     *
     * @param array $data le formulaire data
     *
     * @throws ValidationException
     *
     * @return void
     */
    private function ValidationUpdateUtilisateurData(array $data): void
    {
        $errors = [];
        if(!isset($data['username'])) {
            $errors['username'] = 'Champs requis';
        }
        if(!isset($data['motdepasse'])) {
            $errors['motdepasse'] = 'Champs requis';
        }
        
        if(!isset($data['cle'])) {
            $errors['cle'] = 'Champs requis';
        }
        if ($errors) {
            throw new ValidationException('Please check your input', $errors);
        }
    }

}
?>