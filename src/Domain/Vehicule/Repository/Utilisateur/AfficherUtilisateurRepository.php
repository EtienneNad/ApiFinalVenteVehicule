<?php

namespace App\Domain\Vehicule\Repository\Utilisateur;

use PDO;
 /// Repository.
class AfficherUtilisateurRepository
{
   /**
     * @var PDO La connexion à la base de données
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
     * Sélectionne tous les utilisateurs de la table.
     *
     * @return array Les données des utilisateurs
     */
    public function SelectToutUtilisateur(): array
    {
        $sql = "SELECT * FROM utilisateurs";

        $query = $this->connection->prepare($sql);
        $query->execute();

        $resultat = $query->fetchAll(PDO::FETCH_ASSOC);

        return $resultat;
    }

    /**
     * Sélectionne un utilisateur par son identifiant.
     *
     * @param int $utilisateurId L'identifiant de l'utilisateur
     *
     * @return array Les données de l'utilisateur correspondant
     */
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
    /**
     * Sélectionne le mot de passe hashé d'un utilisateur par son nom d'utilisateur.
     *
     * @param string $username Le nom d'utilisateur
     *
     * @return string Le mot de passe hashé correspondant
     */
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

/**
     * Sélectionne la clé d'authentification d'un utilisateur par son nom d'utilisateur et son mot de passe.
     *
     * @param string $username Le nom d'utilisateur
     * @param string $motdepasse Le mot de passe
     *
     * @return array La clé d'authentification de l'utilisateur correspondant
     */
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
