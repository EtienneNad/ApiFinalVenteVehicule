<?php

namespace App\Domain\Animes\Repository;

use PDO;

 /// Repository.
 
class AuthentificationBaseRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;

    
     
    /// Constructeur.
     
    /**
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    
     /// Select username hashed password
     
     /** 
     * @param string $username The username to select
     *
     * @return bool true if the token is valid
     */
    public function SelectMotsPasseCrypte($utilisateur): string
    {
        $params = ["username" => $utilisateur];

        $sql = "SELECT motdepasse FROM utilisateurs WHERE username = :username";

        $query = $this->connection->prepare($sql);
        $query->execute($params);

        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $MotsPasseCrypte = $result[0]['motdepasse'] ?? ''; 

        return $MotsPasseCrypte;
}
    }

