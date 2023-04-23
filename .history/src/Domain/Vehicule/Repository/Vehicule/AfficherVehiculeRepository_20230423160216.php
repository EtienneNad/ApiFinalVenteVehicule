<?php

namespace App\Domain\Vehicules\Repository\Vehicule;

use PDO;
 /// Repository.
class AfficherVehiculeRepository
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

    public function SelectToutVehicules(): array
    {
        $sql = "SELECT * FROM ventevehicule";

        $query = $this->connection->prepare($sql);
        $query->execute();

        $resultat = $query->fetchAll(PDO::FETCH_ASSOC);

        return $resultat;
    }

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
