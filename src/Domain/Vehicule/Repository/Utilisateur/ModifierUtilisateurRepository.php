<?php

namespace App\Domain\Vehicule\Repository\Utilisateur;

use PDO;
 /// Repository.
class ModifierUtilisateurRepository
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
     * Insert user row.
     *
     * @param array $usager The user
     *
     * @return int The new ID
     */
    public function ModificationUtilisateur(array $utilisateur): array
    {
        $row = [
            'id' => $utilisateur['id'],
            'username' => $utilisateur['username'],
            'motdepasse' => $utilisateur['motdepasse'],
            'cle' => $utilisateur['cle']
        ];

        $sql = 
            "UPDATE utilisateurs SET 
                username=:username, 
                motdepasse=:motdepasse, 
                cle=:cle;";

        $this->connection->prepare($sql)->execute($row);
        return $row;
    }
   
}
?>
