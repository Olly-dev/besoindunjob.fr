<?php

namespace App\UseCase;

use Assert\Assert;
use App\Entity\JobSeeker;
use App\Gateway\JobSeekerGateway;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * class RegisterJobSeeker
 * @package  App\UseCase
 */
class RegisterJobSeeker
{

    /**
     * @var JobSeekerGateway
     */
    private JobSeekerGateway $jobSeekerGateway;

    /**
     * @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $userPasswordEncoder;

    
    /**
     * RegisterJobSeeker constructor
     *
     * @param JobSeekerGateway $jobSeekerGateway
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     */
    public function __construct(JobSeekerGateway $jobSeekerGateway, UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->jobSeekerGateway = $jobSeekerGateway;
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    /**
     * @param JobSeeker $jobSeeker
     * @return JobSeeker
     */
    public function execute(JobSeeker $jobSeeker): JobSeeker
    {
        Assert::lazy()
            ->that($jobSeeker->getFirstName(), 'firstName')->notBlank()
            ->that($jobSeeker->getLastName(), 'lastName')->notBlank()
            ->that($jobSeeker->getPlainPassword(), 'plainPassword')
                ->notBlank()
                ->regex(
                    "/^(?:(?=.*[a-z])(?:(?=.*[A-Z])(?=.*[\d\W])|(?=.*\W)(?=.*\d))|(?=.*\W)(?=.*[A-Z])(?=.*\d)).{8,}$/"
                )
            ->that($jobSeeker->getEmail(), 'email')
                ->notBlank()
                ->email()
            ->verifyNow()
        ;

        $jobSeeker->setPassword(
            $this->userPasswordEncoder->encodePassword($jobSeeker, $jobSeeker->getPlainPassword())
        );
        

        $this->jobSeekerGateway->register($jobSeeker);

        return $jobSeeker;
    }
}
