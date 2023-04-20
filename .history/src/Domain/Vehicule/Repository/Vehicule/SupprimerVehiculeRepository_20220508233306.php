<?php

namespace App\Domain\Animes\Repository\Anime;

use PDO;
 /// Repository.
class SupprimerAnimeRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;
    
     /// Constructor.
    
     /**
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }
    public function SupprimerAnime(int $id): bool
    {
        $params = ['id' => $id];

        // Delete author reference from joint table livreauteur
        $sql = "DELETE FROM anime WHERE id = :id";
        $query = $this->connection->prepare($sql);
        $resultat = $query->execute($params);

        return $resultat;
    }

   
}
?>
