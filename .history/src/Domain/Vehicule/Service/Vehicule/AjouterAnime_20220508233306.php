<?php

namespace App\Domain\Animes\Service\Anime;

use App\Domain\Animes\Repository\Anime\AjouterAnimeRepository;
use App\Exception\ValidationException;

/// Service.

final class AjouterAnime
{
    /**
     * @var AjouterAnimeRepository
     */
    private $repository;

    /// The constructor.

    /** 
     * @param AfficherAnimeRepository $repository The repository
     * @param LoggerFactory $logger The logger
     */
    public function __construct(AjouterAnimeRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Create a new anime.
     *
     * @param array $data The form data
     *
     * @return int The new anime ID
     */
    public function NouveauAnimeCree(array $data): int
    {
        // Input validation
        $this->ValidationNouveauAnime($data);

        // Insert anime
        $anime = $this->repository->InsererAnime($data);

        // Logging here: anime created successfully
        //$this->logger->info(sprintf('User created successfully: %s', $userId));

        return $anime;
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
    private function ValidationNouveauAnime(array $data): void
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
