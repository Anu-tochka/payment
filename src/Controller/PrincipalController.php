<?php
// src/Controller/PrincipalController.php
namespace App\Controller;

use App\Entity\Department;
use App\Entity\Work;
use App\Entity\Pers;
use App\Entity\Status;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\DepartmentRepository;
use App\Repository\WorkRepository;
use App\Repository\PersRepository;
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
	
	public function show(ManagerRegistry $doctrine): Response	
    {
		
        $pers = $doctrine->getRepository(Pers::class)->findAllPersonal();
        return $this->render('principal/principal.html.twig', [ 
            'pers' => $pers,
        ]);/*
		$serializer = $this->get('serializer');
			$json = $serializer->serialize($pers, 'json');

			return new Response($json);
			*/
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
        }

		return $this->render('principal/newwork.html.twig', [
			'work' => $work,
			'department' => $department,
			'd' => $d,
			'wform' => $form->createView(),
        ]);

    }
		
	public function newpers(ManagerRegistry $doctrine, Request $request): Response	
    {
		$now = date("d.m.Y");
		$pers = $doctrine->getRepository(Pers::class)->findAll();
		$s = 0;
        $work = $doctrine->getRepository(Work::class)->findAll();
		
		$newp = new Pers();
        $form = $this->createForm(NewPersType::class, $newp);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->get('DR')->getData()) $birthday = $form->get('DR')->getData()->format('Y-m-d'); 
            if ($form->get('passportD')->getData()) $passday = $form->get('passportD')->getData()->format('Y-m-d');
			$s = $request->request->get('statusID');
			$newp->setWorks($doctrine->getRepository(Work::class)->find($s));
			$newp->setIsWork(true);
			$this->entityManager->persist($newp);
            $this->entityManager->flush();

            return //$this->redirectToRoute('app_newpers');
			$this->render('principal/newpers.html.twig', [
				'pers' => $pers, 
				's' => $s,
				'now' => 'yyyy-MM-dd', 
				'work' => $work, 
				'pform' => $form->createView(),
			]);
        }

		return $this->render('principal/newpers.html.twig', [
			'pers' => $pers, 
			'now' => $now, 
			'work' => $work,  
			's' => $s,
			'pform' => $form->createView(),
        ]);

    }
	
}