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

    public function SelectUtilisateurMotDePasse(string $username): string
    {
        $params = [
            "username" => $username,
            
        ];
        $sql = "SELECT motdepasse FROM utilisateurs WHERE username = :username ";

        $query = $this->connection->prepare($sql);
        $query->execute($params);
        if ($query){
            $resultat = $query->fetchall(PDO::FETCH_ASSOC);
            return $resultat[0]['motdepasse'];
        }
        else{
        return ''; // ou une autre valeur par défaut si le mot de passe n'est pas trouvé
        }
}

    public function SelectUtilisateurCle(string $username, string $motdepasse): array
    { 
        
        $motdepasseHash = $this->SelectUtilisateurMotDePasse($username);

        if(password_verify($motdepasse, $motdepasseHash))
        {
            
        
        $params = [
            "username" => $username,
            
        ];
        $sql = "SELECT cle FROM utilisateurs WHERE username =:username";

        $query = $this->connection->prepare($sql);
        $query->execute($params);
        if ($query){
            $resultat = $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }
        else{
            return [];
        }

        return $resultat;
    }
   
}
?>
