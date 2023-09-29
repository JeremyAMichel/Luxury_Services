<?php

namespace App\Controller;

use App\Entity\Candidate;
use App\Entity\Media;
use App\Entity\User;
use App\Form\CandidateType;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        /**
         * @var User $user
         */
        $user = $this->getUser();

        if ($user->getCandidate() == null) {
            $user->setCandidate(new Candidate());
        }


        $candidate = $user->getCandidate();

        $formCandidate = $this->createForm(CandidateType::class, $candidate);
        $formCandidate->handleRequest($request);

        if ($formCandidate->isSubmitted() && $formCandidate->isValid()) {

            $candidate->setCreatedAt(new DateTimeImmutable());
            $candidate->setUpdatedAt(new DateTimeImmutable());

            //PROFIL PICTURE
            if ($formCandidate['profilPicture']->getData()) {
                /**
                 * @var UploadedFile $profilPicture
                 */
                $profilPicture = $formCandidate['profilPicture']->getData();

                $profilPictureName = Uuid::v7() . $profilPicture->getClientOriginalName();
             
                $extension = $profilPicture->guessExtension();
                if(!$extension) {
                    $extension = 'png';
                    $profilPictureName . $extension;
                }
                $profilPicture->move('medias/profilPictures', $profilPictureName);

                $profilPictureMedia = new Media();
                $profilPictureMedia->setUrl($profilPictureName);
                $entityManager->persist($profilPictureMedia);

                $candidate->setProfilPicture($profilPictureMedia);

            }

            //PASSPORT
            if ($formCandidate['passportFile']->getData()) {
                /**
                 * @var UploadedFile $profilPicture
                 */
                $passportFile = $formCandidate['passportFile']->getData();

                $passportFileName = Uuid::v7() . $passportFile->getClientOriginalName();
             
                $extension = $passportFile->guessExtension();
                if(!$extension) {
                    $extension = 'png';
                    $passportFileName . $extension;
                }
                $passportFile->move('medias/passports', $passportFileName);

                $passportFileMedia = new Media();
                $passportFileMedia->setUrl($passportFileName);
                $entityManager->persist($passportFileMedia);

                $candidate->setPassportFile($passportFileMedia);

            }


            $entityManager->persist($candidate);
            $entityManager->flush();
        }

        return $this->render('profile/index.html.twig', [
            'candidate' => $candidate,
            'formCandidate' => $formCandidate
        ]);
    }
}
