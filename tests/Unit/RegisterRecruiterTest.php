<?php

namespace App\Tests\Unit;

use App\Entity\Recruiter;
use PHPUnit\Framework\TestCase;
use App\UseCase\RegisterRecruiter;
use Assert\LazyAssertionException;
use App\Adapter\InMemory\Repository\RecruiterRepository;

class RegisterRecruiterTest extends TestCase
{
 /**
     * @return void
     */
    public function testSuccessfullRegistration()
    {
        $useCase = new RegisterRecruiter(new RecruiterRepository());

        $recruiter = new Recruiter();
        $recruiter->setPlainPasword("password123!");
        $recruiter->setEmail("email@email.fr");
        $recruiter->setFirstName("Jhon");
        $recruiter->setLastName("Doe");
        $recruiter->setCompanyName("company");

        $this->assertEquals($recruiter, $useCase->execute($recruiter));
    }

    /**
     * @dataProvider provideBadRecruiter
     * @return void
     */
    public function testBadRecruiter(Recruiter $recruiter)
    {
        $useCase = new RegisterRecruiter(new RecruiterRepository());

        $this->expectException(LazyAssertionException::class);

        $useCase->execute($recruiter);
    }

    /**
     * provide Bad Recruiter (without firstName)
     *
     * @return \Generator
     */
    public function provideBadRecruiter(): \Generator
    {
        yield[
            (new Recruiter())
                ->setFirstName("Jhon")
                ->setLastName("Doe")
                ->setEmail("email@email.fr")
                ->setPlainPasword("password123!")
        ];

        yield[
            (new Recruiter())
                ->setFirstName("Jhon")
                ->setLastName("Doe")
                ->setEmail("email@email.fr")
                ->setPlainPasword("password123!")
                ->setCompanyName("")
        ];

        yield[
            (new Recruiter())
                ->setLastName("Doe")
                ->setEmail("email@email.fr")
                ->setPlainPasword("password123!")
                ->setCompanyName("company")
        ];

        yield[
            (new Recruiter())
                ->setFirstName('')
                ->setLastName("Doe")
                ->setEmail("email@email.fr")
                ->setPlainPasword("password123!")
                ->setCompanyName("company")
        ];

        yield[
            (new Recruiter())
                ->setFirstName("jhon")
                ->setEmail("email@email.fr")
                ->setPlainPasword("password123!")
                ->setCompanyName("company")
        ];

        yield[
            (new Recruiter())
                ->setFirstName('jhon')
                ->setLastName("")
                ->setEmail("email@email.fr")
                ->setPlainPasword("password123!")
                ->setCompanyName("company")
        ];

        yield[
            (new Recruiter())
                ->setFirstName("Jhon")
                ->setLastName("Doe")
                ->setPlainPasword("password123!")
                ->setCompanyName("company")
        ];

        yield[
            (new Recruiter())
                ->setFirstName("Jhon")
                ->setLastName("Doe")
                ->setEmail("")
                ->setPlainPasword("password123!")
                ->setCompanyName("company")
        ];

        yield[
            (new Recruiter())
                ->setFirstName("Jhon")
                ->setLastName("Doe")
                ->setEmail("fail")
                ->setPlainPasword("password123!")
                ->setCompanyName("company")
        ];

        yield[
            (new Recruiter())
                ->setFirstName("Jhon")
                ->setLastName("Doe")
                ->setEmail("email@email.fr")
                ->setCompanyName("company")
        ];

        yield[
            (new Recruiter())
                ->setFirstName("Jhon")
                ->setLastName("Doe")
                ->setEmail("email@email.fr")
                ->setPlainPasword("fail")
                ->setCompanyName("company")
        ];

        yield[
            (new Recruiter())
                ->setFirstName("Jhon")
                ->setLastName("Doe")
                ->setEmail("email@email.fr")
                ->setPlainPasword("")
                ->setCompanyName("company")
        ];
    }
}