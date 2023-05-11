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
    private $ajouterRepository;
     /// The constructor.

      /**
     * @var LoggerInterface
     */
    private $logger;
     
    
     /** 
     * @param ModifierUtilisateurRepository $repository The repository
     * @param LoggerFactory $logger The logger
     */
    public function __construct(ModifierUtilisateurRepository $repository, LoggerFactory $logger, AjouterUtilisateurRepository $ajouterRepository)
    {
        $this->repository = $repository;
       $this->ajouterRepository= $ajouterRepository;
         $this->logger = $logger
            ->addFileHandler('LogModifierUtilisateur.log')
            ->createLogger("MessageFromModifierUtilisateur");
    }

    public function UtilisateurModifier(int $id, array $data): array
    {
        
        $oldutilisateur = $this->repository->SelectUtilisateurId($id);

          if (empty($oldutilisateur)) {
            $utilisateur= $this->ajouterRepository->InsererUtilisateur($data);
            $codeStatus = 201; 
        }
        else{
            $utilisateur = $this->repository->ModificationUtilisateur($id, $data);
        }
        // Validate if all fields are sent
        $this->ValidationUpdateUtilisateurData($data);

        // Update utilisateur
        $resultat = [
            "movie" => $utilisateur,
            "codeStatus" => $codeStatus
        ];

        return $resultat;
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