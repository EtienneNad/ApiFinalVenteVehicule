<?php

namespace App\Domain\Animes\Service\Anime;

use App\Domain\Animes\Repository\Anime\ModifierAnimeRepository;
use App\Domain\Animes\Repository\Anime\AfficherAnimeRepository;
use App\Factory\LoggerFactory;
use Psr\Log\LoggerInterface;
use App\Exception\RessourceNotFoundException;
use App\Exception\ValidationException;

 /// Service.
 
final class ModifierAnime
{
     /**
     * @var ModifierAnimeRepository
     */
    private $repository;

    /**
     * @var AfficherAnimeRepository
     */
    private $afficherRepository;   
    
    /**
     * @var LoggerInterface
     */
    private $logger;

     /// The constructor.
     
     /** 
     * @param ModifierAnimeRepository $repository The repository
     * @param LoggerFactory $logger The logger
     */
    public function __construct(ModifierAnimeRepository $repository,AfficherAnimeRepository $afficherRepository,LoggerFactory $logger)
    {
        $this->repository = $repository;
        $this->afficherRepository=$afficherRepository;
        $this->logger = $logger
            ->addFileHandler('LogModifierAnime.log')
            ->createLogger("MessageFromModifierAnime");
    }
    
    public function AnimeModifier(int $id, array $data): array
    {
        $updateSucceed = false;
        // Validate if anime exist
        $this->ValidationAnime($id);
        // Validate if all fields are sent
        $this->ValidationUpdateAnimeData($data);

        // Update anime
        $updateSucceed = $this->repository->ModificationAnime($data);

        $this->logger->info("L'auteur id [{$id}]" . ($updateSucceed ? " a été modifié" : " n'a pu être modifié"));

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
    private function ValidationAnime(int $id): void
    {
        $anime = $this->afficherRepository->SelectAnimeId($id);

        if (empty($anime)) {
            throw new RessourceNotFoundException("Aucun anime trouvé pour le id {$id}");
        }
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
    private function ValidationUpdateAnimeData(array $data): void
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
