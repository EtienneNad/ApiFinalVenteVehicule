<?php

namespace App\Domain\Animes\Service\Anime;

use App\Domain\Animes\Repository\Anime\AfficherAnimeRepository;


 /// Service.
 
final class AfficherAnime
{
    /**
     * @var AfficherAnimeRepository
     */
    private $repository;
        
     /// The constructor.
     
     /** 
     * @param AfficherAnimeRepository $repository The repository
     * @param LoggerFactory $logger The logger
     */
    public function __construct(AfficherAnimeRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Affiche la liste de tous les animes
     *
     * @return array La liste de tous les animes
     */
    public function AnimeAfficher(): array
    {
        $anime = $this->repository->SelectToutAnimes();

        return $anime;
    }
    /**
     * Affiche un anime selon son id
     *
     * @return array La liste de l'anime selon son id
     */
    public function AnimeIdAfficher($animeId): array
    {
        $anime = $this->repository->SelectAnimeId($animeId);

        return $anime[0] ?? [];
    }
}
?>