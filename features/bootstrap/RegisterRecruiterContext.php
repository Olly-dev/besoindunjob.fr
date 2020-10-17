<?php

namespace App\Features;

use App\Adapter\InMemory\Repository\RecruiterRepository;
use App\Entity\Recruiter;
use App\UseCase\RegisterRecruiter;
use Assert\Assertion;
use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class RegisterRecruiterContext
 * @package App\Features
 */
class RegisterRecruiterContext implements Context
{
    /**
     * @var RegisterRecruiter $registerRecruiter
     */
    private RegisterRecruiter $registerRecruiter;

    /**
     * @var Recruiter $recruiter
     */
    private Recruiter $recruiter;
    
    /**
     * @Given /^I need to register to recruit new employees$/
     */
    public function iNeedToRegisterToRecruitNewEmployees()
    {

        $userPasswordEncoder = new Class () implements UserPasswordEncoderInterface
        {
            public function encodePassword(UserInterface $user, string $plainPassword)
            {
                return "hash_password";
            }

            public function isPasswordValid(UserInterface $user, string $raw)
            {
            }

            public function needsRehash(UserInterface $user): bool
            {
            }
        };

        $this->registerRecruiter = new RegisterRecruiter(new RecruiterRepository($userPasswordEncoder));
    }
    
    /**
     *
     * @When /^I fill the registration form$/
     */
    public function iFillTheRegistrationForm()
    {
        $this->recruiter = new Recruiter();
        $this->recruiter->setPlainPassword("password123");
        $this->recruiter->setEmail("email@email.fr");
        $this->recruiter->setFirstName("Jhon");
        $this->recruiter->setLastName("Doe");
        $this->recruiter->setCompanyName("company");
    }

    /**
     * @Then /^I can log in with my new account$/
     */
    public function iCanLogInWithMyNewAccount()
    {
        Assertion::eq($this->recruiter, $this->registerRecruiter->execute($this->recruiter));
    }
}
