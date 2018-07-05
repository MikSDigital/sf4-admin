<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Entity\Task;
use App\Form\Type\TaskType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestFormController extends Controller
{
    private $value = null;

    /**
     * @Route("/test/form", name="test_form")
     */
    public function new(Request $oRequest)
    {
        $task = new Task();

        $tag1 = new Tag();
        $tag1->setName('N 1');
        $task->getTags()->add($tag1);

        $tag2 = new Tag();
        $tag2->setName('N 2');
        $task->getTags()->add($tag2);

   if ($this->get('session')->get('flag')) {
       $tag3 = new Tag();
       $tag3->setName('N 2 BINGO!');
       $task->getTags()->add($tag3);
   }


        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($oRequest);

        if ($form->isSubmitted() && $form->isValid()) {


            $oTask = $form->getData();

            $this->value = $oTask->getDescription();

            dump($this->value);

            $this->get('session')->set('flag', $this->value);
        }


        return $this->render('test_form/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
