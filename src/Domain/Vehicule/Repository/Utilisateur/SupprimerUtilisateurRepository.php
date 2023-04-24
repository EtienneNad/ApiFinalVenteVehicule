<?php

namespace App\Domain\Vehicule\Repository\Utilisateur;

use PDO;
 /// Repository.
class SupprimerUtilisateurRepository
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
    /**
     * Delete an author by his id
     *
     * @param array $id The author id to delete
     *
     * @return bool Is the query succeed
     */
    public function SupprimerUtilisateur(int $id): bool
    {
        $params = ['id' => $id];

        // Delete author reference from joint table livreauteur
        $sqlUsager = "DELETE FROM utilisateurs WHERE id = :id";
        $query = $this->connection->prepare($sqlUsager);
        $resultat = $query->execute($params);

        



        return $resultat;
    }
   
}
?>
