<?php
// src/Controller/BlogController.php
namespace App\Controller;

use App\Entitiy\BlogPost;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends AbstractController
{

    /*
     * @Route("/blog/{page}", name="blog_list, requirements={"page"="\d+"})
     */
/*    public function list(int $page = 0 )
    {
        // ...
        return new Response(
            '<html><body>blog number is : '.$page.'</body></html>'
        );
    }
*/
    /**
     * @Route("/blog", name="blog_list")
     */
    public function list(Request $request)
    {
        // ...

        $routeName = $request->attributes->get('_route');
        $routeParameters = $request->attributes->get('_route_params');

        // use this to get all the available attributes (not only routing ones):
        $allAttributes = $request->attributes->all();
        return new Response(
            '<html><body>Route name is : '.$routeName.'</body></html>'
        );
    }

    /**
     * @Route("/blog/{slug}", name="blog_show")
     */
    public function show(BlogPost $post)
    {
        // ...
        return new Response(
            '<html><body>blog show is : '.$post->slug.'</body></html>'
        );
    }

    /**
     * @Route("/share/{token}", name="share", requirements={"token"=".+"})
     */
    public function share($token)
    {
        // ...
        return new Response(
            '<html><body>blog show is : '.$token.'</body></html>'
        );
    }
    /**
     * @Route(
     *     "/",
     *     name="mobile_homepage",
     *     host="{subdomain}.example.com",
     *     defaults={"subdomain"="m"},
     *     requirements={"subdomain"="m|mobile"}
     * )
     */
    public function mobileHomepage()
    {
        // .......
        return new Response(
            '<html><body> moile home page </body></html>'
        );
    }

    /**
     * @Route("/home", name="homepage")
     */
    public function homepage()
    {
        
        // ...
        return new Response(
            '<html><body>Home page</body></html>'
        );
    }
}
?>