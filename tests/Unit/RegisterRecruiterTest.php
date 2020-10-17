<?php

namespace App\Tests\Unit;

use App\Entity\Recruiter;
use PHPUnit\Framework\TestCase;
use App\UseCase\RegisterRecruiter;
use Assert\LazyAssertionException;
use App\Adapter\InMemory\Repository\RecruiterRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterRecruiterTest extends TestCase
{
 /**
     * @return void
     */
    public function testSuccessfullRegistration()
    {
        $userPasswordEncoder = $this->createMock(UserPasswordEncoderInterface::class);
        $userPasswordEncoder->method("encodePassword")->willReturn("hash_password");

        $useCase = new RegisterRecruiter(new RecruiterRepository($userPasswordEncoder), $userPasswordEncoder);

        $recruiter = new Recruiter();
        $recruiter->setPlainPassword("password123!");
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
        $userPasswordEncoder = $this->createMock(UserPasswordEncoderInterface::class);
        $userPasswordEncoder->method("encodePassword")->willReturn("hash_password");

        $useCase = new RegisterRecruiter(new RecruiterRepository($userPasswordEncoder), $userPasswordEncoder);

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
                ->setPlainPassword("password123!")
        ];

        yield[
            (new Recruiter())
                ->setFirstName("Jhon")
                ->setLastName("Doe")
                ->setEmail("email@email.fr")
                ->setPlainPassword("password123!")
                ->setCompanyName("")
        ];

        yield[
            (new Recruiter())
                ->setLastName("Doe")
                ->setEmail("email@email.fr")
                ->setPlainPassword("password123!")
                ->setCompanyName("company")
        ];

        yield[
            (new Recruiter())
                ->setFirstName('')
                ->setLastName("Doe")
                ->setEmail("email@email.fr")
                ->setPlainPassword("password123!")
                ->setCompanyName("company")
        ];

        yield[
            (new Recruiter())
                ->setFirstName("jhon")
                ->setEmail("email@email.fr")
                ->setPlainPassword("password123!")
                ->setCompanyName("company")
        ];

        yield[
            (new Recruiter())
                ->setFirstName('jhon')
                ->setLastName("")
                ->setEmail("email@email.fr")
                ->setPlainPassword("password123!")
                ->setCompanyName("company")
        ];

        yield[
            (new Recruiter())
                ->setFirstName("Jhon")
                ->setLastName("Doe")
                ->setPlainPassword("password123!")
                ->setCompanyName("company")
        ];

        yield[
            (new Recruiter())
                ->setFirstName("Jhon")
                ->setLastName("Doe")
                ->setEmail("")
                ->setPlainPassword("password123!")
                ->setCompanyName("company")
        ];

        yield[
            (new Recruiter())
                ->setFirstName("Jhon")
                ->setLastName("Doe")
                ->setEmail("fail")
                ->setPlainPassword("password123!")
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
                ->setPlainPassword("fail")
                ->setCompanyName("company")
        ];

        yield[
            (new Recruiter())
                ->setFirstName("Jhon")
                ->setLastName("Doe")
                ->setEmail("email@email.fr")
                ->setPlainPassword("")
                ->setCompanyName("company")
        ];
    }
}
