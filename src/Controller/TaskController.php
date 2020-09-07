<?php
// src/Controller/TaskController.php
namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\Type\TaskType;
use Symfony\Component\Routing\Annotation\Route;


class TaskController extends AbstractController
{
    /**
    @Route("/new",name="task_success")
    */

    public function new(Request $request)
    {
        // creates a task object and initializes some data for this example
        $task = new Task();
//        $task->setTask('Write a blog post');
  //      $task->setDueDate(new \DateTime('tomorrow'));

         // use some PHP logic to decide if this form field is required or not
        $taskIsRequired = true;
        $dueDateIsRequired = true;

        $form = $this->createForm(TaskType::class, $task, [
            'require_due_date' => $dueDateIsRequired,
            'require_task' => $taskIsRequired,
        ]);



        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();

          

            return $this->redirectToRoute('task_success');
        }




        // ...
        return $this->render('task/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
?>