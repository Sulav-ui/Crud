<?php

namespace App\Controller;

use App\Entity\Employee;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController extends AbstractController
{
    #[Route('/employee', name: 'employee')]
    public function index(Request $req,EntityManagerInterface $em)
    {
        $entityManager=$this->getDoctrine()->getManager();
        if (isset($_POST['submit'])){
        $employee=new Employee();
        $employee->setName($_POST["name"]);
        $employee->setEmail($_POST["email"]);
        $employee->setAddress($_POST["address"]);
        $entityManager->persist($employee);
        $entityManager->flush();
        $this->addFlash('success', 'Successfully added!');
        }
        return $this->render('employee/index.html.twig', [
            'controller_name' => 'EmployeeController',
        ]);
                                  
    
    
    }
}

