<?php

namespace App\Domain\Animes\Service\Anime;

use App\Domain\Animes\Repository\Anime\SupprimerAnimeRepository;


 /// Service.
 
final class SupprimerAnime
{
    /**
     * @var SupprimerAnimeRepository
     */
    private $repository;
        
     /// The constructor.
     
     /** 
     * @param SupprimerAnimeRepository $repository The repository
     * @param LoggerFactory $logger The logger
     */
    public function __construct(SupprimerAnimeRepository $repository)
    {
        $this->repository = $repository;
    }
     /**
     * Delete an Auteur
     *
     * @param int $data The form data
     *
     * @return array The deleted auteur object
     */
    public function AnimeSupprimer(int $id): array
    {

        $animeASupprimer = $this->repository->SupprimerAnime($id);

        return $animeASupprimer[0] ?? [];
    }
}
?>
