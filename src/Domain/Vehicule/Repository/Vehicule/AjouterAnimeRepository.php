<?php

namespace App\Domain\Animes\Repository\Anime;

use PDO;
 /// Repository.
class AjouterAnimeRepository
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
    public function InsererAnime(array $anime): int
    {

        $row = [
            'titre' => $anime['titre'],
            'description' => $anime['description'],
            'duree' => $anime['duree'],
            'date_sortie' => $anime['date_sortie'],
            'auteur_id'=>$anime['auteur_id'],
            'dessinateur_id'=>$anime['dessinateur_id']
        ];

        $sql = "INSERT INTO anime SET 
                titre=:titre, 
                description=:description, 
                duree=:duree, 
                date_sortie=:date_sortie,
                auteur_id=:auteur_id,
                dessinateur_id=:dessinateur_id;";

        $this->connection->prepare($sql)->execute($row);

        return (int)$this->connection->lastInsertId();
    }

}
?>
