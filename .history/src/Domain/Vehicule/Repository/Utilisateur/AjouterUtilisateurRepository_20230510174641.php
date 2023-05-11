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
    public function SelectUtilisateurCle(string $username): array
    { 
            
        
        $params = [
            "username" => $username,
            
        ];
        $sql = "SELECT * FROM utilisateurs WHERE username =:username";

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

    public function InsererUtilisateur(array $utilisateur): int
    {
         $verifUtilisateur = $this->SelectUtilisateurCle($utilisateur['username']);
        if(empty($verifUtilisateur)){
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
    else{
        return "l'usager existe";
    }
    }
   
}

?>
