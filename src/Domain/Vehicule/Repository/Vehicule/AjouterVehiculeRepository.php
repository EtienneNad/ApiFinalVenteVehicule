<?php

namespace App\Domain\Vehicule\Repository\Vehicule;

use PDO;

/**
 * Le repository pour l'ajout de véhicule
 */
class AjouterVehiculeRepository
{
    /**
     * @var PDO La connexion à la base de données
     */
    private $connection;
    
    /**
     * Constructeur.
     *
     * @param PDO $connection La connexion à la base de données
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Insère un nouveau véhicule dans la base de données.
     *
     * @param array $vehicule Les informations sur le véhicule à insérer
     * 
     * @return int L'identifiant de la ligne insérée
     */
    public function InsererVehicule(array $vehicule): int
    {

        $row = [
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

        $sql = "INSERT INTO ventevehicule SET 
        marque=:marque, 
        models=:models,
        prix=:prix,
        description=:description, 
        image_url=:image_url,
        nom_vendeur=:nom_vendeur, 
        adresse=:adresse,
        ville=:ville,
        courriel=:courriel,
        no_telephone=:no_telephone;";

        $this->connection->prepare($sql)->execute($row);

        return (int)$this->connection->lastInsertId();
    }

}
?>