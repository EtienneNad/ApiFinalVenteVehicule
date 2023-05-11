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
        
        $Aleatoire = base64_encode("username:" . $utilisateur['username']." motdepasse:".$utilisateur['motdepasse'] );
        $row = [
            'id' => $utilisateur['id'],
            'username' => $utilisateur['username'],
            'motdepasse' => password_hash($utilisateur['motdepasse'], PASSWORD_DEFAULT),
            'cle' =>  $Aleatoire
        ];

        $sql = 
            "UPDATE utilisateurs SET 
                username=:username, 
                motdepasse=:motdepasse, 
                cle=:cle 
                WHERE id =:id;";

        $this->connection->prepare($sql)->execute($row);
        return $row;
    }
   
}
?>
