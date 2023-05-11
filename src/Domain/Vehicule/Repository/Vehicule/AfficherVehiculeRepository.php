<?php

namespace App\Domain\Vehicule\Repository\Vehicule;

use PDO;

class AfficherVehiculeRepository
{
    /**
     * @var PDO La connexion à la base de données
     */
    private $connection;
    
     /// Constructeur.
    
     /**
     * @param PDO $connection La connexion à la base de données
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Sélectionne tous les véhicules de la base de données.
     *
     * @return array Les informations des véhicules
     */
    public function SelectToutVehicules(): array
    {
        $sql = "SELECT * FROM ventevehicule";

        $query = $this->connection->prepare($sql);
        $query->execute();

        $resultat = $query->fetchAll(PDO::FETCH_ASSOC);

        return $resultat;
    }

    /**
     * Sélectionne un véhicule par son identifiant.
     *
     * @param int $vehiculeId L'identifiant du véhicule
     *
     * @return array Les informations du véhicule
     */
    public function SelectVehiculeId(int $vehiculeId): array
    {
        $params = [
            "id" => $vehiculeId
        ];
        $sql = "SELECT * FROM ventevehicule WHERE id = :id";

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