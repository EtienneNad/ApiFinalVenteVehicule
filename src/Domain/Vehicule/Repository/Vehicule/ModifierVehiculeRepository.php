<?php

namespace App\Domain\Vehicule\Repository\Vehicule;

use PDO;
 /// Repository.
class ModifierVehiculeRepository
{
  /**
     * @var PDO La connexion à la base de données
     */
    private $connection;
    /**
     * Constructeur
     * @param PDO $connection La connexion à la base de données
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }
    /**
     * Modifie un véhicule dans la base de données
     * @param array $vehicule Le tableau contenant les données du véhicule à modifier
     * @return array Le tableau contenant les nouvelles données du véhicule modifié
     */
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
