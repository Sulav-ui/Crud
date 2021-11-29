<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Repository\EmployeeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewController extends AbstractController
{
    #[Route('/view', name: 'view')]
    public function index(EmployeeRepository $employeeRepository): Response
    {
        return $this->render('view/index.html.twig', [
            'h'=>$employeeRepository->findAll(),
        ]);
    }

    #[Route('/delete',name:'delete')]
    public function delete(EmployeeRepository $employeeRepository):Response
    {
        $entityManager=$this->getDoctrine()->getManager();
        $post=$entityManager->getRepository(Employee::class)->find($_GET['id']);
        $entityManager->remove($post);
        $entityManager->flush();
        
        return $this->render('view/index.html.twig', [
            'h'=>$employeeRepository->findAll(),
        ]);
        
    }

    #[Route('/edit', name:'edit')]
    public function edit()
    {
        $entityManager=$this->getDoctrine()->getManager();
        $post=$entityManager->getRepository(Employee::class)->find($_GET['id']);

        return $this->render('edit/index.html.twig', [
            'h'=>$post,
        ]);
        
    }

}
