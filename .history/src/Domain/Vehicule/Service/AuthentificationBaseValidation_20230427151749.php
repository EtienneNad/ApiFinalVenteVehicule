<?php

namespace App\Domain\Vehicule\Service;

use App\Domain\Vehicule\Repository\AuthentificationBaseRepository;

/**
 * Service.
 */
final class AuthentificationBaseValidation
{
    /**
     * @var AuthentificationBaseRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param AuthentificationBaseRepository $repository The repository
     */
    public function __construct(AuthentificationBaseRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Validate the token
     * 
     * Decode token has this format : username:****** password:******
     *
     * @param string $token base64 encoded token
     *
     * @return bool true if the token is valid
     */
    public function TokenEstValide(string $token): bool
    {
        // Decode the token to a string
        $decripteToken = base64_decode($token);
        // Split the decode token in two part and keep only username and password value.
        $utilisateur = str_replace('username:','',explode(' ', $decripteToken)[0] ?? '');
        $motsPasse = str_replace('motdepasse:','',explode(' ', $decripteToken)[1] ?? '');
        // Find the password stored in the BD for the username
        $motsPasseCryptee = $this->repository->SelectMotsPasseCrypte($utilisateur);
        // Verify that the two password are identical
       
        return password_verify($motsPasse, $motsPasseCryptee);

    }
}
