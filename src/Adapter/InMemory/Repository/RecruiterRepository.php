<?php

namespace App\Adapter\InMemory\Repository;

use App\Adapter\InMemory\Repository\UserRepository;
use App\Entity\Recruiter;
use App\Gateway\RecruiterGateway;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * class RecruiterRepository
 * @package  App\Adapter\InMemory\Repository
 */
class RecruiterRepository extends UserRepository implements RecruiterGateway
{
    
    
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        parent::__construct($userPasswordEncoder);

        $recruiter = (new Recruiter())
        ->setFirstName("jhon")
        ->setLastName("Doe")
        ->setCompanyName("company")
        ->setEmail("recruiter@email.com");

        $recruiter->setPassword($userPasswordEncoder->encodePassword($recruiter, "Password123!"));

        $this->users[] = [
            "recruiter@email.com" => $recruiter
        ];
    }

    public function register(Recruiter $recruiter): void
    {
        //TODO: Implement register() method
    }
}
