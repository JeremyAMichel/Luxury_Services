<?php

namespace App\Controller\Admin;

use App\Entity\Candidate;
use App\Entity\Category;
use App\Entity\Client;
use App\Entity\Experience;
use App\Entity\Gender;
use App\Entity\Offer;
use App\Entity\Product;
use App\Entity\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    private $em;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //

        // $em = $this->getDoctrine()->getManager();
        // $candidatRepo = $this->em->getRepository(Candidate::class);
        // dd($candidatRepo->findAll());

        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Luxury Services');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Gender', 'fa fa-briefcase', Gender::class);
        yield MenuItem::linkToCrud('Experience', 'fa fa-briefcase', Experience::class);
        yield MenuItem::linkToCrud('Category', 'fa fa-briefcase', Category::class);
        yield MenuItem::linkToCrud('Type', 'fa fa-briefcase', Type::class);
        yield MenuItem::linkToCrud('Client', 'fa fa-briefcase', Client::class);
        yield MenuItem::linkToCrud('Offer', 'fa fa-briefcase', Offer::class);
        // yield MenuItem::linkToCrud('Candidate', 'fa fa-briefcase', Candidate::class);
    }
}
