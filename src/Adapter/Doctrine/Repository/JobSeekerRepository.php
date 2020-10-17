<?php

namespace App\Adapter\Doctrine\Repository;

use App\Adapter\Doctrine\Repository\UserRepository;
use App\Entity\JobSeeker;
use App\Gateway\JobSeekerGateway;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @method JobSeeker|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobSeeker|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobSeeker[]    findAll()
 * @method JobSeeker[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobSeekerRepository extends UserRepository implements JobSeekerGateway
{
   

    public function __construct(ManagerRegistry $registry, UserPasswordEncoderInterface $userPasswordEncoder)
    {
        parent::__construct($registry, JobSeeker::class);

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
        $this->_em->persist($jobSeeker);
        $this->_em->flush();
    }

    // /**
    //  * @return JobSeeker[] Returns an array of JobSeeker objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?JobSeeker
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
