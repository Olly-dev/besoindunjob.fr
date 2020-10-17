<?php

namespace App\Controller;

use App\Entity\JobSeeker;
use App\UseCase\RegisterJobSeeker;
use App\Form\JobSeekerRegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * RegisterJobSeekerController class
 * @package App\Controller
 */
class RegisterJobSeekerController
{
    private FormFactoryInterface $formFactory;
    private RegisterJobSeeker $jebSeekerRegister;
    private UrlGeneratorInterface $urlGenerator;
    private Environment $twig;

    /**
     * RegisterJobSeekerController constructor
     *
     * @param FormFactoryInterface $formFactory
     * @param RegisterJobSeeker $jebSeekerRegister
     * @param UrlGeneratorInterface $urlGenerator
     * @param Environment $twig
     */
    public function __construct(
        FormFactoryInterface $formFactory,
        RegisterJobSeeker $jebSeekerRegister,
        UrlGeneratorInterface $urlGenerator,
        Environment $twig
    ) {
        $this->formFactory = $formFactory;
        $this->jebSeekerRegister = $jebSeekerRegister;
        $this->urlGenerator = $urlGenerator;
        $this->twig = $twig;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function __invoke(Request $request): Response
    {
        $jobSeeker = new JobSeeker();

        $form = $this->formFactory->create(JobSeekerRegistrationType::class, $jobSeeker)->handleRequest($request);

        if ($form->isSubmitted()  && $form->isValid()) {
            $this->jebSeekerRegister->execute($jobSeeker);

            return new RedirectResponse($this->urlGenerator->generate("index"));
        }

        return new Response($this->twig->render("ui/register_job_seeker.html.twig", [
            'form' => $form->createView()
        ]));
    }
}
