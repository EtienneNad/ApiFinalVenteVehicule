<?php

namespace App\Domain\Vehicule\Repository\Utilisateur;


use PDO;

 /// Repository.
class ModifierUtilisateurRepository
{
    /**
     * @var AfficherUtilisateurRepository
     */
    private $repository;
    /**
     * @var PDO The database connection
     */
    private $connection;
    
     /// Constructor.
    
     /**
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection, AfficherUtilisateurRepository $repository )
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
    public function ModificationUtilisateur(int $id, array $utilisateur): array
    {
        function Passgen1($nbChar) {
            $chaine ="mnoTUzS5678kVvwxy9WXYZRNCDEFrslq41GtuaHIJKpOPQA23LcdefghiBMbj0";
            srand((double)microtime()*1000000);
            $pass = '';
            for($i=0; $i<$nbChar; $i++){
                $pass .= $chaine[rand()%strlen($chaine)];
                }
            return $pass;
            }
        $Aleatoire = Passgen1(4);
        $row = [
            'id' => $id,
            'username' => $utilisateur['username'],
            'motdepasse' => password_hash($utilisateur['motdepasse'], PASSWORD_DEFAULT),
            'cle' => $utilisateur['cle'] . "_" . $Aleatoire
        ];

        $sql = 
            "UPDATE utilisateurs SET 
                username=:username, 
                motdepasse=:motdepasse, 
                cle=:cle 
                WHERE id =:id;";

        $this->connection->prepare($sql)->execute($row);
        $result = $this->SelectUtilisateurId($id);
        return $result;
    }
    
    public function SelectUtilisateurId(int $utilisateurId): array
    {
        $params = [
            "id" => $utilisateurId,
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
