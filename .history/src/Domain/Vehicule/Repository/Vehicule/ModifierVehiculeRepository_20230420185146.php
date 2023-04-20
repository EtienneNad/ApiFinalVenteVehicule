<?php

namespace App\Domain\Vehicules\Repository\Vehicule;

use PDO;
 /// Repository.
class ModifierVehiculeRepository
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
    public function ModificationVehicule(array $vehicule): array
    {
        $row = [
            'id' => $vehicule['id'],
            'titre' => $vehicule['titre'],
            'description' => $vehicule['description'],
            'duree' => $vehicule['duree'],
            'date_sortie' => $vehicule['date_sortie'],
            'auteur_id'=>$vehicule['auteur_id'],
            'dessinateur_id'=>$vehicule['dessinateur_id']
        ];

        $sql = 
            "UPDATE vehicule SET 
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
