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
            'marque' => $vehicule['marque'],
            'models' => $vehicule['models'],
            'prix' => $vehicule['prix'],
            'description' => $vehicule['description'],
            'image_url' => $vehicule['image_url'],
            'nom_vendeur' => $vehicule['nom_vendeur'],
            'adresse' => $vehicule['adresse'],
            'ville'=>$vehicule['ville'],
            'courriel'=>$vehicule['courriel'],
            'no_telephone' => $vehicule['no_telephone']
        ];

        $sql = 
            "UPDATE ventevehicule SET 
                marque=:marque, 
                models=:models,
                prix=:prix,
                description=:description, 
                image_url=:image_url,
                nom_vendeur=:nom_vendeur, 
                adresse=:adresse,
                ville=:ville,
                courriel=:courriel,
                no_telephone=:no_telephone
                WHERE id =:id;";

        $this->connection->prepare($sql)->execute($row);
        return $row;
    }

}
?>
