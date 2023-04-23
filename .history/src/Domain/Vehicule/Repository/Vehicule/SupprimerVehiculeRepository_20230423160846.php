<?php

namespace App\Domain\Vehicule\Repository\Vehicule;

use PDO;
 /// Repository.
class SupprimerVehiculeRepository
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
    public function SupprimerVehicule(int $id): bool
    {
        $params = ['id' => $id];

        // Delete author reference from joint table livreauteur
        $sql = "DELETE FROM ventevehicule WHERE id = :id";
        $query = $this->connection->prepare($sql);
        $resultat = $query->execute($params);

        return $resultat;
    }

   
}
?>
