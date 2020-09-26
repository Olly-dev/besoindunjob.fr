<?php

namespace App\Tests\Unit;

use App\Adapter\InMemory\Repository\JobSeekerRepository;
use App\Entity\JobSeeker;
use App\UseCase\RegisterJobSeeker;
use Assert\LazyAssertionException;
use PHPUnit\Framework\TestCase;

class RegisterJobSeekerTest extends TestCase
{
    /**
     * @return void
     */
    public function testSuccessfullRegistration()
    {
        $useCase = new RegisterJobSeeker(new JobSeekerRepository());

        $jobSeeker = new JobSeeker();
        $jobSeeker->setPlainPasword("password123!");
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
        $useCase = new RegisterJobSeeker(new JobSeekerRepository());

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
                ->setPlainPasword("password123!")
        ];

        yield[
            (new JobSeeker())
                ->setFirstName('')
                ->setLastName("Doe")
                ->setEmail("email@email.fr")
                ->setPlainPasword("password123!")
        ];

        yield[
            (new JobSeeker())
                ->setFirstName("jhon")
                ->setEmail("email@email.fr")
                ->setPlainPasword("password123!")
        ];

        yield[
            (new JobSeeker())
                ->setFirstName('jhon')
                ->setLastName("")
                ->setEmail("email@email.fr")
                ->setPlainPasword("password123!")
        ];

        yield[
            (new JobSeeker())
                ->setFirstName("Jhon")
                ->setLastName("Doe")
                ->setPlainPasword("password123!")
        ];

        yield[
            (new JobSeeker())
                ->setFirstName("Jhon")
                ->setLastName("Doe")
                ->setEmail("")
                ->setPlainPasword("password123!")
        ];

        yield[
            (new JobSeeker())
                ->setFirstName("Jhon")
                ->setLastName("Doe")
                ->setEmail("fail")
                ->setPlainPasword("password123!")
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
                ->setPlainPasword("fail")
        ];

        yield[
            (new JobSeeker())
                ->setFirstName("Jhon")
                ->setLastName("Doe")
                ->setEmail("email@email.fr")
                ->setPlainPasword("")
        ];
    }
}