<?php

namespace App\Adapter\Doctrine\Repository;

use App\Entity\Recruiter;
use App\Gateway\RecruiterGateway;
use Doctrine\Persistence\ManagerRegistry;
use App\Adapter\Doctrine\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @method Recruiter|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recruiter|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recruiter[]    findAll()
 * @method Recruiter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecruiterRepository extends UserRepository implements RecruiterGateway
{

    
    public function __construct(ManagerRegistry $registry, UserPasswordEncoderInterface $userPasswordEncoder)
    {
        parent::__construct($registry, Recruiter::class);

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
        $this->_em->persist($recruiter);
        $this->_em->flush();
    }

    // /**
    //  * @return Recruiter[] Returns an array of Recruiter objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Recruiter
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
