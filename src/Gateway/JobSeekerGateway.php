<?php

namespace App\Gateway;

use App\Entity\JobSeeker;

/**
 * Interface JobSeekerGateway
 * @package App\Gateway
 */
interface JobSeekerGateway extends UserGateway
{
    /**
     * @param JobSeeker $jobSeeker
     * @return void
     */
    public function register(JobSeeker $jobSeeker): void;
}
