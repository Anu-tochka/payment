<?php
// src/Controller/OfficeController.php
namespace App\Controller;

use App\Entity\Pers;
use App\Entity\Day;
use App\Entity\Status;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\DayRepository;
use App\Repository\PersRepository;
use App\Repository\StatusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class OfficeController extends AbstractController
{	
	public $am;	
	public	$now;
	public	$currentY;
	public	$currentM;
	public	$hours;
	public	$monthes;

    public function __construct()
    {
		$this->am = array(
			'01'  => array("n" => '01',	"im" => 'январь', 	"rod" => 'январе'),
			'02'  => array("n" => '02',	"im" => 'февраль', 	"rod" => 'феврале'),
			'03'  => array("n" => '03',	"im" => 'март', 	"rod" => 'марте'),
			'04'  => array("n" => '04',	"im" => 'апрель', 	"rod" => 'апреле'),
			'05'  => array("n" => '05',	"im" => 'май', 		"rod" => 'мае'),
			'06'  => array("n" => '06',	"im" => 'июнь', 	"rod" => 'июне'),
			'07'  => array("n" => '07',	"im" => 'июль', 	"rod" => 'июле'),
			'08'  => array("n" => '08',	"im" => 'август', 	"rod" => 'августе'),
			'09'  => array("n" => '09',	"im" => 'сентябрь', "rod" => 'сентябре'),
			'10' => array("n" => '10',	"im" => 'октябрь', 	"rod" => 'октябре'),
			'11' => array("n" => '11',	"im" => 'ноябрь', 	"rod" => 'ноябре'),
			'12' => array("n" => '12',	"im" => 'декабрь', 	"rod" => 'декабре')
		);
		$this->now = date("Y-m-d");
		$this->currentY = date("Y");
		$this->currentM = date("m");
		$this->hours = [12,11,10,9,8, 7, 6, 5, 4]; // часы работы
    }
  
	public function getMonthes() {
		
		foreach ($this->am as $key => $value) { 
			$this->monthes[$key] = $value;
			if ($key == $this->currentM) break;
		}
		return $this->monthes;
	}

	public function index(ManagerRegistry $doctrine): Response	
    {
		$now = $this->now;
		$currentM = $this->currentM;
        $pers = $doctrine->getRepository(Pers::class)->findAllPersonal();
        $persIDList = [];
		$i = 0;
		$curmonthes = OfficeController::getMonthes();
		
		foreach ($pers as $key => $value) {
			$persIDList[$i] = $value['persID'];
			$i++;
		}
		// проверяем, была ли отправлена информация о работе сотрудников сегодня
        $isWorkToday = $doctrine->getRepository(Day::class)->isWorkToday($now,$persIDList);
		$count = count($isWorkToday);
		// если была, то переадресуем на страницу с данными за весь месяц
		if ($count > 0) {
			return $this->redirectToRoute('app_showMonth', ['monthN' => $currentM]);
		}
		// если ещё не отправляли, то показываем страницу с формой
		else {
			$statuses = $doctrine->getRepository(Status::class)->findAll();
			return $this->render('office/office.html.twig', [
				'pers' => $pers, 
				'now' => $now, 
				'am' => $this->am, 
				'curmonthes' => $curmonthes, 
				'statuses' => $statuses,
				'year' => $this->currentY,
				'hours' => $this->hours,
				'currentM' => $currentM,
			]);
		}
    }
	
	public function save(Request $request, ManagerRegistry $doctrine, EntityManagerInterface $entityManager): Response
    {
		$curmonthes = OfficeController::getMonthes();
		$i = 0;
		$p1 = 'no';
		if ($request->request){
			$cont = $request->get('reqq');
				$p1 = 'ok!';
			foreach ($cont as $key => $value) {
				$dayList = new Day();
				$i++;
				$targetDay = date_create_from_format('Y-m-d',$value['daynow']); 
				$dayList->setDaynow($targetDay);
				$dayList->setPers($doctrine->getRepository(Pers::class)->find($value['persID']));
				$dayList->setStatuses($doctrine->getRepository(Status::class)->find($value['statusID']));
				$dayList->setHours($value['hours']);
				$entityManager->persist($dayList);
				$entityManager->flush();
				$entityManager->clear();
			}
		}
        $pers = $doctrine->getRepository(Pers::class)->findAll();
	
		    $response = new Response();
			return $this->render('Office/month.html.twig', [ 
				'pers' => $pers, 
				'statuses' =>$dayList, 
				'year' => $this->currentY,
				'count' => $i, 
				'now' => $p1, 
				]);
    }
		
	// данные о работе сотрудников за месяц
	 #[Route('/office/showMonth/{monthN}', name: 'app_showMonth')]	
	public function showMonth($monthN, ManagerRegistry $doctrine): Response	
    {
		$persDays = array();
        $persList = $doctrine->getRepository(Pers::class)->findAllPersonal();
		$dayList = [];	
		$countDays = cal_days_in_month(CAL_GREGORIAN, $this->currentM, $this->currentY);
		$today = $this->currentY."-".$monthN;	
		$curmonthes = OfficeController::getMonthes();
		$targetm = $this->am[$monthN];
		$statuses = $doctrine->getRepository(Status::class)->findAll();
		
		for ($d=1; $d < ($countDays+1); $d++) {
			if ($d<10)	$dayList[$d-1] = $today."-0".$d;
			else	$dayList[$d-1] = $today."-".$d;
			if ( $dayList[$d-1] == $this->now ) break;
		}
		$i = 0;
		$resp = '';
		$p = '';
		foreach ($persList as $key => $value) {
			$data = array();
			$p = $value['persID'];
			$fio = $value['fam'].' '.$value['im'].' '.$value['ot'];		 
			foreach ($dayList as $keyD => $valueD) {
				$dd = $doctrine->getRepository(Day::class)->findIndividualDay($valueD,$p);
				$exp = [];
				$data[$valueD] = array('daynow' => $valueD,'find' => $dd);
			}
			$persDays[$key] = array('persID' => $p, 'fio' => $fio, 'work' => $value['workname'], 'data' => $data);
		}
        return $this->render('office/month.html.twig', [
			'pers' => $persList, 
			'day' => $dayList, 
			'today' => $today,
			'now' => $this->now,  
			'targetm' => $targetm, 
			'curmonthes' => $curmonthes, 
			'year' => $this->currentY,
			'statuses' => $statuses, 
			'persDays' => $persDays,
			'hours' => $this->hours,
        ]);
		
    }
		
	#[Route('/office/insertDay/{targetDay}/{persID}', name: 'app_insertDay')]
	public function insertDay($targetDay, $persID, ManagerRegistry $doctrine, Request $request): Response
    {
		$curmonthes = OfficeController::getMonthes();
		$id = $request->get("persID");
		$targetDay = $request->get("targetDay");
		$tDay = date_create_from_format('Y-m-d',$targetDay);
        $entity = $doctrine->getManager();
		$lastId = '';
		if ($request->request){
			$dayList = new Day();
			$dayList->setDaynow($tDay);
			$dayList->setPers($doctrine->getRepository(Pers::class)->find($id));
			$dayList->setHours($request->request->get('hours'));
			$dayList->setStatuses($doctrine->getRepository(Status::class)->find($request->request->get('statusID')));
			if ($request->request->get('total')) $dayList->setTotal((float)$request->request->get('total'));
			$entity->persist($dayList);
			$entity->flush();
			$lastId = $dayList->getId(); // we can now get the Id
			$entity->clear();
		
		}	
		return new Response($lastId);	
    }
		
	#[Route('/office/correctDay/{dayID}', name: 'app_correctDay')]
	public function correctDay($dayID, ManagerRegistry $doctrine, Request $request): Response
    {
		$curmonthes = OfficeController::getMonthes();
		$id = $request->get("dayID");
        $entity = $doctrine->getManager();
		$lastId = '';
		if ($request->request){
			$dayList = $entity->getRepository(Day::class)->find($id);
			$dayList->setHours($request->request->get('hours'));
			$dayList->setStatuses($doctrine->getRepository(Status::class)->find($request->request->get('statusID')));
			if ($request->request->get('total')) $dayList->setTotal((float)$request->request->get('total'));
			$entity->flush();
			$lastId = $dayList->getId(); // we can now get the Id
			$entity->clear();
		
		}	
		return new Response($lastId);	
    }
	
}