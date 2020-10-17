<?php

namespace App\Adapter\InMemory\Repository;

use App\Entity\User;
use App\Entity\JobSeeker;
use App\Entity\Recruiter;
use App\Gateway\UserGateway;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * class UserRepository
 * @package  App\Adapter\InMemory\Repository
 */
class UserRepository extends ServiceEntityRepository implements UserGateway
{

    /**
     * @var User[]
     */
    public array $users = [];

    /**
     * UserRepository constructor
     *
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        //parent::__construct($registry, User::class);

        $jobSeeker = (new JobSeeker())
                ->setFirstName("John")
                ->setLastName("Doe")
                ->setEmail("job.seeker@email.com")
        ;

        $jobSeeker->setPassword($userPasswordEncoder->encodePassword($jobSeeker, "Password123!"));

        $recruiter = (new Recruiter())
                ->setFirstName("Janne")
                ->setLastName("Doe")
                ->setCompanyName("Company")
                ->setEmail("recruiter@email.com")
        ;

        $recruiter->setPassword($userPasswordEncoder->encodePassword($recruiter, "Password123!"));

        $this->users = [
            "job.seeker@email.com" => $jobSeeker,
            "recruiter@email.com" => $jobSeeker,
        ];
    }

    /**
     * @inheritDoc
     */
    public function findByEmail(string $email): ?UserInterface
    {
        if (!isset($this->users[$email])) {
            throw new UsernameNotFoundException();
        }

        return $this->users[$email];
    }
}
