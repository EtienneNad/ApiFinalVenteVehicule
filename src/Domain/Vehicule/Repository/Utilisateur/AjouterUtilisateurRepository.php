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
    
     /**
     * Constructeur.
     *
     * @param PDO $connection La connexion à la base de données
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Vérifie si un utilisateur existe déjà dans la base de données.
     *
     * @param string $username Le nom d'utilisateur à vérifier
     * 
     * @return array Le résultat de la requête de sélection
     */
    public function VerificationUtilisateur(string $username): array
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
    /**
     * Insère un utilisateur dans la base de données.
     *
     * @param array $utilisateur Le tableau contenant les informations de l'utilisateur à insérer
     * 
     * @return int L'identifiant de l'utilisateur inséré
     */

    public function InsererUtilisateur(array $utilisateur): int
    {
           $verifUtilisateur = $this->VerificationUtilisateur($utilisateur['username']);
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
        }
            return (int)$this->connection->lastInsertId();
        
        
     }
   
}

?>
