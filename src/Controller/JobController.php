<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobController extends AbstractController
{
    #[Route('/jobs', name: 'app_jobs')]
    public function jobs(): Response
    {
        return $this->render('job/index.html.twig', [

        ]);
    }

    #[Route('/jobs/{id}/detail', name: 'app_jobs_details')]
    public function jobDetailed(): Response
    {
        return $this->render('job/show.html.twig', [

        ]);
    }
}
