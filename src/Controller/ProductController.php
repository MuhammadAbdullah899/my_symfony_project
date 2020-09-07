<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Repository\ProductRepository;
//use Psr\Log\LoggerInterface;
use App\Service\MessageGenerator;

class ProductController extends AbstractController
{
	/**
	@Route("/newM")
	*/
	public function new(MessageGenerator $messageGenerator)
	{
	    // thanks to the type-hint, the container will instantiate a
	    // new MessageGenerator and pass it to you!
	    // ...

	    $message = $messageGenerator->getHappyMessage();
	    $this->addFlash('success', $message);


         return $this->render('base.html.twig');

	    // ...
	}

	/**
     * @Route("/products")
     */
    public function list(LoggerInterface $logger)
    {
       $a = $logger->info('Look! I just used a service');
       return new Response("Hello World");

        // ...
    }


    /**
     * @Route("/product", name="create_product")
     */
    public function createProduct(ValidatorInterface $validator): Response
    {

        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $product = new Product();
        $product->setName('Keyboard');
        $product->setPrice(1999);
        $product->setDescription('Ergonomic and stylish!');
        $errors = $validator->validate($product);
        if (count($errors) > 0) {
            return new Response((string) $errors, 400);
        }


        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$product->getId());
    }


    /**
	 * @Route("/product/{minPrice}", name="product_show")
	 */
	public function show( ProductRepository $productRepository,int $minPrice)
	{
		//$product = $productRepository->find($product->getID());
	 //     // look for a single Product by name
	//	$product = $productRepository->findOneBy(['name' => 'Keyboard']);
		// // or find by name and price
		// $product = $repository->findOneBy([
		//     'name' => 'Keyboard',
		//     'price' => 1999,
		// ]);

		// look for multiple Product objects matching the name, ordered by price
		// $products = $productRepository->findBy(
		//     ['name' => 'Keyboard'],
		//     ['price' => 'ASC']
		// );

		// look for *all* Product objects
//		$products = $repository->findAll();
	 //   $minPrice = 1000;

		$products = $this->getDoctrine()
    		->getRepository(Product::class)
    		->findAllGreaterThanPrice($minPrice);


	    if (!$products) {
	        throw $this->createNotFoundException(
	            'No product found for id '.$id
	        );
	    }

	    return new Response('Check out this great product: '.$products[0]->getName());

	    // or render a template
	    // in the template, print things with {{ product.name }}
	    // return $this->render('product/show.html.twig', ['product' => $product]);
	}


	/**
	 * @Route("/product/edit/{id}")
	 */
	public function update($id)
	{
	    $entityManager = $this->getDoctrine()->getManager();
	    $product = $entityManager->getRepository(Product::class)->find($id);

	    if (!$product) {
	        throw $this->createNotFoundException(
	            'No product found for id '.$id
	        );
	    }

	    $product->setName('Mouse!');
	    $entityManager->flush();

	    return $this->redirectToRoute('product_show', [
	        'id' => $product->getId()
	    ]);
	}

	/**
	 * @Route("/product/delete/{id}")
	 */
	public function delete($id)
	{
	    $entityManager = $this->getDoctrine()->getManager();
	    $product = $entityManager->getRepository(Product::class)->find($id);

	    if (!$product) {
	        throw $this->createNotFoundException(
	            'No product found for id '.$id
	        );
	    }

	    $entityManager->remove($product);
	    $entityManager->flush();

		return new Response('Product '.$id.' is delted.');
	}
}