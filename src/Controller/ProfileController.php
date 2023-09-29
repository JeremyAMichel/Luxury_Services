<?php

namespace App\Controller;

use App\Entity\Candidate;
use App\Form\CandidateType;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        if($this->getUser()->getCandidate() == null)
        {
            $this->getUser()->setCandidate(new Candidate());
        }
        
        

        $candidate = $this->getUser()->getCandidate();

        $formCandidate = $this->createForm(CandidateType::class, $candidate);
        $formCandidate->handleRequest($request);

        if($formCandidate->isSubmitted() && $formCandidate->isValid())
        {

            $candidate->setCreatedAt(new DateTimeImmutable());
            $candidate->setUpdatedAt(new DateTimeImmutable());
            // dd($candidate);

            $entityManager->persist($candidate);
            $entityManager->flush();
        }
        
        return $this->render('profile/index.html.twig', [
            'candidate' => $candidate,
            'formCandidate' => $formCandidate
        ]);
    }
}
