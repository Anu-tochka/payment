<?php
// src/Controller/PrincipalController.php
namespace App\Controller;

use App\Entity\Department;
use App\Entity\Work;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\DepartmentRepository;
use App\Repository\WorkRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\NewPersType;
use App\Form\NewWorkType;
use Doctrine\ORM\EntityManagerInterface;

class PrincipalController extends AbstractController
{	
	
    private $entityManager;
	
	public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
	
	public function newwork(ManagerRegistry $doctrine, Request $request): Response	
    {
        $work = $doctrine->getRepository(Work::class)->findAll();
		$department = $doctrine->getRepository(Department::class)->findAll();
		$d = 0;
		$neww = new Work();
        $form = $this->createForm(NewWorkType::class, $neww);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
			$d = $request->request->get('depID');
            if ($form->get('cost')->getData()) {
				$cost = $form->get('cost')->getData(); 
				$neww->setCost($cost);
            }
			if ($form->get('rate')->getData()) {
				$rate = $form->get('rate')->getData();
				$neww->setRate($rate);
			}
			if ($form->get('trevelpayment')->getData()) {
				$trevelpayment = $form->get('trevelpayment')->getData();
				$neww->setTrevelpayment($trevelpayment);
			}
			$neww->getWorkname($form->get('workname'));
			$neww->setDep($doctrine->getRepository(Department::class)->find($d));
			$this->entityManager->persist($neww);
            $this->entityManager->flush();
/*
            return $this->render('principal/newwork.html.twig', ['work' => $work,
				'department' => $department,
				'd' => $d,
				'wform' => $form->createView(),
			]);*/
        }

		return $this->render('principal/newwork.html.twig', ['work' => $work,
			'department' => $department,
			'd' => $d,
			'wform' => $form->createView(),
        ]);

    }
	
}