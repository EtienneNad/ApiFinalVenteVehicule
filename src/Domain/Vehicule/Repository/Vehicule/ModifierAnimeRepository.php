<?php

namespace App\Domain\Animes\Repository\Anime;

use PDO;
 /// Repository.
class ModifierAnimeRepository
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
    public function ModificationAnime(array $anime): array
    {
        $row = [
            'id' => $anime['id'],
            'titre' => $anime['titre'],
            'description' => $anime['description'],
            'duree' => $anime['duree'],
            'date_sortie' => $anime['date_sortie'],
            'auteur_id'=>$anime['auteur_id'],
            'dessinateur_id'=>$anime['dessinateur_id']
        ];

        $sql = 
            "UPDATE anime SET 
                titre=:titre, 
                description=:description, 
                duree=:duree, 
                date_sortie=:date_sortie,
                auteur_id=:auteur_id,
                dessinateur_id=:dessinateur_id
                WHERE id =:id;";

        $this->connection->prepare($sql)->execute($row);
        return $row;
    }

}
?>
