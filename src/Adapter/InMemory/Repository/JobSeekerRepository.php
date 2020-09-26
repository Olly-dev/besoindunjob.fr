<?php

namespace App\Adapter\InMemory\Repository;

use App\Entity\JobSeeker;
use App\Gateway\JobSeekerGateway;

/**
 * class JobSeekerRepository
 * @package  App\Adapter\InMemory\Repository
 */
class JobSeekerRepository implements JobSeekerGateway
{
    public Function register(JobSeeker $jobSeeker): void
    {
        //TODO: Implement register() method
    }
}
