<?php

namespace App\Domain\Vehicule\Service\Utilisateur;

use App\Domain\Vehicule\Repository\Utilisateur\ModifierUtilisateurRepository;
use App\Domain\Vehicule\Repository\Utilisateur\AjouterUtilisateurRepository;
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
     * @var AjouterUtilisateurRepository
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
    public function __construct(ModifierUtilisateurRepository $repository, LoggerFactory $logger)
    {
        $this->repository = $repository;
       
         $this->logger = $logger
            ->addFileHandler('LogModifierUtilisateur.log')
            ->createLogger("MessageFromModifierUtilisateur");
    }

    public function UtilisateurModifier(int $id, array $data): array
    {
        $updateSucceed = false;
        // Validate if utilisateur exist
        $this->ValidationUtilisateur($id);
        // Validate if all fields are sent
        $this->ValidationUpdateUtilisateurData($data);

        // Update utilisateur
        $updateSucceed = $this->repository->ModificationUtilisateur($id, $data);

       // $this->logger->info("L'utilisateur id [{$id}]" . ($updateSucceed ? " a été modifié" : " n'a pu être modifié"));

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
    private function ValidationUtilisateur(int $id): void
    {
        $utilisateur = $this->repository->SelectUtilisateurId($id);

        //  if (empty($utilisateur)) {
        //      throw new RessourceNotFoundException("Aucun utilisateur trouvé pour le id {$id}");
        //  }
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