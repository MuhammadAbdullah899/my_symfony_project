<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();

        // // redirect to some CRUD controller
        // $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

        // return $this->redirect($routeBuilder->setController(OneOfYourCrudController::class)->generateUrl());

        // // you can also redirect to different pages depending on the current user
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // // you can also render some template to display a proper Dashboard
        // // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        //return Dashboard::new()
        //    ->setTitle('My Symfony Project');


        return Dashboard::new()
            // the name visible to end users
            ->setTitle('ACME Corp.')
            // you can include HTML contents too (e.g. to link to an image)
            ->setTitle('<img src="..."> ACME <span class="text-small">Corp.</span>')

            // the path defined in this method is passed to the Twig asset() function
            ->setFaviconPath('favicon.svg')

            // the domain used by default is 'messages'
            ->setTranslationDomain('my-custom-domain')

            // there's no need to define the "text direction" explicitly because
            // its default value is inferred dynamically from the user locale
            ->setTextDirection('ltr')
        ;

    }

    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'icon class', EntityClass::class);

         return [

             MenuItem::linkToRoute('The Label', 'fa ...', 'route_name'),
        MenuItem::linkToRoute('The Label', 'fa ...', 'route_name'),

            MenuItem::linkToDashboard('Home', 'fa fa-home'),
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),

            MenuItem::section('Blog'),
            MenuItem::linkToCrud('Categories', 'fa fa-tags', Category::class),
            MenuItem::linkToCrud('Blog Posts', 'fa fa-file-text', BlogPost::class),

            MenuItem::section('Users'),
            MenuItem::linkToCrud('Comments', 'fa fa-comment', Comment::class),
            MenuItem::linkToCrud('Users', 'fa fa-user', User::class),

            // links to the 'index' action of the Category CRUD controller
        MenuItem::linkToCrud('Categories', 'fa fa-tags', Category::class),

        // links to a different CRUD action
        MenuItem::linkToCrud('Add Category', 'fa fa-tags', Category::class)
            ->setAction('new'),

        MenuItem::linkToCrud('Show Main Category', 'fa fa-tags', Category::class)
            ->setAction('detail')
            ->setEntityId(1),

        // if the same Doctrine entity is associated to more than one CRUD controller,
        // use the 'setController()' method to specify which controller to use
        MenuItem::linkToCrud('Categories', 'fa fa-tags', Category::class)
            ->setController(LegacyCategoryCrudController::class),

        // uses custom sorting options for the listing
        MenuItem::linkToCrud('Categories', 'fa fa-tags', Category::class)
            ->setQueryParameter('sortField', 'createdAt')
            ->setQueryParameter('sortDirection', 'DESC'),
        ];




    }
}
