<?php

namespace App\Tests\Unit;

use App\Entity\JobSeeker;
use PHPUnit\Framework\TestCase;
use App\UseCase\RegisterJobSeeker;
use Assert\LazyAssertionException;
use App\Adapter\InMemory\Repository\JobSeekerRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * RegisterJobSeekerTest class
 * @package App\Tests\Unit
 */
class RegisterJobSeekerTest extends TestCase
{
    /**
     * @return void
     */
    public function testSuccessfullRegistration()
    {
        $userPasswordEncoder = $this->createMock(UserPasswordEncoderInterface::class);
        $userPasswordEncoder->method("encodePassword")->willReturn("hash_password");

        $useCase = new RegisterJobSeeker(new JobSeekerRepository($userPasswordEncoder), $userPasswordEncoder);

        $jobSeeker = new JobSeeker();
        $jobSeeker->setPlainPassword("password123!");
        $jobSeeker->setEmail("email@email.fr");
        $jobSeeker->setFirstName("Jhon");
        $jobSeeker->setLastName("Doe");

        $this->assertEquals($jobSeeker, $useCase->execute($jobSeeker));
    }

    /**
     * @dataProvider provideBadJobSeeker
     * @return void
     */
    public function testBadJobSeeker(JobSeeker $jobSeeker)
    {
        $userPasswordEncoder = $this->createMock(UserPasswordEncoderInterface::class);
        $userPasswordEncoder->method("encodePassword")->willReturn("hash_password");

        $useCase = new RegisterJobSeeker(new JobSeekerRepository($userPasswordEncoder), $userPasswordEncoder);

        $this->expectException(LazyAssertionException::class);

        $useCase->execute($jobSeeker);
    }

    /**
     * provide Bad JobSeeker (without firstName)
     *
     * @return \Generator
     */
    public function provideBadJobSeeker(): \Generator
    {
        yield[
            (new JobSeeker())
                ->setLastName("Doe")
                ->setEmail("email@email.fr")
                ->setPlainPassword("password123!")
        ];

        yield[
            (new JobSeeker())
                ->setFirstName('')
                ->setLastName("Doe")
                ->setEmail("email@email.fr")
                ->setPlainPassword("password123!")
        ];

        yield[
            (new JobSeeker())
                ->setFirstName("jhon")
                ->setEmail("email@email.fr")
                ->setPlainPassword("password123!")
        ];

        yield[
            (new JobSeeker())
                ->setFirstName('jhon')
                ->setLastName("")
                ->setEmail("email@email.fr")
                ->setPlainPassword("password123!")
        ];

        yield[
            (new JobSeeker())
                ->setFirstName("Jhon")
                ->setLastName("Doe")
                ->setPlainPassword("password123!")
        ];

        yield[
            (new JobSeeker())
                ->setFirstName("Jhon")
                ->setLastName("Doe")
                ->setEmail("")
                ->setPlainPassword("password123!")
        ];

        yield[
            (new JobSeeker())
                ->setFirstName("Jhon")
                ->setLastName("Doe")
                ->setEmail("fail")
                ->setPlainPassword("password123!")
        ];

        yield[
            (new JobSeeker())
                ->setFirstName("Jhon")
                ->setLastName("Doe")
                ->setEmail("email@email.fr")
        ];

        yield[
            (new JobSeeker())
                ->setFirstName("Jhon")
                ->setLastName("Doe")
                ->setEmail("email@email.fr")
                ->setPlainPassword("fail")
        ];

        yield[
            (new JobSeeker())
                ->setFirstName("Jhon")
                ->setLastName("Doe")
                ->setEmail("email@email.fr")
                ->setPlainPassword("")
        ];
    }
}
