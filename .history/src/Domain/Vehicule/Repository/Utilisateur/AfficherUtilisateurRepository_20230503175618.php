<?php

namespace App\Domain\Vehicule\Repository\Utilisateur;

use PDO;
 /// Repository.
class AfficherUtilisateurRepository
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
    public function SelectToutUtilisateur(): array
    {
        $sql = "SELECT * FROM utilisateurs";

        $query = $this->connection->prepare($sql);
        $query->execute();

        $resultat = $query->fetchAll(PDO::FETCH_ASSOC);

        return $resultat;
    }
    public function SelectUtilisateurUsername(int $id): array
    {
        $params = [
            "id" => $id
        ];
        $sql = "SELECT * FROM utilisateurs WHERE id = :id";

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
