<?php

namespace App\Entity;

use App\Repository\RecruiterRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Recruiter
 * @package App\Entity
 * @ORM\Entity
 */
class Recruiter extends User
{
    /**
     * @var string|null
     */
    private ?string $companyName = null;

    /**
     * Get the value of companyName
     *
     * @return  string|null
     */ 
    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    /**
     * Set the value of companyName
     *
     * @param  string|null  $companyName
     *
     * @return  self
     */ 
    public function setCompanyName(?string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }
}
