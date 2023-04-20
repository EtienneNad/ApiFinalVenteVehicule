<?php

namespace App\Domain\Animes\Repository\Anime;

use PDO;
 /// Repository.
class AfficherAnimeRepository
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

    public function SelectToutAnimes(): array
    {
        $sql = "SELECT * FROM anime";

        $query = $this->connection->prepare($sql);
        $query->execute();

        $resultat = $query->fetchAll(PDO::FETCH_ASSOC);

        return $resultat;
    }

    public function SelectAnimeId(int $animeId): array
    {
        $params = [
            "id" => $animeId
        ];
        $sql = "SELECT * FROM anime WHERE id = :id";

        $query = $this->connection->prepare($sql);
        $query->execute($params);
        if ($query){
            $resultat = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            return [];
        }

        return $resultat;
    }
    
}
?>
