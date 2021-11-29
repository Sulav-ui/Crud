<?php

namespace App\Controller;


use App\Entity\Employee;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditController extends AbstractController
{
    #[Route('/edited', name: 'edited')]
    public function index(): Response
    {
        return $this->render('edit/index.html.twig', [
            'controller_name' => 'EditController',
        ]);
    }

    #[Route('/updated', name: 'updated')]
    public function update()
    {
        $employee=$this->getDoctrine()->getRepository(Employee::class)->find($_POST['id']);
        if (isset($_POST['update'])){
            $employee->setName($_POST["name"]);
            $employee->setEmail($_POST["email"]);
            $employee->setAddress($_POST["address"]);
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($employee);
            $entityManager->flush();
            $this->addFlash('success', 'Updated Successfully!');
            }

            return $this->render('employee/index.html.twig', [
                'controller_name' => 'EditController',
            ]);
        
    }
}
