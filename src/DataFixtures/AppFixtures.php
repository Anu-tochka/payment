<?php

namespace App\DataFixtures;

use App\Entity\Department;
use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $department = new Department();
        $department->setDepname('Производственный отдел');
        $manager->persist($department);

        $department = new Department();
        $department->setDepname('Административный отдел');
        $manager->persist($department);
		
        $manager->flush();
		
		$status = new Status();
        $status->setStatusname('рабочий день');
        $manager->persist($status);

        $status = new Status();
        $status->setStatusname('прогул');
        $manager->persist($status);
		
		$status = new Status();
        $status->setStatusname('за свой счет');
        $manager->persist($status);

        $status = new Status();
        $status->setStatusname('отпуск');
        $manager->persist($status);
		
		$status = new Status();
        $status->setStatusname('командировка');
        $manager->persist($status);

        $status = new Status();
        $status->setStatusname('больничный');
        $manager->persist($status);

        $status = new Status();
        $status->setStatusname('работа в выходной');
        $manager->persist($status);
		
        $manager->flush();
    }
}
