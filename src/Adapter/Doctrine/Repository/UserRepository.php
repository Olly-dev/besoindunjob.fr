<?php

namespace App\Adapter\Doctrine\Repository;

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
 * @package  App\Adapter\Doctrine\Repository
 */
class UserRepository extends ServiceEntityRepository implements UserGateway
{

    /**
     * @var Users[]
     */
    private array $users = [];

    /**
     *  @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $userPasswordEncoder;


    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    
    public function findByEmail(string $email): ?UserInterface
    {
        if (!isset($this->users[$email])) {
            throw new UsernameNotFoundException();
        }

        return $this->users[$email];
    }
}
