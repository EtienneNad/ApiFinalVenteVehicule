<?php

namespace App\Domain\Vehicule\Repository\Vehicule;

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

    public function SelectVehiculeId(int $vehiculeId, string $mot): array
    {
        $params = [
            "id" => $vehiculeId,
            "motdepasse" => $mot
        ];
        $sql = "SELECT motdepasse FROM ventevehicule WHERE id = :id";

        $query = $this->connection->prepare($sql)->execute($params);
        // if ($query){
        //     $resultat = $query->FETCH_ASSOC($mot);
        // }
        // else{
        //     return [];
        // }

        return $query;
    }
    
}
?>
