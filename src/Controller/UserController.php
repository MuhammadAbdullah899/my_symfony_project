<?php
// src/Controller/UserController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response;
use Psr\Log\LoggerInterface;

class UserController extends AbstractController
{
    /**
    @Route("/loger")
    */

    public function index(LoggerInterface $logger)
    {
        $logger->info('I just got the logger');
        $logger->error('An error occurred');

        $logger->critical('I left the oven on!', [
            // include extra "context" info in your logs
            'cause' => 'in_hurry',
        ]);

        return $this->render('base.html.twig');
    }

    /**
    @Route("user/notification")
    */

    public function notifications()
    {
        // get the user information and notifications somehow
        $userFirstName = 'abdulllah';
        $userNotifications = ['hello', 'hi'];

        // the template path is the relative file path from `templates/`
        // return $this->render('User/notifications.html.twig', [
        //     // this array defines the variables passed to the template,
        //     // where the key is the variable name and the value is the variable value
        //     // (Twig recommends using snake_case variable names: 'foo_bar' instead of 'fooBar')
        //     'user_first_name' => $userFirstName,
        //     'notifications' => $userNotifications,
        // ]);

        $contents = $this->render('User/notifications.html.twig', [
            // this array defines the variables passed to the template,
            // where the key is the variable name and the value is the variable value
            // (Twig recommends using snake_case variable names: 'foo_bar' instead of 'fooBar')
            'user_first_name' => $userFirstName,
            'notifications' => $userNotifications,
        ]);

        return new Response($contents);
    }
}
?>