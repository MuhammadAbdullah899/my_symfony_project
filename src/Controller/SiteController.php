<?php
// src/Controller/SiteController.php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
//use App\Service\MessageGenerator;
use App\Updates\SiteUpdateManager;


class SiteController extends AbstractController
{
	/**
	@Route("/newEM")*/
	public function new(SiteUpdateManager $siteUpdateManager)
	{
	    // ...

	    if ($siteUpdateManager->notifyOfSiteUpdate()) {
	        $this->addFlash('success', 'Notification mail was sent successfully.');
	    }

	    // ...


         return $this->render('base.html.twig');
	}
}


?>