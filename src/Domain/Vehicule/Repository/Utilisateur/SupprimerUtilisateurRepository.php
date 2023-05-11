<?php

namespace App\Domain\Vehicule\Repository\Utilisateur;

use PDO;
 /// Repository.
class SupprimerUtilisateurRepository
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
     * supprimer un utilisateur 
     *
     * @param array $id c'est l'id de l'utilisateur a supprimer
     * @return bool est l'état de de la supression
     */
    public function SupprimerUtilisateur(int $id): bool
    {
        $params = ['id' => $id];

        // Delete author reference from joint table livreauteur
        $sqlUsager = "DELETE FROM utilisateurs WHERE id = :id";
        $query = $this->connection->prepare($sqlUsager);
        $resultat = $query->execute($params);

        



        return $resultat;
    }
   
}
?>
