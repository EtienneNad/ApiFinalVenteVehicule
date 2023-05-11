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
     * Mettre à jour une ligne d'utilisateur dans la base de données.
     *
     * @param array $utilisateur Les données de l'utilisateur à mettre à jour
     *
     * @return array Les données de l'utilisateur mises à jour
     */
    public function ModificationUtilisateur(array $utilisateur): array
    {
        
        
        $row = [
            'id' => $utilisateur['id'],
            'username' => $utilisateur['username'],
            'motdepasse' => password_hash($utilisateur['motdepasse'], PASSWORD_DEFAULT),
            'cle' =>  base64_encode("username:" . $utilisateur['username']." motdepasse:".$utilisateur['motdepasse'] )
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
