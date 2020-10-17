<?php

namespace App\Adapter\InMemory\Repository;

use App\Adapter\InMemory\Repository\UserRepository;
use App\Entity\JobSeeker;
use App\Gateway\JobSeekerGateway;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * class JobSeekerRepository
 * @package  App\Adapter\InMemory\Repository
 */
class JobSeekerRepository extends UserRepository implements JobSeekerGateway
{

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        parent::__construct($userPasswordEncoder);

        $jobSeeker = (new JobSeeker())
        ->setFirstName("jhon")
        ->setLastName("Doe")
        ->setEmail("job.seeker@email.com");

        $jobSeeker->setPassword($userPasswordEncoder->encodePassword($jobSeeker, "Password123!"));

        $this->users[] = [
            "job.seeker@email.com" => $jobSeeker
        ];
    }

    public function register(JobSeeker $jobSeeker): void
    {
        //TODO: Implement register() method
    }
}
