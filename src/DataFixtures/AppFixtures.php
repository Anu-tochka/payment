<?php

namespace App\DataFixtures;

use App\Entity\Department;
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
    }
}
