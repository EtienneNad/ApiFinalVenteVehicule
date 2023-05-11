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
        
        $Aleatoire = CleGeneration(15);
        $row = [
            'username' => $utilisateur['username'],
            'motdepasse' => password_hash($utilisateur['motdepasse'],PASSWORD_DEFAULT),
            'cle' => $Aleatoire
            
        ];

        $sql = "INSERT INTO utilisateurs SET 
                username=:username, 
                motdepasse=:motdepasse, 
                cle=:cle;";

        $this->connection->prepare($sql)->execute($row);

        return (int)$this->connection->lastInsertId();
    }
   
}
function CleGeneration($nbChar) {
    $chaine ="mnoTUzS5678kVvwxy9WXYZRNCDEFrslq41GtuaHIJKpOPQA23LcdefghiBMbj0";
    srand((double)microtime()*1000000);
    $pass = '';
    for($i=0; $i<$nbChar; $i++){
        $pass .= $chaine[rand()%strlen($chaine)];
        }
    return $pass;
    }
?>
