<?php

namespace App\Controller;


use App\Entity\MyTask;
use App\Form\MyTaskType1;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MyTaskController extends AbstractController
{
    /**
     * @Route("/task", name="task")
     */
    public function index()
    {
        return $this->render('my_task/index.html.twig', [
            'controller_name' => 'MyTaskController',
        ]);
    }
    /**
     * @Route("/tasks",name="list_task")
     */
    public function list( )
    {
        $entityManager = $this->getDoctrine()->getManager();
        $myTasks = $entityManager->getRepository(MyTask::class)->findAll();
        if (!$myTasks) {
            throw $this->createNotFoundException(
                'No task found.'
            );
        }
        return $this->render('my_task/list.html.twig', [
            'myTasks'=>$myTasks,
        ]);
    }

    /**
     * @Route("/tasks/update/{id}")
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function update(int $id,Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $myTask = $entityManager->getRepository(MyTask::class)->find($id);

        if (!$myTask) {
            throw $this->createNotFoundException(
                'No task found for id '.$id
            );
        }
        $myTask->setUpdated(new DateTime());

        $form = $this->createForm(MyTaskType1::class, $myTask);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $myTask = $form->getData();

            $entityManager->persist($myTask);
            $entityManager->flush();

            return new Response('Saved new task with id '.$myTask->getId());
        }
        return $this->render('my_task/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/tasks/delete/{id}")
     * @param int $id
     * @return Response
     */
    public function delete(int $id ): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $myTask = $entityManager->getRepository(MyTask::class)->find($id);

        if (!$myTask) {
            throw $this->createNotFoundException(
                'No task found for id '.$id
            );
        }

        $entityManager->remove($myTask);
        $entityManager->flush();

        return new Response('Task '.$id.' is deleted.');
    }

    /**
     * @Route("/tasks/show/{id}")
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $myTask = $entityManager->getRepository(MyTask::class)->find($id);

        if (!$myTask) {
            throw $this->createNotFoundException(
                'No task found for id '.$id
            );
        }

        return new Response( $this->render('/my_task/show.html.twig',
            ['myTask'=>$myTask,
                ])
        );
    }

    /**
     * @Route("/tasks/create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        // creates a task object and initializes some data for this example
        $myTask = new MyTask();
        $myTask->setTask('Write a blog post');
        $myTask->setDueDate(new DateTime('tomorrow'));
        $myTask->setCreated(new DateTime());
        $myTask->setUpdated(new DateTime());

        $form = $this->createForm(MyTaskType1::class, $myTask);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $myTask = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($myTask);
             $entityManager->flush();

            return new Response('Saved new task with id '.$myTask->getId());
      }

        return $this->render('my_task/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
