<?php

namespace App\Domain\Vehicule\Repository\Utilisateur;

use PDO;
 /// Repository.
class AjouterUtilisateurRepository
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
     * @param array $user The user
     *
     * @return int The new ID
     */
    public function InsererUtilisateur(array $utilisateur): int
    {
        
        $row = [
            'username' => $utilisateur['username'],
            'motdepasse' => password_hash($utilisateur['motdepasse'],PASSWORD_DEFAULT),
            'cle' => base64_encode("username:" . $utilisateur['username']." motdepasse:".$utilisateur['motdepasse'] )
            
        ];

        $sql = "INSERT INTO utilisateurs SET 
                username=:username, 
                motdepasse=:motdepasse, 
                cle=:cle;";

        $this->connection->prepare($sql)->execute($row);

        return (int)$this->connection->lastInsertId();
    }
   
}

?>
