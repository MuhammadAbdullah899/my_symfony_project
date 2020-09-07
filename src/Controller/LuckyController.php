<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;

class LuckyController extends AbstractController
{
	/**
	@Route("/index")
	*/
	public function index(Request $request)
	{
	    $c=$request->isXmlHttpRequest(); // is it an Ajax request?

	    $request->getPreferredLanguage(['en', 'fr']);

	    // retrieves GET and POST variables respectively
	    $a=$request->query->get('page');
	    $b=$request->request->get('page');

	    // retrieves SERVER variables
	    $request->server->get('HTTP_HOST');

	    // retrieves an instance of UploadedFile identified by foo
	    $request->files->get('foo');

	    // retrieves a COOKIE value
	    $request->cookies->get('PHPSESSID');

	    // retrieves an HTTP request header, with normalized, lowercase keys
	    $request->headers->get('host');
	    $request->headers->get('content-type');
	    return new Response(
             '<html><body>Lucky number: '.$a.'<br>'.$b.'<br>'.$c.'</body></html>'
         );
	}



	/**
     * @Route("/lucky/number/{max}", name="app_lucky_number")
     */


    public function number(SessionInterface $session, $max, LoggerInterface $logger): Response
    {
        $number = random_int(0, $max);

         //return $this->render('lucky/number.html.twig', [
         //    'number' => $number,
         //]);

        
         $logger->info('We are logging!');

        $url = $this->generateUrl('app_lucky_number', ['max' => 10]);

     //    $product=null;
	    // if (!$product) {
	    //     // throw $this->createNotFoundException('The product does not exist');

	    //     // the above is just a shortcut for:
	    //     // throw new NotFoundHttpException('The product does not exist');


	    //     throw new \Exception('Something went wrong');

	    // }

	    // stores an attribute for reuse during a later user request
	    $session->set('foo', 'bar');

	    // gets the attribute set by another controller in another request
	    $foobar = $session->get('foobar');

	     // uses a default value if the attribute doesn't exist
   		 $filters = $session->get('filters', []);
   		 $f=implode("",$filters);


        
         return new Response(
             '<html><body>Lucky number: '.$number.'<br>'.$url.'<br>'.$f.'</body></html>'
         );

        //return $this->redirectToRoute('homepage');

        //return $this->redirect('http://www.google.com');
    }
}
?>