<?php

namespace App\Tests\System;

use App\Entity\Recruiter;
use App\Tests\System\SystemTestTrait;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use App\Tests\Integration\RegisterRecruiterTest;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * RegisterRecruiterSystemTest class
 * @package App\Tests\System
 */
class RegisterRecruiterSystemTest extends \App\Tests\Integration\RegisterRecruiterTest
{
    use SystemTestTrait;
}
